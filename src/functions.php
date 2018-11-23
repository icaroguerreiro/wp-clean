<?php

// Hide ACF
// add_filter('acf/settings/show_admin', '__return_false');

// HTML Compress
add_action('get_header', 'wp_html_compression_start');

// Require Plugins
add_action('tgmpa_register', 'wpclean_register_required_plugins');
