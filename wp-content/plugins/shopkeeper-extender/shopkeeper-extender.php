<?php

/**
 * Plugin Name:       		Shopkeeper Extender
 * Plugin URI:        		https://shopkeeper.wp-theme.design/
 * Description:       		Extends the functionality of Shopkeeper with theme specific features.
 * Version:           		1.5.9
 * Author:            		GetBowtied
 * Author URI:				https://getbowtied.com
 * Text Domain:				shopkeeper-extender
 * Domain Path:				/languages/
 * Requires at least: 		5.0
 * Tested up to: 			5.4
 *
 * @package  Shopkeeper Extender
 * @author   GetBowtied
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

// Plugin Updater
require 'core/updater/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/getbowtied/shopkeeper-extender/master/core/updater/assets/plugin.json',
	__FILE__,
	'shopkeeper-extender'
);

if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

define( 'SK_EXT_ENQUEUE_SUFFIX', SCRIPT_DEBUG ? '' : '.min' );

$version = ( isset(get_plugin_data( __FILE__ )['Version']) && !empty(get_plugin_data( __FILE__ )['Version']) ) ? get_plugin_data( __FILE__ )['Version'] : '1.0';
define ( 'SK_EXT_VERSION', $version );

if ( ! class_exists( 'ShopkeeperExtender' ) ) :

	/**
	 * ShopkeeperExtender class.
	*/
	class ShopkeeperExtender {

		/**
		 * The single instance of the class.
		 *
		 * @var ShopkeeperExtender
		*/
		protected static $_instance = null;

		/**
		 * ShopkeeperExtender constructor.
		 *
		*/
		public function __construct() {

			$theme = wp_get_theme();
			$parent_theme = $theme->parent();

			// Helpers
			include_once( dirname( __FILE__ ) . '/includes/helpers/helpers.php' );

			// Vendor
			include_once( dirname( __FILE__ ) . '/includes/vendor/enqueue.php' );

			if( ( $theme->template == 'shopkeeper' && ( $theme->version >= '2.8' || ( !empty($parent_theme) && $parent_theme->version >= '2.8' ) ) ) || $theme->template != 'shopkeeper' ) {

                // Customizer
				include_once( dirname( __FILE__ ) . '/includes/customizer/repeater/class-sk-ext-repeater-control.php' );

				// Shortcodes
				include_once( dirname( __FILE__ ) . '/includes/shortcodes/index.php' );

				// Social Media
				include_once( dirname( __FILE__ ) . '/includes/social-media/class-social-media.php' );

				// Widgets
				include_once( 'includes/widgets/social-media.php' );

				// Addons
				if ( $theme->template == 'shopkeeper' && is_plugin_active( 'woocommerce/woocommerce.php') ) {
					include_once( dirname( __FILE__ ) . '/includes/addons/class-wc-category-header-image.php' );
				}
			}

			// Gutenberg Blocks
			add_action( 'init', array( $this, 'gbt_sk_gutenberg_blocks' ) );

			if( $theme->template == 'shopkeeper' && ( $theme->version >= '2.8.1' || ( !empty($parent_theme) && $parent_theme->version >= '2.8.1' ) ) ) {

				// Custom Code Section
				include_once( dirname( __FILE__ ) . '/includes/custom-code/class-custom-code.php' );

				// Social Sharing Buttons
				if ( is_plugin_active( 'woocommerce/woocommerce.php') ) {
					include_once( dirname( __FILE__ ) . '/includes/social-sharing/class-social-sharing.php' );
				}
			}

			if( $theme->template == 'shopkeeper' && ( $theme->version >= '2.8.6' || ( !empty($parent_theme) && $parent_theme->version >= '2.8.6' ) ) ) {

				//Custom Menu
				include_once( dirname( __FILE__ ) . '/includes/custom-menu/index.php' );
			}
		}

		/**
		 * Loads Gutenberg blocks
		 *
		 * @return void
		*/
		public function gbt_sk_gutenberg_blocks() {

			if( is_plugin_active( 'gutenberg/gutenberg.php' ) || is_wp_version('>=', '5.0') ) {
				include_once( dirname( __FILE__ ) . '/includes/gbt-blocks/index.php' );
			} else {
				add_action( 'admin_notices', 'theme_warning' );
			}
		}

		/**
		 * Ensures only one instance of ShopkeeperExtender is loaded or can be loaded.
		 *
		 * @return ShopkeeperExtender
		*/
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
	}
endif;

$shopkeeper_extender = new ShopkeeperExtender;
