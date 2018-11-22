<?php
	get_header();

	$template = __DIR__."/_template/src/404.pug";
	Phug::displayFile($template);

	get_footer();
