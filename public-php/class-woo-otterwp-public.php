<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class Otterwp_Woo_Public {

    /**
     * The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     */
    private $version;
	/**
	 * The plugin assets URL.
	 *
	 * @var string
	 */
	public $assets_url;
    /**
     * Initialize the class and set its properties.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }
	protected function init_hooks() {
		// Editor assets
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_block_editor_assets' ) );

		// Frontend assets
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );

		// Load textdomain
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

		// check version number on each request
		add_action( 'init', array( $this, 'check_version' ) );
        
       
	}
    /**
     * Register the stylesheets for the public-facing side of the site.
     */
    public function enqueue_styles() {

        
        
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __DIR__ ) . '/dist/assets/css/bundle.css', array(), $this->version, 'all');
        $inline_css = $this->get_inline_css();
        wp_add_inline_style( $this->plugin_name, $inline_css );


    }

 
    public function enqueue_scripts() {


  
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __DIR__ ) . '/dist/assets/js/bundle.js', array( 'jquery', 'flexslider', 'wc-single-product', 'zoom', 'photoswipe-ui-default',  'wc-add-to-cart-variation' ), $this->version, true);

        wp_localize_script( $this->plugin_name, 'wooOtterwpVars', array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce( 'woo-otterwp-cart-security' ),
                //'cart_type' => $options['cart_type'],
            )
        );
        wp_localize_script( $this->plugin_name, 'woo_my_ajax_object', array( 
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'woo-otterwp-security' ),
             ) 
        );
        wp_localize_script($this->plugin_name,
        "site",
        array(
                "theme_path"    => plugin_dir_url( '' ) . 'woocommerce/assets/js/frontend/add-to-cart-variation.min.js'
            )
    );

    }
    private function get_inline_css(){
        $css =  '';

        //print_r($css);
        
        $header_bg_height  = get_theme_mod( 'woo_otterwp_cart_header_height', 50 );
        $header_bg_color  = get_theme_mod( 'woo_otterwp_cart_header_bg_color', '#fff' );
        $body_bg_color  = get_theme_mod( 'woo_otterwp_cart_body_bg_color', '#b2b2b2' );
        $header_border_color  = get_theme_mod( 'woo_otterwp_cart_header_border_color', '#000' );
        $header_color  = get_theme_mod( 'woo_otterwp_cart_header_text_color', '#000' );
        $header_size  = get_theme_mod( 'woo_otterwp_cart_header_text_size', 20 );
        $footer_price_color  = get_theme_mod( 'woo_otterwp_cart_footer_item_price_color', '#000' );
        $footer_price_size  = get_theme_mod( 'woo_otterwp_cart_footer_price_size', 20 );
        $footer_item_color  = get_theme_mod( 'woo_otterwp_cart_footer_item_color', '#000' );
        $footer_item_size  = get_theme_mod( 'woo_otterwp_cart_footer_item_size', 20 );
        $footer_shadow_color  = get_theme_mod( ' footer_cart_shadow_alpha_color', 'rgba(0,0,0,0.15)' );
        $footer_shadow_offsetx  = get_theme_mod( 'woo_otter_footer_shadow_offsetx', 1 );
        $footer_shadow_offsety  = get_theme_mod( 'woo_otter_footer_shadow_offsety', 1 );
        $footer_shadow_blurr  = get_theme_mod( 'woo_otter_footer_shadow_blurr', 18 );
        $footer_shadow_spread  = get_theme_mod( 'woo_otter_footer_shadow_spread', 9 );
        $footer_shadow_button_color  = get_theme_mod( ' footer_cart_button_shadow_alpha_color', 'rgba(66,133,244,0.25)' );
        $footer_shadow_button_offsetx  = get_theme_mod( 'woo_otter_footer_button_shadow_offsetx', 1 );
        $footer_shadow_button_offsety  = get_theme_mod( 'woo_otter_footer_button_shadow_offsety', 1 );
        $footer_shadow_button_blurr  = get_theme_mod( 'woo_otter_footer_button_shadow_blurr', 47 );
        $footer_shadow_button_spread  = get_theme_mod( 'woo_otter_footer_button_shadow_spread', 14 );
        $footer_button_color  = get_theme_mod( 'footer_cart_button_alpha_color', '#1e73be' );
        $icon_color  = get_theme_mod( 'woo_otterwp_cart_icon_color', '#000' );
        $icon_text_color  = get_theme_mod( 'woo_otterwp_cart_text_color', '#000' );
        $icon_text_size  = get_theme_mod( 'woo_otterwp_cart_text_size', 17 );
        $floating_icon_bg_color  = get_theme_mod( 'woo_otterwp_floating_cart_bg_color', '#fff' );
        $floating_icon_border_radius  = get_theme_mod( 'woo_otterwp_floating_cart_border_radius', 17 );
        $floating_icon_padding  = get_theme_mod( 'woo_otterwp_floating_cart_padding', 5 );
        $floating_icon_shadow  = get_theme_mod( 'woo_otterwp_floating_cart_shadow', 17 );
        $floating_shadow_offsetx  = get_theme_mod( 'woo_otter_floating_cart_shadow_offsetx', 0 );
        $floating_shadow_offsety  = get_theme_mod( 'woo_otter_floating_cart_shadow_offsety', 0 );
        $floating_shadow_blurr  = get_theme_mod( 'woo_otterwp_floating_cart_shadow_blurr', 17 );
        $floating_shadow_spread  = get_theme_mod( 'woo_otterwp_floating_cart_shadow_spread', 17 );
        $floating_shadow_color  = get_theme_mod( 'floating_cart_shadow_alpha_color', 'rgba(0,0,0,0.15)' );
        $count_color  = get_theme_mod( 'woo_otterwp_cart_count_color', '#fff' );
        $count_bg_color  = get_theme_mod( 'woo_otterwp_cart_count_bg_color', '#0170B9' );
        $count_border_radius  = get_theme_mod( 'woo_otterwp_cart_count_border_radius', 10 );
        $count_size  = get_theme_mod( 'woo_otterwp_cart_count_text_size', 12 );
        $icon_size  = get_theme_mod( 'woo_otter_icon_size', 50 );
        $item_bg_color  = get_theme_mod( 'woo_otterwp_cart_item_bg_color', '#fff' );
        $item_border_color  = get_theme_mod( 'woo_otterwp_cart_item_border_color', '#000' );
        $item_border_size  = get_theme_mod( 'woo_otter_in_side_border_size', 0 );
        $item_title_color  = get_theme_mod( 'woo_otterwp_cart_item_title_color', '#000' );
        $item_price_color  = get_theme_mod( 'woo_otterwp_cart_item_price_color', '#000' );
        $item_input_color  = get_theme_mod( 'woo_otterwp_cart_item_input_color', '#000' );
        $item_subtotal_color  = get_theme_mod( 'woo_otterwp_cart_item_subtotal_color', '#000' );
        $item_padding  = get_theme_mod( 'woo_otter_in_side_padding_size', 5 );
        $item_title_font_size  = get_theme_mod( 'woo_otter_in_side_title_font_size', 15 );
        $item_subtotal_font_size  = get_theme_mod( 'woo_otter_in_side_subtotal_font_size', 15 );
        $item_price_font_size  = get_theme_mod( 'woo_otter_in_side_price_font_size', 15 );
        $item_border_radius  = get_theme_mod( 'woo_otter_in_side_border_radius_size', 10 );
        $item_shadow_color  = get_theme_mod( ' woo_otter_item_cart_shadow_alpha_color', 'rgba(0,0,0,0.15)' );
        $item_shadow_offsetx  = get_theme_mod( 'woo_otter_item_shadow_offsetx', 1 );
        $item_shadow_offsety  = get_theme_mod( 'woo_otter_item_shadow_offsety', 1 );
        $item_shadow_blurr  = get_theme_mod( 'woo_otter_item_shadow_blurr', 18 );
        $item_shadow_spread  = get_theme_mod( 'woo_otter_item_shadow_spread', 9 );
        $single_header_size  = get_theme_mod( 'woo_otterwp_header_size', 100 );
        $single_img_size  = get_theme_mod( 'woo_otterwp_header_image_size', 165 );
        $single_title_font_size  = get_theme_mod( 'woo_otterwp_header_title_text_size', 15 );
        $single_price_font_size  = get_theme_mod( 'woo_otterwp_header_price_text_size', 15 );
        $single_bg_color  = get_theme_mod( 'woo_otterwp_item_bg_color', '#fff' );
        $single_swipe_color  = get_theme_mod( 'woo_otterwp_swipe_color', 'rgba(0,0,0,0.15)' );
        $single_shadow_color  = get_theme_mod( 'woo_otter_single_shadow_alpha_color', 'rgba(0,0,0,0.15)' );
        $single_shadow_offsetx  = get_theme_mod( 'woo_otter_single_shadow_offsetx', 1 );
        $single_shadow_offsety  = get_theme_mod( 'woo_otter_single_shadow_offsety', 1 );
        $single_shadow_blurr  = get_theme_mod( 'woo_otter_single_shadow_blurr', 18 );
        $single_shadow_spread  = get_theme_mod( 'woo_otter_single_shadow_spread', 9 );
        $single_title_color  = get_theme_mod( 'woo_otterwp_title_color', '#000' );
        $single_price_color  = get_theme_mod( 'woo_otterwp_title_color', '#000' );
        $single_bg_body_color  = get_theme_mod( 'woo_otterwp_single_body_bg_color', '#fff' );
        $single_bg_title_color  = get_theme_mod( 'woo_otterwp_single_body_title_color', '#000' );
        $single_bg_text_color  = get_theme_mod( 'woo_otterwp_single_body_text_color', '#808285' );
        $minimize_background_color  = get_theme_mod( ' otter_woo_minimize_background_alpha_color', '#fff' );
        
        $css .= "
            .otter_container{
                background: {$body_bg_color};
            }
            .otter_head{
                background: {$header_bg_color};
                border-color: {$header_border_color};
                height: {$header_bg_height}px;     
            }
            .otter_cart_title{
               color: {$header_color}; 
               font-size: {$header_size}px;
            }
            .otter_items_scroll{
                top: {$header_bg_height}px;
            }
            .otter_close line{
                stroke: {$header_color};
            }
            .otter_open_count{
                color: {$count_color};
                background: {$count_bg_color};
                border-radius: {$count_border_radius}%;
                font-size: {$count_size}px;
            }
            .otter_icon_title{
                color: {$icon_text_color};
                font-size: {$icon_text_size}px;
            }
            .otter_open_image svg{
                width: {$icon_size}px;
                height: {$icon_size}px;
            }
            .otter_open_image{
                height: {$icon_size}px; 
            }
            .otter_open path{
                fill:{$icon_color}
            }
            .otw-floating-cart{
                border-radius: {$floating_icon_border_radius}px;
                background: {$floating_icon_bg_color};
                padding: {$floating_icon_padding}px;
            }
            .otter_woo_shadow.otw-floating-cart{
                box-shadow: {$floating_shadow_offsetx}px {$floating_shadow_offsety}px  {$floating_shadow_blurr}px {$floating_shadow_spread}px {$floating_shadow_color};
            }
            .otter_item_wrap{
                background: {$item_bg_color};
                border: {$item_border_size}px solid {$item_border_color};
                padding: {$item_padding}px;
                border-radius: {$item_border_radius}px;
            }
            .otter_woo_shadow.otter_item_wrap{
                box-shadow: {$item_shadow_offsetx}px {$item_shadow_offsety}px  {$item_shadow_blurr}px {$item_shadow_spread}px {$item_shadow_color};
            }
            .otter_item_title a{
                color: {$item_title_color};
                font-size: {$item_title_font_size}px;
            }
            .otter_item_delete svg{
                stroke: {$item_title_color};
            }
            .otter_item_price_wrap{
                color: {$item_price_color};
                font-size: {$item_price_font_size}px;
            }
            .otter_item_quanity_minus line, .otter_item_quanity_plus line{
                stroke:{$item_input_color}
            }
            .otter_item_total_price{
                color: {$item_subtotal_color};
                font-size: {$item_subtotal_font_size}px;
            }
            .otter_item_quanity_wrap .input.otter_item_quanity{
                color: {$item_subtotal_color};
            }
            .otter_footer_products{
                color: {$footer_item_color};
                font-size: {$footer_item_size}px;
            }
            .otter_flex .woocommerce-mini-cart__buttons a.button{
                background-color: {$footer_button_color};
                box-shadow: {$footer_shadow_button_offsetx}px {$footer_shadow_button_offsety}px  {$footer_shadow_button_blurr}px {$footer_shadow_button_spread}px {$footer_shadow_button_color};
            }
            .otter_footer{
                box-shadow: {$footer_shadow_offsetx}px {$footer_shadow_offsety}px  {$footer_shadow_blurr}px {$footer_shadow_spread}px {$footer_shadow_color};
            }
            .otter_footer_total{
                color: {$footer_price_color};
                font-size: {$footer_price_size}px;
            }
            .otw-top .otw-woo-reviews.otw-woo-reviews-open{
                height: calc(100vh - {$single_header_size}px);
                top: calc({$single_header_size}px + 40px);
            }
            .otw-top .otw-woo-reviews__body{
                height: calc(calc(100vh - calc(100vh - 100%)) - 48px);
            }
            .otw-woo-reviews-bg.otw-transition {
                height: calc(calc(100vh - calc(100vh - 100%)) - {$single_header_size}px - 41px);
                z-index: 9;
            }
            .otw-woocommerce-single.otw-top .otw-woocommerce-header{
                height: {$single_header_size}px;
            }
            .otw-woocommerce-header__content .product_title{
                font-size: {$single_title_font_size}px;
                color: {$single_title_color};
            }
            .otw-woocommerce-header__content .price{
                font-size: {$single_price_font_size}px;
                color: {$single_price_color};
            }
            .otw-woocommerce-single.otw-top{
                background-color: {$single_bg_color};
            }
            .otw-woo-reviews-bg{
                background-color: {$single_bg_color};
            }
            .otw-woocommerce-touch{
                top: calc({$single_header_size}px + 25px);
            }
            .otw-woocommerce-single.otw-top .otw-woocommerce-header::before{
                background: {$single_bg_body_color};
                box-shadow: {$single_shadow_offsetx}px {$single_shadow_offsety}px  {$single_shadow_blurr}px {$single_shadow_spread}px {$single_shadow_color};
                top: calc({$single_header_size}px + 25px);
            }
            .otw-woocommerce-single.otw-top .otw-woocommerce-header::after {
                background: {$single_swipe_color};
                top: calc({$single_header_size}px + 30px);
            }
            .otw-woocommerce-single.otw-bottom{
                background-color: {$single_bg_color};
            }
            .otw-woo-review, .otw-woo-reviews{
                box-shadow: {$single_shadow_offsetx}px {$single_shadow_offsety}px  {$single_shadow_blurr}px {$single_shadow_spread}px {$single_shadow_color};
            }
            .otw-woocommerce-single.otw-top .otw-woocommerce-header__thumbnail .attachment-woocommerce_thumbnail {
                width: {$single_img_size}px;
                height: auto;
                border-radius: 5px;
            }
            .otw-woocommerce-single.otw-top .otw-woocommerce-header__thumbnail {

            }
            .otw-woocommerce-single.otw-bottom .otw-woocommerce-header__content .product_title {
                font-size: 1rem;
                
            }
            .otw-woocommerce-single.otw-bottom .otw-woocommerce-header__content .price {
                font-size: 1rem;
            }
            .otw-minimize-btn{
                stroke: {$single_title_color};
            }
            .otw-woocommerce-single .otterwp-content .entry-content .summary h1, .entry-content h2, h2, h3, h4, h5, h6{
                color: {$single_bg_title_color};
            }
            .otw-woocommerce-single .otterwp-content p{
                color: {$single_bg_text_color};
            }
            .otw-woocommerce-single .otterwp-content div.product p.price{
                color: {$single_bg_text_color};
            }
            .otw-woocommerce-single .product_meta{
                color: {$single_bg_text_color};
            }
            .otw-woocommerce-single .related .products .product .price{
                color: {$single_bg_text_color};
            }
            .otw-woo-review__content p{
                color: {$single_bg_text_color};
            }
            .otw-woo-review, .otw-woo-reviews__body, .otw-woo-reviews__header{
                background-color: {$single_bg_color};
            }
            .otw-top .otw-woo-reviews__header::after{
                background: {$single_swipe_color};
            }
            .otw-woo-reviews__body .review .comment_container .comment-text{
                color: {$single_bg_text_color};
            }
        ";


        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        // backup values within single or double quotes
        preg_match_all('/(\'[^\']*?\'|"[^"]*?")/ims', $css, $hit, PREG_PATTERN_ORDER);
        for ($i=0; $i < count($hit[1]); $i++) {
            $css = str_replace($hit[1][$i], '##########' . $i . '##########', $css);
        }
        // remove traling semicolon of selector's last property
        $css = preg_replace('/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $css);
        // remove any whitespace between semicolon and property-name
        $css = preg_replace('/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $css);
        // remove any whitespace surrounding property-colon
        $css = preg_replace('/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $css);
        // remove any whitespace surrounding selector-comma
        $css = preg_replace('/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $css);
        // remove any whitespace surrounding opening parenthesis
        $css = preg_replace('/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $css);
        // remove any whitespace between numbers and units
        $css = preg_replace('/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $css);
        // shorten zero-values
        $css = preg_replace('/([^\d\.]0)(px|em|pt|%)/ims', '$1', $css);
        // constrain multiple whitespaces
        $css = preg_replace('/\p{Zs}+/ims',' ', $css);
        // remove newlines
        $css = str_replace(array("\r\n", "\r", "\n"), '', $css);
        // Restore backupped values within single or double quotes
        for ($i=0; $i < count($hit[1]); $i++) {
            $css = str_replace('##########' . $i . '##########', $hit[1][$i], $css);
        }


        return $css;
    }
/**
 * * Show Item
*/



public function otterwp_woo_load_more()
{

    $pid = intval($_POST['postid']);
    $args = array(
        'post_type' => 'product',
        'p'         => $pid, // ID of a page, post, or custom type
        'post_id' => $pid,
      );
    // $id = $product->get_id();
    $comments = get_comments( $args );
    $the_query  = new WP_Query($args);
    $data =  '';

    if ( $the_query-> have_posts() ) : ?>
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); {
            ob_start();
            include(plugin_dir_path(dirname(__FILE__)) . 'template-parts/ajax-single.php');
            $output = ob_get_contents();
            ob_end_clean();
            $data = $output;
            $cart['nonce'] = wp_create_nonce( 'woo-otterwp-security' );
    
    
        
}endwhile;

 endif;  wp_reset_postdata();
    echo $data;

    wp_die();
}

/**
 * Get Cart HTML
 */

public function get_cart_templates(){
    $floatingCart  = get_theme_mod( 'woo_otterwp_cart_floating_switch', 1 );
    $disableCart  = get_theme_mod( 'otter_woo_disable_cart_toggle', 1 );
    $cart_count = WC()->cart->cart_contents_count;
    $items = WC()->cart->get_cart();
    $cart_total = WC()->cart->get_cart_total();
    require_once plugin_dir_path( dirname( __FILE__ ) ).'template-parts/loading.php';
    if($disableCart === 1){ 
    require_once plugin_dir_path( dirname( __FILE__ ) ).'template-parts/mini-cart.php';
            if($floatingCart === 1){ 
                require_once plugin_dir_path( dirname( __FILE__ ) ).'template-parts/button.php';
            }
        }
    }
/**
 * Show Cart Items HTML
 */

public function show_cart_items_html(){
    $type = sanitize_text_field($_POST['type']);
    $cart = array(
        'html' => 0,
        'count' => 0,
        'total' => 0,
    );


        $items = WC()->cart->get_cart();
    
        ob_start();
        include plugin_dir_path( dirname( __FILE__ ) ).'template-parts/item.php';
        $output = ob_get_contents();
        ob_end_clean();
        $cart['html'] = $output;
        $cart['count'] = WC()->cart->cart_contents_count;
        $cart['total'] = WC()->cart->get_cart_total();
        $cart['nonce'] = wp_create_nonce( 'woo-otterwp-cart-security' );
    
    
    echo json_encode($cart);
    wp_die();
}
    /**
     * Delete Cart Item
     */

 public function delete_cart_item(){
        $key = sanitize_text_field($_POST['key']);
        $cart = array(
            'count' => 0,
            'total' => 0,
        );
        if ($key && wp_verify_nonce( $_POST['security'], 'woo-otterwp-cart-security' )){
            WC()->cart->remove_cart_item($key);
            $cart = array();
            $cart['count'] = WC()->cart->cart_contents_count;
            $cart['total'] = WC()->cart->get_cart_total();
        }
        echo json_encode( $cart );
        wp_die();
    }

  public function quanity_update(){
        $key = sanitize_text_field($_POST['key']);
        $number = intval(sanitize_text_field($_POST['number']));
        $cart = array(
            'count' => 0,
            'total' => 0,
            'item_price' => 0,
        );
        if($key && $number>0 && wp_verify_nonce( $_POST['security'], 'woo-otterwp-cart-security' )){
            WC()->cart->set_quantity( $key, $number );
            $items = WC()->cart->get_cart();
            $cart = array();
            $cart['count'] = WC()->cart->cart_contents_count;
            $cart['total'] = WC()->cart->get_cart_total();
            $cart['item_price'] = wc_price($items[$key]['line_total']);
        }
        echo json_encode( $cart );
        wp_die();
    }
        /**
     * Add To Cart
     */
    // add_action('wp_ajax_otter_add_to_cart', 'add_to_cart');    
    // add_action('wp_ajax_nopriv_otter_add_to_cart', 'add_to_cart');
   public function add_to_cart(){
        WC_AJAX::get_refreshed_fragments();
        wp_die();
    }
        /**
     * Remove Added to Cart Notice
     */
    public function remove_added_to_cart_notice(){
        return false;
    }
}