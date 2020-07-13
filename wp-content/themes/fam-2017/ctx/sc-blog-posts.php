<?php

add_shortcode('blog-posts', 'sc_blog_posts');

function sc_blog_posts ($atts, $content) {
	$type = 'post';
	$posts = Timber::get_posts(array_merge($atts, array('post_type' => $type)));

	return Timber::compile('widgets/blog-posts.twig', array('posts' => $posts, 'attr' => $atts));
}