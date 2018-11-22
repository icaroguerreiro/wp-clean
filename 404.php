<?php
	get_header();

	$template = __DIR__."/src/404.pug";
	Phug::displayFile($template);

	get_footer();
