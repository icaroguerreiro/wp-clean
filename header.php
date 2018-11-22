<?php
	// Phug <3
	use JsPhpize\JsPhpizePhug;
	include_once __DIR__ .'/_engine/vendor/autoload.php';
	Phug::addExtension(JsPhpizePhug::class);
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<style><?php @include 'statics/css/critical.css'; ?></style>
	<?php wp_head(); ?>
	<?php	Phug::displayFile(__DIR__."/src/_head.pug"); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">
	<?php Phug::displayFile(__DIR__."/src/components/header/header.pug"); ?>
