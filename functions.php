<?php
// Sets up theme defaults and registers features
function wpclean_setup() {

	// Theme Supports
	add_theme_support( 'automatic-feed-links');
	
	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );
	add_image_size( 'wpclean-featured-image', 2000, 1200, true );
	add_image_size( 'wpclean-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// Menu Locations
	register_nav_menus( array(
		'main'    => __( 'Main Menu', 'wpclean' ),
		'footer' => __( 'Footer Menu', 'wpclean' )
	) );

	// HTML5 Supports for Elements
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Enable support for Post Formats
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Editor CSS
	add_editor_style('assets/css/editor-style.css');

	// Starter Content
	$starter_content = array();
	$starter_content = apply_filters( 'wpclean_starter_content', $starter_content );
	add_theme_support( 'starter-content', $starter_content );
}; add_action( 'after_setup_theme', 'wpclean_setup' );


// [...] Excerpt
function wpclean_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wpclean' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}; add_filter( 'excerpt_more', 'wpclean_excerpt_more' );

// Add a pingback url auto-discovery header for singularly identifiable articles.
function wpclean_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
} ;add_action( 'wp_head', 'wpclean_pingback_header' );


// Enqueue scripts and styles.
function wpclean_scripts() {
	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
}; add_action( 'wp_enqueue_scripts', 'wpclean_scripts' );


// Front Page
function wpclean_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'wpclean_front_page_template' );


// Additional features to allow styling of the templates.
require get_parent_theme_file_path( '/src/functions.php' );

// Remove Emoji CSS
remove_action('wp_head','print_emoji_detection_script', 7); 
remove_action('admin_print_scripts','print_emoji_detection_script'); 
remove_action('wp_print_styles','print_emoji_styles'); 
remove_action('admin_print_styles','print_emoji_styles');
