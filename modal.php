<?php               namespace clb_bootstrap_modals;
/*
Plugin Name: Simple Bootstrap Modals
Plugin URI: http://www.tomatillodesign.com
Description: Using Bootstrap 4.0+ Modals in WordPress
Author: Chris Liu-Beers
Version: 1.0
Author URI: http://www.tomatillodesign.com
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: simple-bootstrap-modals
Domain Path: /languages/
*/

if ( ! defined( 'ABSPATH' ) ) {
				die;
}


/**
* Register our text domain.
*
* @since 1.3.0
*/
function load_textdomain() {
	load_plugin_textdomain( 'bootstrap-modal', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\\load_textdomain' );


/**
* Register and Enqueue Scripts and Styles.
*
* @since 1.0.0
*/
//Script-tac-ulous -> All the Scripts and Styles Registered and Enqueued, scripts first - then styles
function scripts_styles() {

	wp_register_script( 'modaljs' , plugins_url( '/js/modal.js',  __FILE__), array( 'jquery' ), '4.0.0-alpha.6', true );
	wp_register_style( 'modalcss' , plugins_url( '/css/modal.css',  __FILE__), '' , '4.0.0-alpha.6', 'all' );


	wp_enqueue_script( 'modaljs' );
	wp_enqueue_style( 'modalcss' );
}
add_action( 'wp_enqueue_scripts',  __NAMESPACE__ . '\\scripts_styles' );




/**
 * Create the plugin option page.
 *
 * @since 1.3.0
 */

function plugin_page() {

    /*
     * Use the add options_page function
     * add_options_page( $page_title, $menu_title, $capability, $menu-slug, $function )
     */

     add_options_page(
        __( 'Bootstrap Modals Plugin','bootstrap-modal' ), //$page_title
        __( 'Bootstrap Modals ', 'bootstrap-modal' ), //$menu_title
        'manage_options', //$capability
        'bootstrap-modal', //$menu-slug
        __NAMESPACE__ . '\\plugin_options_page' //$callbackfunction
      );
}
add_action( 'admin_menu', __NAMESPACE__ . '\\plugin_page' );


/**
 * Include the plugin option page.
 *
 * @since 1.3.0
 */

function plugin_options_page() {

    if( !current_user_can( 'manage_options' ) ) {

      wp_die( "Hall and Oates 'Say No Go'" );
    }

   require( 'inc/options-page-wrapper.php' );
}
