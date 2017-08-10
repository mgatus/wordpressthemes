<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package boksy
 */
?>

<?php get_header(); ?>

	<div class="white-wrap">
		<div id="app">
			<router-view></router-view>
		</div>
	</div>

	<template id="post-list-template">
			<div class="container_app">
				<transition name="fade">
					<div class="overlay" v-if="show"></div>
				</transition>
				<!-- Filter by Name  -->
				<div class="filter_name_container">
					<h4>Filter by Name :  {{nameFilter}}</h4>
					<input type="text" name="" v-on:focus="clearCategory" v-model="nameFilter">
				</div>

				<!-- Filter by Category -->
				<div class="catcon">
					<h4>Filter by Category :  {{selectedCategory}}</h4>
					<div class="categorysearch">
						<div @click="activeMe" class="filter_category_container">
							<input type="radio" v-model="categoryFilter" value="" id="all" title="All">
							<label for="all">All</label>
						</div>
						<div class="filter_category_container" v-bind:class="{ active: isActive }" @click="activeMe"  v-for="category in categories">
							<input type="radio" v-model="categoryFilter" v-bind:value="category.id" v-bind:title="category.name" v-bind:id="category.name" v-on:click="clearSearch" >
							<label   v-bind:for="category.name">{{category.name}}</label>
						</div>
					</div>
				</div>

				<div v-for="post in filteredUsers" v-bind:key="post.id" ref="filteredUsers" class="post-listings" v-bind:class="{haspreview: show}">
					<div class="listing">
						<a v-bind:id="post.id" v-bind:next="post.next_post" v-bind:prev="post.prev_post" v-on:click="getThePost($event)">
							<img v-bind:src="post.fi_300x180" v-bind:alt="post.title.rendered">
							<h2>{{post.title.rendered}}</h2>
							<div class="categorycontainer">
								<div class="category" v-for="category in post.cats">
									{{category.name}}
								</div>
							</div>
						</a>
					</div>
				</div>

				<transition name="slidein">
					<div class="preview" v-if="show">
						<button type="button" class="close-button" @click="closeit" name="button">&#215;</button>
						<h2 v-bind:id="currentPostId">{{ postTitle }}</h2>
						<img class="featuredImage" :src="featuredImage" :alt="postTitle">
						<div class="excerpt" v-html="excerpt"></div>

						<div class="readmore">
							<router-link :to="{ name: 'post', params: { postID: currentPostId }}">Read More</router-link>
						</div>

						<div class="navigation">
							<button v-on:click="getPrev(previewPrevID)" v-bind:class="previewPrevID" class="prev">&#8249;</button>
							<button v-on:click="getNext(previewNextID)" v-bind:class="previewNextID" class="next">&#8250;</button>
						</div>
					</div>
			</transition>
		</div>
	</template>

	<!-- single post  -->

	<template id="single-post-template">
		<div id="single-post">


			<span v-bind:id="posttitle.next_post" v-bind:class="{disabled: prevNull}" class="previouspath" @click="populateSingle(posttitle.prev_post)">&#8249;</span>

			<div class="homepath">
				<router-link :to="{ path: '/'}">Go Back</router-link>
			</div>

			<h2>{{posttitle.title.rendered}}</h2>
			<img v-bind:src="posttitle.banner" alt="">
			<p v-html="singleContent"></p>


			<span v-bind:id="posttitle.prev_post" v-bind:class="{disabled: nextNull}" class="nextpath" @click="populateSingle(posttitle.next_post)">&#8250;</span>

			<div class="homepath">
				<router-link :to="{ path: '/'}">Go Back</router-link>
			</div>

		</div>
	</template>

<?php //get_footer(); ?>
