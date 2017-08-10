
global.jQuery = require('../node_modules/jquery/dist/jquery.slim.min');
var $ = global.jQuery;
window.$ = $;

require('../node_modules/masonry-layout/dist/masonry.pkgd.min');

require('./theme');

import Vue from '../node_modules/vue/dist/vue'
import VueResource from '../node_modules/vue-resource/dist/vue-resource'
import VueRouter from '../node_modules/vue-router/dist/vue-router.min'

Vue.use(VueRouter);
Vue.use(VueResource);

const postList = Vue.extend({
  template: "#post-list-template",
  data: function() {
    return {
      posts: [],
      categories: [],
      nameFilter: '',
      categoryFilter: '',
      selected: '',
      selectedCategory: 'All',
      isActive: false,
      postTitle: 'Title here',
      featuredImage: '',
      excerpt: '',
      previewNextID: '',
      previewPrevID: '',
      currentPostId: '',
      show: false
    }
  },
  mounted: function() {
    this.$http.get('./wp-json/wp/v2/posts?per_page=20').then(response => {
    // get body data
    this.posts =  response.body.reverse();
    }, response => {
      // error callback
      console.log(response)
    });
    this.$http.get('./wp-json/wp/v2/categories').then(response => {
    // get body data
    this.categories =  response.body;
    // console.log(this.categories);
    }, response => {
      // error callback
      console.log(response)
    });
  },
  methods : {
    clearCategory: function (e) {
      this.categoryFilter = '';
    },
    clearSearch: function (e) {
      this.nameFilter = '';
      // $('.site-title').hide();
    }
    ,
    activeMe: function (e) {
      // let liParent = document.querySelectorAll('.categorysearch');
      let liChildren = document.querySelectorAll('.categorysearch .filter_category_container');
      // console.log(liChildren);

      // $('.filter_category_container').removeClass("active");
      for(let i=1; i < liChildren.length ; i++) {
        let li = liChildren[i];
        li.classList.remove('active');
      }

      e.currentTarget.classList.add('active');

    },
    populatePreview : function(id) {
      let parentHtml = document.querySelectorAll('html');
      var self = this;
      self.posts.map(function(value, key) {
       if(id+"" === value.id+"") {
         self.postTitle = value.title.rendered;
         self.featuredImage = value.banner;
         self.excerpt = value.excerpt.rendered;

         if(value.next_post === null) {
           self.previewNextID = "nomore";
           self.previewPrevID = value.prev_post;
         } else if(value.prev_post === null) {
           self.previewPrevID = "nomore";
           self.previewNextID = value.next_post;
         } else {
           self.previewNextID = value.next_post;
           self.previewPrevID = value.prev_post;
         }
         self.currentPostId = value.id;
         self.show = true;
         for(let i=0; i < parentHtml.length ; i++) {
           let x = parentHtml[i];
           x.classList.add('bodyremovescroll');
         }
        //  parentHtml.classList.add('bodyremovescroll');
        //  $('html').addClass('bodyremovescroll');

       }
      });
    },

    getThePost: function(event) {
      var self = this;
      var targetId,id
      targetId = event.currentTarget.id;
      self.populatePreview(targetId);
    },
    getPrev : function(id){
      var self = this;
      self.populatePreview(id);
    },
    getNext : function(id){
      var self = this;
      self.populatePreview(id);
    },
    closeit : function() {
      let parentHtml = document.querySelectorAll('html');

      for(let i=0; i < parentHtml.length ; i++) {
        let x = parentHtml[i];
        x.classList.remove('bodyremovescroll');
      }
      this.show = false;
    }
  },
  computed: {
    // | filterBy nameFilter in 'title'
    filteredUsers: function () {
        var self = this
        return self.posts.filter(function (post) {
          var id = 0;
          var filter = false;

          if(self.nameFilter === '' && self.categoryFilter ==='') {
            filter = true;
          }

          self.categories.map(function(value, key) {
            if( self.nameFilter.toLowerCase() === value.name.toLowerCase()  || self.categoryFilter+"" === value.id+"" ) {
              id = value.id;
              self.selectedCategory = value.name;
              self.isActive = false;
          }
         });

        var hasCategory = false;
        post.categories.map(function(value, key) {
         if(value+"" === id+"") {
           hasCategory = true;
         }
        });

        var searchRegex = new RegExp(self.nameFilter, 'i');

        var hasName = searchRegex.test(post.title.rendered);

        if(self.categoryFilter !== '') {
          filter = hasCategory;
        } else {
          filter = hasCategory || hasName ;
          self.selectedCategory = "All"
        }
         return filter;
       });
    }
  },
  filters : {
        reverse : function(value,wordsOnly){
           var seperator = '';
           wordsOnly && (seperator = ' ');
           console.log(value);
           return value.split(seperator).reverse().join(seperator);
       }
  }
});

const singlePostList = Vue.extend({
  template: "#single-post-template",
  data: function() {
      return {
        posttitle : '',
        next: '',
        prev: '',
        singleContent: '',
        nextNull: false,
        prevNull: false
      }
    },
    mounted: function() {
      var self = this;
      self.callSinglePost(this.$route.params.postID);
    },
    methods: {
      callSinglePost(id){
        var self = this;
        this.$http.get('./wp-json/wp/v2/posts/' + id).then(response => {
        // get body data
        self.posttitle = response.body;
        this.$route.params.postID = id;
        this.singleContent = self.posttitle.content.rendered;
        router.push({ name: 'post', params: { userId: id }});

        $('html').removeClass('bodyremovescroll');

        if(self.posttitle.next_post === null) {
          self.nextNull = true;
          self.prevNull = false;
        } else if(self.posttitle.prev_post === null) {
          self.nextNull = false;
          self.prevNull = true;
        } else {
          self.nextNull = false;
          self.prevNull = false;
        }

        }, response => {
          // error callback
          // console.log(response)
        });
      },
      populateSingle : function(id) {
        var self = this;
        self.callSinglePost(id);
      }
    }
});


var router = new VueRouter({
  routes: [
   { path: '/', component: postList },
   { path: '/post/:postID', name: 'post', component: singlePostList }
 ]
});

window.addEventListener('load', function () {
  const app = new Vue({
    router
  }).$mount('#app')
});
