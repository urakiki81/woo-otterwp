<?php
/**
 * Otterwp woocomerces filters
 *
 *
 * @package     Otterwp-woo-plugin
 * @link        https://www.otterwp.io/
 * @since       1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class otterwpFilter {

    private $stuff;

    public function __construct() {

        $this->stuff = $this->otterwp_filters();

    }

    public function otterwp_filters() {

        add_filter( 'page_template', 'wpa3396_page_template' );
        add_filter( 'post_class', 'filter_product_post_class', 10, 3 );
        remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
        
        add_action( 'woocommerce_before_shop_loop_item', 'otterwp_add_data_for_ajax', 10 );
        add_action('woocommerce_shop_loop_item_title', 'product_heading_title_on_category_archives', 1 );
         function filter_product_post_class( $classes, $class, $product_id ){
            // Only on shop page
            if( is_shop() )
                $classes[] = 'otw-woo-ative';
        
            return $classes;
        }
     
    
     function wpa3396_page_template( $page_template ){
     
         if ( get_page_template_slug() == 'template-configurator.php' ) {
             $page_template = dirname( __FILE__ ) . 'template-parts/ajax-single.php';
         }
         return $page_template;
     }

     
     function otterwp_add_data_for_ajax() {
     echo '<div data-id='. get_the_ID() .' class="otter-woo-data" >';
     }
  
     function product_heading_title_on_category_archives() {
         if( is_shop() ) { 
             remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
             add_action('woocommerce_shop_loop_item_title', 'change_product_heading_title', 10 );
         }
         if( is_product_category() ) {
             remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
             add_action('woocommerce_shop_loop_item_title', 'change_product_heading_title', 10 );
         }
     }
     function change_product_heading_title() {
         echo '<h2 data-id='. get_the_ID() .'"class="otter-woo-data ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h2>';
     }
     function sunset_grab_url()
{
    if (!preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links)) {
        return false;
    }

    return esc_url_raw($links[1]);
}

function sunset_grab_current_uri()
{
    $http = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://');
    $referer = $http.$_SERVER['HTTP_HOST'];
    $archive_url = $referer.$_SERVER['REQUEST_URI'];

    return $archive_url;
}
function sunset_check_paged($num = null)
{
    $output = '';

    if (is_paged()) {
        $output = 'page/'.get_query_var('paged');
    }

    if ($num == 1) {
        $paged = (get_query_var('paged') == 0 ? 1 : get_query_var('paged'));

        return $paged;
    } else {
        return $output;
    }
}

}
}