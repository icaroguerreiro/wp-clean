<?php
	get_header();

	$template = __DIR__."/_template/src/index.pug";
	Phug::displayFile($template);

	get_footer();
