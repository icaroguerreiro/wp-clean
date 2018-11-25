<?php
  $context = Timber::get_context();
  $post = new TimberPost();
  $context['post'] = $post;
  Timber::render('index.twig', $context );

  
 wp_nav_menu( array('menu_main' => 'menu-header'));