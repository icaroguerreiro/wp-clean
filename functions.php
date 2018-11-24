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


// Front Page
function wpclean_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'wpclean_front_page_template' );

// Remove Emoji CSS
remove_action('wp_head','print_emoji_detection_script', 7); 
remove_action('admin_print_scripts','print_emoji_detection_script'); 
remove_action('wp_print_styles','print_emoji_styles'); 
remove_action('admin_print_styles','print_emoji_styles');

// Composer Autoload
include_once __DIR__ .'/_engine/vendor/autoload.php';

// Phug <3
use JsPhpize\JsPhpizePhug;
Phug::addExtension(JsPhpizePhug::class);

// Plugin ACF
function my_acf_settings_path( $path ) {
    $path = __DIR__.'/_engine/plugins/acf/';
    return $path;
}; add_filter(__DIR__.'/_engine/plugins/acf/settings/path', 'my_acf_settings_path');

function my_acf_settings_dir( $dir ) {
    $dir = __DIR__.'/_engine/plugins/acf/';
    return $dir;
}; add_filter(__DIR__.'/_engine/plugins/acf/settings/dir', 'my_acf_settings_dir');

include_once(__DIR__.'/_engine/plugins/acf/acf.php');

// Required and Recommended Plugins
function wpclean_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'Custom Post Type UI',
			'slug'      => 'custom-post-type-ui',
			'required'  => false,
		),
		array(
			'name'      => 'Cloudflare',
			'slug'      => 'cloudflare',
			'required'  => false,
		),
		array(
			'name'      => 'reSmush.it Image Optimizer',
			'slug'      => 'resmushit-image-optimizer',
			'required'  => false,
		),
		array(
			'name'      => 'Minify HTML',
			'slug'      => 'minify-html-markup',
			'required'  => false,
		),
		array(
			'name'      => 'WP Super Cache',
			'slug'      => 'wp-super-cache',
			'required'  => false,
		),
	);
	$config = array(
  'id'           => 'wpclean',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'plugins.php',            // Parent menu slug.
		'capability'   => 'manage_options',         // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                     // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => __( 'Instalar plugins necessários', 'wpclean' ),
			'menu_title'                      => __( 'Instalar Plugins', 'wpclean' ),
			'installing'                      => __( 'Instalando Plugin: %s', 'wpclean' ),
			'updating'                        => __( 'Atualizando Plugin: %s', 'wpclean' ),
			'oops'                            => __( 'Algo deu errado com a API do plugin.', 'wpclean' ),
			'notice_can_install_required'     => _n_noop(
				'Este tema requer o seguinte plugin: %1$s.',
				'Este tema requer o seguinte plugins: %1$s.',
				'wpclean'
			),
			'notice_can_install_recommended'  => _n_noop(
				'Este tema recomenda o seguinte plugin: %1$s.',
				'Este tema recomenda os seguintes plugins: %1$s.',
				'wpclean'
			),
			'notice_ask_to_update'            => _n_noop(
				'O plug-in a seguir precisa ser atualizado para sua versão mais recente para garantir compatibilidade máxima com este tema: %1$s.',
				'Os seguintes plugins precisam ser atualizados para sua versão mais recente para garantir compatibilidade máxima com este tema: %1$s.',
				'wpclean'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				'Há uma atualização disponível para: %1$s.',
				'Há atualizações disponíveis para os seguintes plugins: %1$s.',
				'wpclean'
			),
			'notice_can_activate_required'    => _n_noop(
				'O seguinte Plugin, que é necessário, está inativo: %1$s.',
				'Os seguintes Plugins, que são necessários, estão inativos: %1$s.',
				'wpclean'
			),
			'notice_can_activate_recommended' => _n_noop(
				'O seguinte Plugin, que é recomendado, está inativo: %1$s.',
				'Os seguintes Plugins, que são recomendados, estão inativos: %1$s.',
				'wpclean'
			),
			'install_link'                    => _n_noop(
				'Instalar Plugin',
				'Instalar Plugins',
				'wpclean'
			),
			'update_link' 					  => _n_noop(
				'Atualizar Plugin',
				'Atualizar Plugins',
				'wpclean'
			),
			'activate_link'                   => _n_noop(
				'Ativar Plugin',
				'Ativar Plugins',
				'wpclean'
			),
			'return'                          => __( 'Voltar para instalador de Plugins necessários', 'wpclean' ),
			'plugin_activated'                => __( 'Plugin ativado com sucesso.', 'wpclean' ),
			'activated_successfully'          => __( 'O plugin a seguir foi ativado com sucesso:', 'wpclean' ),
			'plugin_already_active'           => __( 'Nenhuma ação tomada. O Plugin %1$s já está ativo.', 'wpclean' ),
			'plugin_needs_higher_version'     => __( 'Plugin não ativado. Uma versão mais nova de %s é ncessária para este tema. Atualiza o plugin.', 'wpclean' ),
			'complete'                        => __( 'Todos os plugins instalados e ativados com sucesso. %1$s', 'wpclean' ),
			'dismiss'                         => __( 'Descartar essa Notificação', 'wpclean' ),
			'notice_cannot_install_activate'  => __( 'Há um ou mais plugins obrigatórios ou recomendados para instalar, atualizar ou ativar.', 'wpclean' ),
			'contact_admin'                   => __( 'Entre em contato com o administrador deste site para ajuda.', 'wpclean' ),
			'skin_update_successful'					=> __( 'aa', 'wpclean' ),

			'nag_type'                        => ''
		),
	);
	tgmpa( $plugins, $config );
}


// Custom admin.css
function my_admin_css() {
  echo '<link rel="stylesheet" href="'.get_stylesheet_directory_uri().'/statics/css/admin.css" type="text/css" media="all" />';
}
add_action('admin_head', 'my_admin_css');
add_action('login_head', 'my_admin_css');


// Additional features to allow styling of the templates.
require get_parent_theme_file_path( '/src/functions.php' );