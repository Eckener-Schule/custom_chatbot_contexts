<?php
/*
Plugin Name: Custom chatbot Contexts
Description: 
Author:
Version: 1.0
*/

if (!defined( 'ABSPATH')) {
	die;
}
define( 'WP_PATH', plugin_dir_path( __FILE__ ));
define( 'WP_URL', plugin_dir_url( __FILE__ ));
require_once plugin_dir_path( __FILE__ ) . 'includes/main_class.php';
add_action( 'plugins_loaded', array( 'CustomChatbotContexts', 'init' ));