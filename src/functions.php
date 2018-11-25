<?php

// Hide PHP Errors
// error_reporting(E_ALL ^ E_WARNING);

// Hide ACF
// add_filter('acf/settings/show_admin', '__return_false');

// Register Plugins
add_action('tgmpa_register', 'wpclean_register_required_plugins');