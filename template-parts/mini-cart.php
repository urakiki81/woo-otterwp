<?php
/**
 * Mini cart body template
 *
 * @package     Otterwp
 * @author      Cyrus Shahbazi
 * @link        https://www.otterwp.io/
 * @since       Otterwp 1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$slider_out  = get_theme_mod( 'otter_woo_cart_add_display', 1 );
?>
<div class="otter_bg"></div><!--- .otter_bg --->
<div class="otter_container_wrap otter_container_wrap <?php if($slider_out === 1){ echo 'otter_woo_slide';}?> ">
    <div class="otter_container otter_container_side">
        <div class="otter_head">
            <div class="otter_head_title otter_center"> <h2 class="otter_cart_title"><?php echo wp_kses_post(get_theme_mod( 'woo_otter_cart_text_setting')); ?></h2></div><!--- .otter_head_title --->
            <div class="otter_close">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.008 16.008">
                    <g transform="translate(-1865.147 -163.146)">
                        <line x1="15.301" y2="15.301" transform="translate(1865.5 163.5)"/>
                        <line x2="15.301" y2="15.301" transform="translate(1865.5 163.5)"/>
                    </g>
                </svg>
            </div><!--- .otter_close --->
        </div><!--- .otter_head --->
        <div class="otter_items_scroll">
            <div class="otter_items_wrap otter_center">
                <div class="otter_items_loading">
                    <div class="otw-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                </div><!--- .otter_items_loading --->
                <div class="otter_items">
                    <?php require_once plugin_dir_path( dirname( __FILE__ ) ).'template-parts/item.php'; ?>
                </div><!--- .otter_items --->
            </div><!--- .otter_items_wrap --->
        </div><!--- .otter_items_scroll --->


        <div class="otter_footer">
            <div class="otter_center otter_flex">
                <div class="otter_flex">
                    <div class="otter_footer_lines">
                        <div class="otter_footer_products">
                        <p><?php echo _e('Item Total', 'woo-otterwp'); ?></P> 
                            <div class="otter_value"><p><?php echo $cart_count; ?></p></div><!--- .otter_value --->
                        </div><!--- .otter_footer_products --->
                            <div class="otter_footer_total">
                                    <div class="otter_subtotale"><?php echo _e('Subtotal', 'woo-otterwp'); ?></div><!--- .otter_subtotale --->
                                    <div class="otter_value"><?php echo $cart_total; ?></div><!--- .otter_value --->
                            </div><!--- .otter_footer_total --->
                        </div><!--- .otter_flex --->
                    </div><!--- .otter_footer_lines --->
                </div><!--- .otter_flex --->

                <div class="otter_flex">
                <p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>
                </div><!--- .otter_flex --->
            </div><!--- .otter_center --->
        </div><!--- .otter_footer --->
    </div><!--- .otter_container --->
</div><!--- otter_container_wrap --->
<div class="otw-loading">
                    <div class="otw-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div><!--- otw-loading --->