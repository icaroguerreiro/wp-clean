<?php 

function add_to_context( $context ) {
  
  // Custom Posts Queries
  // $args = array(
  // 'post_type' => 'testando',
  // 'posts_per_page' => -1, 
  // 'orderby' => array(
  //     'date' => 'DESC'
  // ));  
  // $context['testando'] = Timber::get_posts($args);
  
	// Menu
	$context['menu_main'] = new \Timber\Menu('menu-main');
  $context['menu_secondary'] = new \Timber\Menu('menu-secondary');
  
  // Return
	return $context;
} add_filter( 'timber/context', 'add_to_context' );