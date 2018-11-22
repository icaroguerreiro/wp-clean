
	<?php Phug::displayFile(__DIR__."/src/components/footer/footer.pug"); ?>

</div><!-- #wrapper -->
<?php wp_footer(); ?>

<?php echo '<script type="text/javascript" src="'.get_template_directory_uri().'/statics/js/bundler.js"></script>' ?>
<?php	Phug::displayFile(__DIR__."/src/_scripts.pug"); ?>

</body>
</html>
