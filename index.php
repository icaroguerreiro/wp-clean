<?php
	get_header();

	$template = __DIR__."/src/index.pug";
	Phug::displayFile($template);

	get_footer();
