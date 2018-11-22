<?php
	get_header();

	global $post;
	$post_slug = $post->post_name;

	$view = __DIR__."/views/page/page-${post_slug}.pug";
	$default = __DIR__."/views/page/page.pug";
	file_exists($view) ? $template = $view : $template = $default

?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();


			 Phug::displayFile($template);

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
