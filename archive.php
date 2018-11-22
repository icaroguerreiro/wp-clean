<?php
	get_header();

	global $post;
	$post_slug = $post->post_name;

	$view = __DIR__."/_template/src/archive-${post_slug}.pug";
	$default = __DIR__."/_template/src/archive.pug";
	file_exists($view) ? $template = $view : $template = $default;

	while ( have_posts() ) : the_post();
		Phug::displayFile($template);
	endwhile;

	get_footer();
