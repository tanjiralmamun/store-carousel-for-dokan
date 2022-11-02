<?php
/**
 * Plugin Name: Store Carousel for Dokan
 * Plugin URI: https://wordpress.org/plugins/dokan-lite/
 * Description: A addon plugin for the Dokan Multivendor
 * Version: 1.0
 * Author: Tanjir
 * Author URI: https://tanjirsdev.com/
 * Text Domain: scf-dk
 * WC requires at least: 5.0.0
 * WC tested up to: 7.0.0
 * Domain Path: /languages/
 * License: GPL2
 */

/**
 * 
 * Enqueue plugin styles and scripts
 * 
 */
function scf_dk_scripts(){
    wp_register_style( 'scfd-flexslider', plugin_dir_url( __FILE__ ).'assets/css/flexslider.css', [], '2.2.0' );
    wp_register_style( 'scfd-styles', plugin_dir_url( __FILE__ ).'assets/css/styles.css', [ 'dokan-follow-store' ], get_plugin_data( __FILE__ )["Version"] );

    wp_register_script( 'scfd-scripts', plugin_dir_url( __FILE__ ).'assets/js/scripts.js', [ 'jquery', 'flexslider', 'dokan-follow-store' ], get_plugin_data( __FILE__ )["Version"], true );
}
add_action( 'wp_enqueue_scripts', 'scf_dk_scripts' );

/**
 * 
 * Shortcode function
 * 
 */
function dokan_store_carousel_func( $atts ){

    if( class_exists( 'Dokan_Pro' ) && class_exists( 'WooCommerce' ) ){

        /**
         * 
         * Enqueue Style & Scripts
         * 
         */
        wp_enqueue_style( 'scfd-flexslider' );
        wp_enqueue_style( 'scfd-styles' );

        wp_enqueue_script( 'scfd-scripts' );

        /**
         * 
         * Shortcode Contents
         * 
         */
        $default_atts = shortcode_atts( [
            'category'  => 'uncategorized',
            'limit'     => '5'
        ], $atts );

        $sellers    = dokan_get_sellers();

        ob_start();

        require_once dirname( __FILE__ ) . '/scfd-store-list-content.php';

        $content = ob_get_clean();

        return $content;

    }

}
add_shortcode( 'dokan_store_carousel', 'dokan_store_carousel_func' );