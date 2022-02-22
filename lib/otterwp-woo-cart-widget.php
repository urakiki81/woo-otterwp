<?php
/**
 * Otterwp Woo cart widget 
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

class otterwp_woo_cart extends WP_Widget {

    public function __construct() {
        
        parent::__construct(
            'otterwp_woo_cart',
            esc_html__('Otterwp Woo Cart', '_themename'),
            array(
                'description' => esc_html__('some description', 'woo-otterwp'),
                'customize_selective_refresh' => true
            )
        );
    }



    public function widget($args, $instance) {
        echo $args['before_widget'];
        $disableCart  = get_theme_mod( 'otter_woo_disable_cart_toggle', 1 );    
        $iconCart  = get_theme_mod( 'otter_woo_icon_display', 1 );
        $iconCount  = get_theme_mod( 'otter_woo_icon_count_display', 1 );
        $iconText  = get_theme_mod( 'otter_woo_icon_text_display', 0 );
        $value = get_theme_mod( 'otter_woo_icon_type', 'cart' );
        $title = get_theme_mod('woo_otter_cart_icon_text_setting', __('Cart', 'OtterWoo'));
        if($disableCart === 1){ 
         echo '<div class="otter_open">';

         if($iconCart === 1){ 
            echo '<div class="otter_open_image">';
        if ($value === 'cart') { 
        
                        echo '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 459.529 459.529" style="enable-background:new 0 0 459.529 459.529;" xml:space="preserve"><g><path d="M17,55.231h48.733l69.417,251.033c1.983,7.367,8.783,12.467,16.433,12.467h213.35c6.8,0,12.75-3.967,15.583-10.2
                        l77.633-178.5c2.267-5.383,1.7-11.333-1.417-16.15c-3.117-4.817-8.5-7.65-14.167-7.65H206.833c-9.35,0-17,7.65-17,17
                        s7.65,17,17,17H416.5l-62.9,144.5H164.333L94.917,33.698c-1.983-7.367-8.783-12.467-16.433-12.467H17c-9.35,0-17,7.65-17,17
                        S7.65,55.231,17,55.231z"/>
                        <path d="M135.433,438.298c21.25,0,38.533-17.283,38.533-38.533s-17.283-38.533-38.533-38.533S96.9,378.514,96.9,399.764
                        S114.183,438.298,135.433,438.298z"/>
                        <path d="M376.267,438.298c0.85,0,1.983,0,2.833,0c10.2-0.85,19.55-5.383,26.35-13.317c6.8-7.65,9.917-17.567,9.35-28.05
                        c-1.417-20.967-19.833-37.117-41.083-35.7c-21.25,1.417-37.117,20.117-35.7,41.083
                        C339.433,422.431,356.15,438.298,376.267,438.298z"/>
                        </g></svg>';

        }
                if ($value === 'bag') { 

                        echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="98" height="93" viewBox="0 0 18 23" version="1.1">
                        <g stroke="none" stroke-width="2" fill="none" fill-rule="evenodd">
                          <g transform="translate(-1225.000000, -10.000000)">
                            <path id="shopping-bag" d="M1239.9 15C1239.4 12.2 1237 10 1234 10 1231 10 1228.6 12.2 1228.1 15L1227 15C1225.9 15 1225 15.9 1225 17L1225 31C1225 32.1 1225.9 33 1227 33L1241 33C1242.1 33 1243 32.1 1243 31L1243 17C1243 15.9 1242.1 15 1241 15L1239.9 15 1239.9 15 1239.9 15ZM1238.9 15C1238.4 12.7 1236.4 11 1234 11 1231.6 11 1229.6 12.7 1229.1 15L1238.9 15 1238.9 15 1238.9 15ZM1226 17C1226 16.4 1226.4 16 1227 16L1241 16C1241.6 16 1242 16.4 1242 17L1242 31C1242 31.6 1241.6 32 1241 32L1227 32C1226.4 32 1226 31.6 1226 31L1226 17 1226 17 1226 17Z"/>
                          </g>
                        </g>
                      </svg>';
                }
                if ($value === 'basket') { 
                        echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 256 256" xml:space="preserve">
                        <g transform="translate(128 128) scale(0.72 0.72)">
                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(-175.05 -175.05000000000004) scale(3.89 3.89)" >
                            <path d="M 89.317 27.68 c -0.739 -0.955 -1.973 -1.526 -3.3 -1.526 H 71.888 L 56.032 10.297 c -0.579 -0.579 -1.518 -0.579 -2.098 0 c -0.579 0.579 -0.579 1.518 0 2.098 l 13.759 13.759 H 22.307 l 13.759 -13.759 c 0.58 -0.579 0.58 -1.519 0 -2.098 c -0.58 -0.579 -1.518 -0.579 -2.098 0 L 18.112 26.154 H 3.983 c -1.329 0 -2.562 0.571 -3.301 1.527 c -0.616 0.796 -0.828 1.796 -0.582 2.74 l 12.222 47.012 c 0.413 1.593 2.01 2.704 3.883 2.704 h 57.59 c 1.872 0 3.469 -1.112 3.884 -2.704 L 89.9 30.42 C 90.146 29.475 89.933 28.476 89.317 27.68 z M 87.028 29.674 L 74.806 76.686 c -0.051 0.198 -0.44 0.484 -1.011 0.484 h -57.59 c -0.571 0 -0.96 -0.286 -1.012 -0.483 L 2.972 29.674 c -0.007 -0.027 -0.02 -0.078 0.058 -0.179 c 0.133 -0.172 0.463 -0.374 0.954 -0.374 h 82.033 c 0.49 0 0.82 0.201 0.953 0.374 C 87.048 29.597 87.036 29.648 87.028 29.674 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path d="M 45 38.337 c -0.82 0 -1.484 0.664 -1.484 1.484 v 27.923 c 0 0.819 0.664 1.484 1.484 1.484 s 1.484 -0.664 1.484 -1.484 V 39.821 C 46.483 39.001 45.819 38.337 45 38.337 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path d="M 59.835 38.337 c -0.819 0 -1.484 0.664 -1.484 1.484 v 27.923 c 0 0.819 0.664 1.484 1.484 1.484 c 0.819 0 1.484 -0.664 1.484 -1.484 V 39.821 C 61.319 39.001 60.654 38.337 59.835 38.337 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path d="M 30.164 38.337 c -0.82 0 -1.484 0.664 -1.484 1.484 v 27.923 c 0 0.819 0.664 1.484 1.484 1.484 s 1.484 -0.664 1.484 -1.484 V 39.821 C 31.648 39.001 30.984 38.337 30.164 38.337 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                        </g>
                        </g>
                        </svg>';
                

             
                }
                echo '</div>';
            }
            if($iconText === 1){ 
                echo '<p class="otter_icon_title">';
                echo $title;
                echo '</p>';
                }
            if($iconCount === 1){ 
                echo '<div class="otter_open_count">';
                    echo $cart_count = WC()->cart->cart_contents_count;  
                echo '</div>';
            }
            echo '</div>';
        echo $args['after_widget'];
    }

    }
}

function otterwp_woo_register_most_recent_widget() {
    register_widget('otterwp_woo_cart');
}

add_action('widgets_init', 'otterwp_woo_register_most_recent_widget');