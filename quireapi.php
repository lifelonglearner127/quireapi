<?php

/*
Plugin Name: QuireAPI
Plugin URI: https://github.com/richardmoore725/quire-api
Description: Backend for QuireApp
Version: 1.0
Author: richard
Author URI: https://github.com/richardmoore725
License: A "Slug" license name e.g. GPL2
*/

defined( 'ABSPATH' ) || exit();

if ( ! defined( 'QUIRE_API_PLUGIN_FILE' ) ) {
	define( 'QUIRE_API_PLUGIN_FILE', __FILE__ );
	require_once dirname( __FILE__ ) . '/includes/constants.php';
}

class QuireApi {

	private static $instance = null;

	/**
	 * QuireApp constructor.
	 */
	private function __construct() {
		$this->_init();
	}

	private function _init() {
		$this->includes();
		$this->init_hooks();
	}

	private function includes() {
		//Repository autoloader
		require_once QUIRE_API_PLUGIN_CLASSES_DIR . '/class-quire-autoloader.php';

		//API creator
		require_once QUIRE_API_PLUGIN_CLASSES_DIR . '/class-quire-api-loader.php';


		require_once QUIRE_API_PLUGIN_DIR . '/includes/functions.php';
		require_once QUIRE_API_PLUGIN_DIR . '/includes/strings.php';

	}

	private function init_hooks() {

		add_action( 'wp_insert_post', 'quire_post_insert_hook', 1, 3 );
		add_action( 'set_auth_cookie', 'quire_add_cookie_to_dev_site', 10, 6 );
		add_action( 'set_logged_in_cookie', 'quire_add_cookie_to_dev_site', 10, 6 );
		add_filter( 'jwt_auth_whitelist', '/wp-json/quire/*' );
	}

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

$GLOBALS['QuireApp'] = QuireApi::getInstance();