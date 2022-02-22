<?php
/** 
* Plugin Name: Otterwp Woocomerces Plugin
* Plugin URI: https://www.otterwp.io
* Description: Website on mobile comes with certain benefits that are under utilized on todays web. Otterwp Woo Mobile takes the best attributes and uses them to make an experience your shopper will love.
* Author: Cyrus Shahbazi
* Author URI https://www.otterwp.io
* Version: 1.0.1
* License: GPL2+
* License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
* @package Otterwp-woo-plugin
*/
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Currently plugin version.
 */
define( 'WAMC_INCONVER_VERSION', '1.0.2' );
if ( ! function_exists( 'wp_fs' ) ) {
    // Create a helper function for easy SDK access.
    function wp_fs() {
        global $wp_fs;

        if ( ! isset( $wp_fs ) ) {
            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/admin/freemius/start.php';

            $wp_fs = fs_dynamic_init( array(
                'id'                  => '9796',
                'slug'                => 'Otterwp-woo-plugin',
                'type'                => 'plugin',
                'public_key'          => 'pk_2e407d750bf1170e80dd6908d6bce',
                'is_premium'          => true,
                'is_premium_only'     => true,
                'has_addons'          => false,
                'has_paid_plans'      => true,
                'has_affiliation'     => 'selected',
                'menu'                => array(
                    'first-path'     => 'plugins.php',
                    'support'        => false,
                ),
                // Set the SDK to work in a sandbox mode (for development & testing).
                // IMPORTANT: MAKE SURE TO REMOVE SECRET KEY BEFORE DEPLOYMENT.
                'secret_key'          => 'undefined',
            ) );
        }

        return $wp_fs;
    }

    // Init Freemius.
    wp_fs();
    // Signal that SDK was initiated.
    do_action( 'wp_fs_loaded' );
}

                require_once plugin_dir_path( __FILE__ ) . 'lib/class-woo-otterwp.php';
	

				function run_woocommerce_ajax_mini_cart() {

					$plugin = new Otterwp_Woo_Plugin();
					$plugin->run();

				}
				run_woocommerce_ajax_mini_cart();
                