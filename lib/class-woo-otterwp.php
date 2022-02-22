<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Otterwp_Woo_Plugin {

/**
 * The loader that's responsible for maintaining and registering all hooks that power
 * the plugin.
 */
protected $loader;

/**
 * The unique identifier of this plugin.
 */
protected $plugin_name;

/**
 * The current version of the plugin.
 */
protected $version;

/**
 * Define the core functionality of the plugin.
 */
public function __construct() {
    if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
        $this->version = PLUGIN_NAME_VERSION;
    } else {
        $this->version = '1.0.0';
    }
    $this->plugin_name = 'woo-otterwp';
    $this->load_dependencies();
    $this->set_locale();
    $this->define_public_hooks(); 
    $this->define_admin_hooks();

}

/**
 * Load the required dependencies for this plugin.
 */
private function load_dependencies() {


    /**
     * The class responsible for orchestrating the actions and filters of the
     * core plugin.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'lib/class-woo-otterwp-loader.php';
    /**
	* The class responsible for defining internationalization functionality
	* of the plugin.
	*/
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'lib/class-woo-otterwp-i18n.php';
    /**
     * The class responsible for defining internationalization functionality
     * of the plugin.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'lib/class-otterwp-filter.php';
    /**
     * The class responsible for defining all actions that occur in the public-facing
     * side of the site.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public-php/class-woo-otterwp-public.php';
   /**
     *The class responsible for cart widget.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'lib/otterwp-woo-cart-widget.php';
   
    /**
     * The class responsible for defining all actions that occur in the customize area.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-woo-otterwp-admin.php';
   


    $this->loader = new OtterwpWooLoader();
    $this->filter = new otterwpFilter();
  
        }

/**
 * Define the locale for this plugin for internationalization.
 */
private function set_locale() {

    $plugin_i18n = new WooOtterwpi18n();

    $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

}

/**
 * Register all of the hooks related to the customizer area functionality
 * of the plugin.
 */
private function define_admin_hooks() {

    $plugin_admin = new Otterwp_Woo_Admin( $this->get_plugin_name(), $this->get_version() );

    $this->loader->add_action( 'customize_preview_init', $plugin_admin, 'otterwp_customizer_preview_scripts' );
    $this->loader->add_action( 'customize_register', $plugin_admin, '_themename_customize_register' );

}

/**
 * Register all of the hooks related to the public-facing functionality
 * of the plugin.
 */
private function define_public_hooks() {
    
    $plugin_public = new Otterwp_Woo_Public( $this->get_plugin_name(), $this->get_version() );

     $this->loader->add_action( 'wp_head', $plugin_public, 'enqueue_styles', 1);
     $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
     $this->loader->add_action( 'wp_footer', $plugin_public, 'get_cart_templates' );

     $this->loader->add_action( 'wp_ajax_otter_get_cart', $plugin_public, 'show_cart_items_html' );
     $this->loader->add_action( 'wp_ajax_nopriv_otter_get_cart', $plugin_public, 'show_cart_items_html' );

     $this->loader->add_action( 'wp_ajax_otter_quanity_update', $plugin_public, 'quanity_update' );
     $this->loader->add_action( 'wp_ajax_nopriv_otter_quanity_update', $plugin_public, 'quanity_update' );

     $this->loader->add_action( 'wp_ajax_otter_delete_item', $plugin_public, 'delete_cart_item' );
     $this->loader->add_action( 'wp_ajax_nopriv_otter_delete_item', $plugin_public, 'delete_cart_item' );

     $this->loader->add_action( 'wp_ajax_nopriv_otterwp_woo_load_more', $plugin_public, 'otterwp_woo_load_more' );
     $this->loader->add_action( 'wp_ajax_otterwp_woo_load_more', $plugin_public, 'otterwp_woo_load_more' );
    

     $this->loader->add_action( 'wp_ajax_otter_add_to_cart', $plugin_public, 'add_to_cart' );
     $this->loader->add_action( 'wp_ajax_nopriv_otter_add_to_cart', $plugin_public, 'add_to_cart' );

     $this->loader->add_filter( 'wc_add_to_cart_message_html', $plugin_public, 'remove_added_to_cart_notice' );

}

/**
 * Run the loader to execute all of the hooks with WordPress.
 */
public function run() {
    $this->loader->run();
}

/**
 * The name of the plugin used to uniquely identify it within the context of
 * WordPress and to define internationalization functionality.
 */
public function get_plugin_name() {
    return $this->plugin_name;
}

/**
 * The reference to the class that orchestrates the hooks with the plugin.
 */
public function get_loader() {
    return $this->loader;
}

/**
 * Retrieve the version number of the plugin.
 */
public function get_version() {
    return $this->version;
}




}
