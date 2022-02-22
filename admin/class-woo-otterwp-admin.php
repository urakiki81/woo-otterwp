<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Otterwp_Woo_Admin{

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

    /**
     * Initialize the Customizer Preview.
     */
 
    public function otterwp_customizer_preview_scripts() {

        wp_enqueue_script( 'otterwp-customizer-preview', plugin_dir_url( __DIR__ ) . '/dist/assets/js/customize-preview.js', array( 'customize-preview', 'jquery' ), $this->version, true);

	}
    public function _themename_customize_register( $wp_customize ) {

        require_once trailingslashit( dirname(__FILE__) ) . 'custom-controls.php';
        
        $wp_customize->add_panel( 'otterwp_woo_options',
        array(
           'title' => __( 'OtterWP Woo Options', 'woo-otterwp' ),
           'description' => esc_html__( 'Adjust your Header and Navigation sections.', 'woo-otterwp' )
       )
    );

/*################## CART BODY SETTINGS ########################*/
$wp_customize->add_section('otterwp_woo_cart_options', array(
    'title' => esc_html__( 'Cart Options', 'woo-otterwp' ),
    'description' => esc_html__( 'You can change shopping cart options from here.', 'woo-otterwp' ),
    'panel' => 'otterwp_woo_options'
  ));

  $wp_customize->add_setting( 'woo_otter_cart_text_setting', array(
    'default' => __( 'Cart', 'woo-otterwp' ),
    'transport' => 'postMessage',
    'sanitize_callback' => 'otterwp_text_sanitization',
  ) );
  
  $wp_customize->add_control( 'woo_otter_cart_text_setting', array(
    'type' => 'text',
    'section' => 'otterwp_woo_cart_options', 
    'active_callback'   => 'woo_otterwp_disable_cart_active'
    
  ) );
  $wp_customize->selective_refresh->add_partial( 'woo_otter_cart_text_refresh', array(
    'selector' => '.otter_head_title',
    'settings' => array( 'woo_otter_cart_text_setting' ),
    'container_inclusive' => true,
    'fallback_refresh'    => false,
    'render_callback' => 'woo_otter_cart_text',
  ) );

    $wp_customize->add_setting( 'otter_woo_cart_add_display',
    array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'otterwp_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Otterwp_Toggle_Switch_Custom_control( $wp_customize, 'otter_woo_cart_add_display',
        array(
            'label' => __( 'Display Cart On Add To Cart', 'woo-otterwp' ),
            'description' => esc_html__( 'This is the control will make the cart open when a items is add to it.' ),
            'section' => 'otterwp_woo_cart_options'
        )
    ) );
    $wp_customize->add_setting( 'otter_woo_disable_cart_toggle',
    array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'otterwp_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Otterwp_Toggle_Switch_Custom_control( $wp_customize, 'otter_woo_disable_cart_toggle',
        array(
            'label' => __( 'Disable Cart', 'woo-otterwp'),
            'section' => 'otterwp_woo_cart_options',
            'active_callback' => 'woo_otterwp_floating_active',
        )
    ) );
    $wp_customize->add_setting('woo_otterwp_cart_header_bg_color', array(
        'default' => '#fff',
        'transport' => 'postMessage',
        'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
    ));
    $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_header_bg_color', array(
        'label' => __('Choose Header Background Color', 'woo-otterwp'),
        'section' => 'otterwp_woo_cart_options',
        'settings' => 'woo_otterwp_cart_header_bg_color',
        'active_callback'   => 'woo_otterwp_disable_cart_active'
    
    )));
    $wp_customize->add_setting('woo_otterwp_cart_header_border_color', array(
        'default' => '#000',
        'transport' => 'postMessage',
        'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
    ));
    $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_header_border_color', array(
        'label' => __('Choose Header Border Color', 'woo-otterwp'),
        'section' => 'otterwp_woo_cart_options',
        'settings' => 'woo_otterwp_cart_header_border_color',
        'active_callback'   => 'woo_otterwp_disable_cart_active'
    
    )));
    $wp_customize->add_setting('woo_otterwp_cart_header_text_color', array(
        'default' => '#000',
        'transport' => 'postMessage',
        'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
    ));
    $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_header_text_color', array(
        'label' => __('Choose Cart Header Text Color', 'woo-otterwp'),
        'section' => 'otterwp_woo_cart_options',
        'settings' => 'woo_otterwp_cart_header_text_color',
        'active_callback'   => 'woo_otterwp_disable_cart_active'
    )));
    $wp_customize->add_setting( 'woo_otterwp_cart_header_text_size',
    array(
        'default' => 20,
        'transport' => 'postMessage',
        'sanitize_callback' => 'otterwp_range_sanitization'
    )
    );
    $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otterwp_cart_header_text_size',
        array(
            'label' => __( 'Header Font Size (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_options',
            'active_callback'   => 'woo_otterwp_disable_cart_active',
            'input_attrs' => array(
                'min' => 10,
                'max' => 90,
                'step' => 1,
            ),
        )
    ) );
    $wp_customize->add_setting( 'woo_otterwp_cart_header_height',
    array(
        'default' => 55,
        'transport' => 'postMessage',
        'sanitize_callback' => 'otterwp_range_sanitization'
    )
    );
    $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_header_height',
        array(
            'label' => __( 'Header Height (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_options',
            'active_callback'   => 'woo_otterwp_disable_cart_active',
            'input_attrs' => array(
                'min' => 25,
                'max' => 75,
                'step' => 1,
            ),
        )
    ) );
    $wp_customize->add_setting('woo_otterwp_cart_body_bg_color', array(
        'default' => '#b2b2b2',
        'transport' => 'postMessage',
        'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
    ));
    $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_body_bg_color', array(
        'label' => __('Choose Cart Body Background Color', 'woo-otterwp'),
        'section' => 'otterwp_woo_cart_options',
        'settings' => 'woo_otterwp_cart_body_bg_color',
        'active_callback'   => 'woo_otterwp_disable_cart_active'
    )));
    $wp_customize->add_setting('woo_otterwp_cart_footer_bg_color', array(
        'default' => '#fff',
        'transport' => 'postMessage',
        'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
    ));
    $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_footer_bg_color', array(
        'label' => __('Choose Cart Footer Background Color', 'woo-otterwp'),
        'section' => 'otterwp_woo_cart_options',
        'settings' => 'woo_otterwp_cart_footer_bg_color',
        'active_callback'   => 'woo_otterwp_disable_cart_active'
    )));
    $wp_customize->add_setting('woo_otterwp_cart_footer_item_color', array(
        'default' => '#000',
        'transport' => 'postMessage',
        'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
    ));
    $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_footer_item_color', array(
        'label' => __('Choose Footer Item Text Color', 'woo-otterwp'),
        'section' => 'otterwp_woo_cart_options',
        'settings' => 'woo_otterwp_cart_footer_item_color',
        'active_callback'   => 'woo_otterwp_disable_cart_active'
    )));
    $wp_customize->add_setting('woo_otterwp_cart_footer_item_price_color', array(
        'default' => '#000',
        'transport' => 'postMessage',
        'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
    ));
    $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_footer_item_price_color', array(
        'label' => __('Choose Footer Price Text Color', 'woo-otterwp'),
        'section' => 'otterwp_woo_cart_options',
        'settings' => 'woo_otterwp_cart_footer_item_price_color',
        'active_callback'   => 'woo_otterwp_disable_cart_active'
    )));
    $wp_customize->add_setting( 'footer_cart_button_alpha_color',
    array(
        'default' => '#1e73be',
        'transport' => 'postMessage',
        'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
    )
);
    $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'footer_cart_button_alpha_color',
        array(
            'label' => __( 'Choose Footer button Color' ),
            'description' => esc_html__( 'Sample custom control description' , 'woo-otterwp'),
            'section' => 'otterwp_woo_cart_options',
            'show_opacity' => true, 
            'active_callback'   => 'woo_otterwp_disable_cart_active'
        )
    ) );
    $wp_customize->add_setting( 'woo_otterwp_cart_footer_item_size',
        array(
            'default' => 15,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
    );
    $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otterwp_cart_footer_item_size',
        array(
            'label' => __( 'Footer Item Font Size (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_options',
            'active_callback'   => 'woo_otterwp_disable_cart_active',
            'input_attrs' => array(
                'min' => 10,
                'max' => 90,
                'step' => 1,
            ),
        )
    ) );
    $wp_customize->add_setting( 'woo_otterwp_cart_footer_price_size',
    array(
        'default' => 15,
        'transport' => 'postMessage',
        'sanitize_callback' => 'otterwp_range_sanitization'
    )
    );
    $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otterwp_cart_footer_price_size',
        array(
            'label' => __( 'Footer Price Font Size (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_options',
            'active_callback'   => 'woo_otterwp_disable_cart_active',
            'input_attrs' => array(
                'min' => 10,
                'max' => 90,
                'step' => 1,
            ),
        )
    ) );


    $wp_customize->add_setting( 'woo_otter_footer_shadow_offsetx',
        array(
            'default' => 3,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
    $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_footer_shadow_offsetx',
        array(
            'label' => __( 'Footer Shadow Offset-X (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_options',
            'active_callback'   => 'woo_otterwp_disable_cart_active',
            'input_attrs' => array(
                'min' => 1,
                'max' => 90,
                'step' => 1,
            ),
        )
        ) );
    $wp_customize->add_setting( 'woo_otter_footer_shadow_offsety',
        array(
            'default' => 3,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
    $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_footer_shadow_offsety',
        array(
            'label' => __( 'Footer Shadow Offset-y (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_options',
            'active_callback'   => 'woo_otterwp_disable_cart_active',
            'input_attrs' => array(
                'min' => -30,
                'max' => 30,
                'step' => 1,
            ),
        )
        ) );
    $wp_customize->add_setting( 'woo_otter_footer_shadow_blurr',
        array(
            'default' => 18,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
    $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_footer_shadow_blurr',
        array(
            'label' => __( 'Footer Shadow Blur Radius (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_options',
            'active_callback'   => 'woo_otterwp_disable_cart_active',
            'input_attrs' => array(
                'min' => -30,
                'max' => 30,
                'step' => 1,
            ),
        )
        ) );
    $wp_customize->add_setting( 'woo_otter_footer_shadow_spread',
        array(
            'default' => 10,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
    $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_footer_shadow_spread',
        array(
            'label' => __( 'Footer Shadow Spread Radius (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_options',
            'active_callback'   => 'woo_otterwp_disable_cart_active',
            'input_attrs' => array(
                'min' => 1,
                'max' => 90,
                'step' => 1,
            ),
        )
        ) );
    $wp_customize->add_setting( 'footer_cart_shadow_alpha_color',
        array(
            'default' => 'rgba(0,0,0,0.15)',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        )
    );
    $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'footer_cart_shadow_alpha_color',
        array(
            'label' => __( 'Footer Shadow Color', 'woo-otterwp'),
            'description' => esc_html__( 'Sample custom control description', 'woo-otterwp'),
            'section' => 'otterwp_woo_cart_options',
            'show_opacity' => true, 
            'active_callback'   => 'woo_otterwp_disable_cart_active'
        )
    ) );
    $wp_customize->add_setting( 'woo_otter_footer_button_shadow_offsetx',
        array(
            'default' => 1,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
    $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_footer_button_shadow_offsetx',
        array(
            'label' => __( 'Button Shadow Offset-X (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_options',
            'active_callback'   => 'woo_otterwp_disable_cart_active',
            'input_attrs' => array(
                'min' => 1,
                'max' => 90,
                'step' => 1,
            ),
        )
        ) );
    $wp_customize->add_setting( 'woo_otter_footer_button_shadow_offsety',
        array(
            'default' => 1,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
    $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_footer_button_shadow_offsety',
        array(
            'label' => __( 'Button Shadow Offset-y (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_options',
            'active_callback'   => 'woo_otterwp_disable_cart_active',
            'input_attrs' => array(
                'min' => 1,
                'max' => 90,
                'step' => 1,
            ),
        )
        ) );
    $wp_customize->add_setting( 'woo_otter_footer_button_shadow_blurr',
        array(
            'default' => 47,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
    $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_footer_button_shadow_blurr',
        array(
            'label' => __( 'Button Shadow Blur Radius (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_options',
            'active_callback'   => 'woo_otterwp_disable_cart_active',
            'input_attrs' => array(
                'min' => 1,
                'max' => 90,
                'step' => 1,
            ),
        )
        ) );
    $wp_customize->add_setting( 'woo_otter_footer_button_shadow_spread',
        array(
            'default' => 14,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
    $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_footer_button_shadow_spread',
        array(
            'label' => __( 'Button Shadow Spread Radius (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_options',
            'active_callback'   => 'woo_otterwp_disable_cart_active',
            'input_attrs' => array(
                'min' => 1,
                'max' => 90,
                'step' => 1,
            ),
        )
        ) );
    $wp_customize->add_setting( 'footer_cart_button_shadow_alpha_color',
        array(
            'default' => 'rgba(66,133,244,0.25)',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        )
    );
    $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'footer_cart_button_shadow_alpha_color',
        array(
            'label' => __( 'Button Shadow Color', 'woo-otterwp'),
            'section' => 'otterwp_woo_cart_options',
            'show_opacity' => true, 
            'active_callback'   => 'woo_otterwp_disable_cart_active'
        )
    ) );
/*################## CART ITEMS SETTINGS ########################*/
         $wp_customize->add_section('otterwp_woo_cart_items_options', array(
            'title' => __( 'Cart Item Options', 'woo-otterwp' ),
            'description' => __( 'You can change shopping cart options from here.', 'otterwp' ),
            'panel' => 'otterwp_woo_options',
            'active_callback'   => 'woo_otterwp_disable_cart_active'
        ));
        $wp_customize->add_setting('woo_otterwp_cart_item_bg_color', array(
            'default' => '#fff',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        ));
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_item_bg_color', array(
            'label' => __('Choose Item Background Color', 'woo-otterwp'),
            'section' => 'otterwp_woo_cart_items_options',
            'settings' => 'woo_otterwp_cart_item_bg_color'
        
        )));
        $wp_customize->add_setting('woo_otterwp_cart_item_title_color', array(
            'default' => '#000',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        ));
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_item_title_color', array(
            'label' => __('Choose Item Title Color', 'woo-otterwp'),
            'section' => 'otterwp_woo_cart_items_options',
            'settings' => 'woo_otterwp_cart_item_title_color'
        )));
        $wp_customize->add_setting('woo_otterwp_cart_item_price_color', array(
            'default' => '#000',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        ));
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_item_price_color', array(
            'label' => __('Choose Item Price Color', 'woo-otterwp'),
            'section' => 'otterwp_woo_cart_items_options',
            'settings' => 'woo_otterwp_cart_item_price_color'
        )));
        $wp_customize->add_setting('woo_otterwp_cart_item_input_color', array(
            'default' => '#000',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        ));
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_item_input_color', array(
            'label' => __('Choose Item Input Color', 'woo-otterwp'),
            'section' => 'otterwp_woo_cart_items_options',
            'settings' => 'woo_otterwp_cart_item_input_color'
        )));
        $wp_customize->add_setting('woo_otterwp_cart_item_subtotal_color', array(
            'default' => '#000',
            'transport' => 'postMessage',
        ));
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_item_subtotal_color', array(
            'label' => __('Choose Item Subtotal Color', 'woo-otterwp'),
            'section' => 'otterwp_woo_cart_items_options',
            'settings' => 'woo_otterwp_cart_item_subtotal_color'
        )));
        $wp_customize->add_setting('woo_otterwp_cart_item_border_color', array(
            'default' => '#000',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        ));
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_item_border_color', array(
            'label' => __('Choose Item Border Color', 'woo-otterwp'),
            'section' => 'otterwp_woo_cart_items_options',
            'settings' => 'woo_otterwp_cart_item_border_color'
        
        )));
        $wp_customize->add_setting( 'woo_otter_in_side_title_font_size',
        array(
            'default' => 15,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_in_side_title_font_size',
            array(
                'label' => __( 'Title Font Size (px)', 'woo-otterwp' ),
                'section' => 'otterwp_woo_cart_items_options',
                'input_attrs' => array(
                    'min' => 10,
                    'max' => 90,
                    'step' => 1,
                ),
            )
        ) );
        $wp_customize->add_setting( 'woo_otter_in_side_price_font_size',
        array(
            'default' => 15,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_in_side_price_font_size',
            array(
                'label' => __( 'Price Font Size (px)', 'woo-otterwp' ),
                'section' => 'otterwp_woo_cart_items_options',
                'input_attrs' => array(
                    'min' => 10,
                    'max' => 90,
                    'step' => 1,
                ),
            )
        ) );
        $wp_customize->add_setting( 'woo_otter_in_side_subtotal_font_size',
        array(
            'default' => 15,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_in_side_subtotal_font_size',
            array(
                'label' => __( 'Subtotal Font Size (px)', 'woo-otterwp' ),
                'section' => 'otterwp_woo_cart_items_options',
                'input_attrs' => array(
                    'min' => 10,
                    'max' => 18,
                    'step' => 1,
                ),
            )
        ) );
        $wp_customize->add_setting( 'woo_otter_in_side_border_size',
        array(
            'default' => .5,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_in_side_border_size',
            array(
                'label' => __( 'In Cart Item Border Size (px)', 'woo-otterwp' ),
                'section' => 'otterwp_woo_cart_items_options',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 2,
                    'step' => .1,
                ),
            )
        ) );
        $wp_customize->add_setting( 'woo_otter_in_side_border_radius_size',
        array(
            'default' => 10,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_in_side_border_radius_size',
            array(
                'label' => __( 'In Cart Item Border Radius (px)', 'woo-otterwp' ),
                'section' => 'otterwp_woo_cart_items_options',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 20,
                    'step' => 1,
                ),
            )
        ) );

        $wp_customize->add_setting( 'woo_otter_in_side_padding_size',
        array(
            'default' => 5,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_in_side_padding_size',
        array(
            'label' => __( 'Item Padding (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_items_options',
            'input_attrs' => array(
                'min' => 0,
                'max' => 90,
                'step' => 1,
            ),
        )
        ) );
        $wp_customize->add_setting( 'otter_woo_item_shadow_toggle',
        array(
            'default' => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'otterwp_switch_sanitization'
        )
        );
        $wp_customize->add_control( new Otterwp_Toggle_Switch_Custom_control( $wp_customize, 'otter_woo_item_shadow_toggle',
            array(
                'label' => __( 'Display Shadow', 'woo-otterwp' ),
                'section' => 'otterwp_woo_cart_items_options',
            )
        ) );
        
        $wp_customize->add_setting( 'woo_otter_item_shadow_offsetx',
        array(
            'default' => 3,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
    $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_item_shadow_offsetx',
        array(
            'label' => __( 'Item Shadow Offset-X (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_items_options',
            'active_callback' => 'woo_otterwp_item_shadow_active',
            'input_attrs' => array(
                'min' => 1,
                'max' => 90,
                'step' => 1,
            ),
        )
        ) );
    $wp_customize->add_setting( 'woo_otter_item_shadow_offsety',
        array(
            'default' => 3,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
    $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_item_shadow_offsety',
        array(
            'label' => __( 'Item Shadow Offset-y (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_items_options',
            'active_callback' => 'woo_otterwp_item_shadow_active',
            'input_attrs' => array(
                'min' => -30,
                'max' => 30,
                'step' => 1,
            ),
        )
        ) );
    $wp_customize->add_setting( 'woo_otter_item_shadow_blurr',
        array(
            'default' => 18,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
    $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_item_shadow_blurr',
        array(
            'label' => __( 'item Shadow Blur Radius (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_items_options',
            'active_callback' => 'woo_otterwp_item_shadow_active',
            'input_attrs' => array(
                'min' => -30,
                'max' => 30,
                'step' => 1,
            ),
        )
        ) );
    $wp_customize->add_setting( 'woo_otter_item_shadow_spread',
        array(
            'default' => 10,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
        );
    $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_item_shadow_spread',
        array(
            'label' => __( 'Item Shadow Spread Radius (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_items_options',
            'active_callback' => 'woo_otterwp_item_shadow_active',
            'input_attrs' => array(
                'min' => 1,
                'max' => 90,
                'step' => 1,
            ),
        )
        ) );
    $wp_customize->add_setting( 'woo_otter_item_cart_shadow_alpha_color',
        array(
            'default' => 'rgba(0,0,0,0.15)',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        )
    );
    $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otter_item_cart_shadow_alpha_color',
        array(
            'label' => __( 'Item Shadow Color', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_items_options',
            'active_callback' => 'woo_otterwp_item_shadow_active',
            'show_opacity' => true, 
        )
    ) );
/*################## CART ICON SETTINGS ########################*/
        $wp_customize->add_section('otterwp_woo_cart_icon_options', array(
            'title' => esc_html__( 'Cart Icon Options', 'woo-otterwp' ),
            'description' => esc_html__( 'You can change shopping cart icon options from here.', 'woo-otterwp' ),
            'panel' => 'otterwp_woo_options',
            'active_callback'   => 'woo_otterwp_disable_cart_active'
        ));
        $wp_customize->add_setting( 'otter_woo_icon_display',
        array(
            'default' => 1,
            'transport' => 'refresh',
            'sanitize_callback' => 'otterwp_switch_sanitization'
        )
        );
        $wp_customize->add_control( new Otterwp_Toggle_Switch_Custom_control( $wp_customize, 'otter_woo_icon_display',
            array(
                'label' => __( 'Display icon', 'woo-otterwp' ),
                'section' => 'otterwp_woo_cart_icon_options'
            )
        ) );
        $wp_customize->add_setting( 'otter_woo_icon_type',
            array(
                'default' => 'cart',
                'transport' => 'refresh',
                'sanitize_callback' => 'otterwp_radio_sanitization'
            )
            );      
            
        $wp_customize->add_control( 'otter_woo_icon_type',
            array(
                'label' => __( 'Icon Select Option', 'woo-otterwp'),
                'section' => 'otterwp_woo_cart_icon_options',
                'type' => 'select',
                'active_callback' => 'woo_otterwp_icon_active',
                'choices' => array( 
                    'cart' => __( 'Cart' ),
                    'basket' => __( 'Basket' ),
                    'bag' => __( 'Bag' ),
                )
            )
            );
        $wp_customize->add_setting( 'woo_otter_icon_size',
            array(
                'default' => 50,
                'transport' => 'postMessage',
                'sanitize_callback' => 'otterwp_range_sanitization'
            )
            );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_icon_size',
            array(
                'label' => __( 'Icon Size (px)', 'woo-otterwp' ),
                'section' => 'otterwp_woo_cart_icon_options',
                'active_callback' => 'woo_otterwp_icon_active',
                'input_attrs' => array(
                    'min' => 10,
                    'max' => 70,
                    'step' => 1,
                ),
            )
            ) );
        $wp_customize->add_setting('woo_otterwp_cart_icon_color', array(
                'default' => '#000',
                'transport' => 'postMessage',
                'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
            ));
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_icon_color', array(
                'label' => __('Choose Cart Icon Color', 'woo-otterwp'),
                'section' => 'otterwp_woo_cart_icon_options',
                'active_callback' => 'woo_otterwp_icon_active',
                'settings' => 'woo_otterwp_cart_icon_color'
            
            )));
        $wp_customize->add_setting( 'otter_woo_icon_count_display',
            array(
                'default' => 1,
                'transport' => 'refresh',
                'sanitize_callback' => 'otterwp_switch_sanitization'
            )
            );
        $wp_customize->add_control( new Otterwp_Toggle_Switch_Custom_control( $wp_customize, 'otter_woo_icon_count_display',
                array(
                    'label' => __( 'Display Count Number', 'woo-otterwp' ),
                    'section' => 'otterwp_woo_cart_icon_options'
                )
            ) );

        $wp_customize->add_setting('woo_otterwp_cart_count_color', array(
                'default' => '#000',
                'transport' => 'postMessage',
                'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
            ));
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_count_color', array(
                'label' => __('Choose Cart Count Text Color', 'woo-otterwp'),
                'section' => 'otterwp_woo_cart_icon_options',
                'active_callback' => 'woo_otterwp_count_active',
                'settings' => 'woo_otterwp_cart_count_color'
            
            )));
        $wp_customize->add_setting('woo_otterwp_cart_count_bg_color', array(
                'default' => '#0170B9',
                'transport' => 'postMessage',
                'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
            ));
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_count_bg_color', array(
                'label' => __('Choose Cart Count Background Color', 'woo-otterwp'),
                'section' => 'otterwp_woo_cart_icon_options',
                'active_callback' => 'woo_otterwp_count_active',
                'settings' => 'woo_otterwp_cart_count_bg_color'
            
            )));
        $wp_customize->add_setting( 'woo_otterwp_cart_count_text_size',
            array(
                'default' => 17,
                'transport' => 'postMessage',
                'sanitize_callback' => 'otterwp_range_sanitization'
            )
            );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otterwp_cart_count_text_size',
            array(
                'label' => __( 'Count Number Size (px)', 'woo-otterwp'),
                'section' => 'otterwp_woo_cart_icon_options',
                'active_callback' => 'woo_otterwp_count_active',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 20,
                    'step' => 1,
                ),
            )
            ) ); 
        $wp_customize->add_setting( 'woo_otterwp_cart_count_border_radius',
            array(
                'default' => 10,
                'transport' => 'postMessage',
                'sanitize_callback' => 'otterwp_range_sanitization'
            )
            );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otterwp_cart_count_border_radius',
            array(
                'label' => __( 'Count Background Radius (%)', 'woo-otterwp' ),
                'section' => 'otterwp_woo_cart_icon_options',
                'active_callback' => 'woo_otterwp_count_active',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ),
            )
            ) ); 
            
        $wp_customize->add_setting( 'otter_woo_icon_text_display',
            array(
                'default' => 0,
                'transport' => 'refresh',
                'sanitize_callback' => 'otterwp_switch_sanitization'
            )
            );
        $wp_customize->add_control( new Otterwp_Toggle_Switch_Custom_control( $wp_customize, 'otter_woo_icon_text_display',
                array(
                    'label' => __( 'Display Text', 'woo-otterwp'),
                    'section' => 'otterwp_woo_cart_icon_options'
                )
            ) );
        $wp_customize->add_setting( 'woo_otter_cart_icon_text_setting', array(
                'default' => __( 'Cart', 'woo-otterwp' ),
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
              
        $wp_customize->add_control( 'woo_otter_cart_icon_text_setting', array(
                'type' => 'text',
                 'active_callback' => 'woo_otterwp_text_active',
                'section' => 'otterwp_woo_cart_icon_options',
            ) );
        $wp_customize->selective_refresh->add_partial( 'woo_otter_icon_text_refresh', array(
                'selector' => '.otter_icon_title',
                'settings' => array( 'woo_otter_cart_icon_text_setting' ),
                'container_inclusive' => true,
                'fallback_refresh'    => false,
                'render_callback' => 'woo_otter_icon_text',
            ) );
        $wp_customize->add_setting('woo_otterwp_cart_text_color', array(
                'default' => '#000',
                'transport' => 'postMessage',
                'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
            ));
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_cart_text_color', array(
                'label' => __('Choose Cart Text Color', 'woo-otterwp'),
                'section' => 'otterwp_woo_cart_icon_options',
                'active_callback' => 'woo_otterwp_text_active',
                'settings' => 'woo_otterwp_cart_text_color'
            
            )));
        $wp_customize->add_setting( 'woo_otterwp_cart_text_size',
            array(
                'default' => 17,
                'transport' => 'postMessage',
                'sanitize_callback' => 'otterwp_range_sanitization'
            )
            );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otterwp_cart_text_size',
            array(
                'label' => __( 'Icon Text Size (px)', 'woo-otterwp' ),
                'section' => 'otterwp_woo_cart_icon_options',
                'active_callback' => 'woo_otterwp_text_active',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 30,
                    'step' => 1,
                ),
            )
            ) ); 
        $wp_customize->add_setting( 'woo_otterwp_cart_floating_switch',
            array(
                'default' => 1,
                'transport' => 'refresh',
                'sanitize_callback' => 'otterwp_switch_sanitization'
            )
            );
        $wp_customize->add_control( new Otterwp_Toggle_Switch_Custom_control( $wp_customize, 'woo_otterwp_cart_floating_switch',
            array(
                'label' => __( 'Floating Cart', 'woo-otterwp' ),
                'section' => 'otterwp_woo_cart_icon_options'
            )
        ) );
        $wp_customize->add_setting('woo_otterwp_floating_cart_bg_color', array(
            'default' => '#fff',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        ));
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_floating_cart_bg_color', 
            array(
                'label' => __('Choose Floating Cart Background Color (test)', 'woo-otterwp'),
                'section' => 'otterwp_woo_cart_icon_options',
                'active_callback' => 'woo_otterwp_floating_active',
                'settings' => 'woo_otterwp_floating_cart_bg_color'
        )));
        $wp_customize->add_setting( 'woo_otterwp_floating_cart_border_radius',
            array(
                'default' => 17,
                'transport' => 'postMessage',
                'sanitize_callback' => 'otterwp_range_sanitization'
            )
        );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otterwp_floating_cart_border_radius',
            array(
                'label' => __( 'Choose Floading Cart Border Radius (px)', 'woo-otterwp'),
                'section' => 'otterwp_woo_cart_icon_options',
                'active_callback' => 'woo_otterwp_floating_active',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 30,
                    'step' => 1,
                ),
            )
        ) );
        $wp_customize->add_setting( 'woo_otterwp_floating_cart_padding',
        array(
            'default' => 5,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
    );
    $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otterwp_floating_cart_padding',
        array(
            'label' => __( 'Choose Floading Cart Padding (px)', 'woo-otterwp'),
            'section' => 'otterwp_woo_cart_icon_options',
            'active_callback' => 'woo_otterwp_floating_active',
            'input_attrs' => array(
                'min' => 0,
                'max' => 30,
                'step' => 1,
            ),
        )
    ) );
        $wp_customize->add_setting( 'otter_woo_floating_cart_shadow_toggle',
        array(
            'default' => 1,
            'transport' => 'refresh',
            'sanitize_callback' => 'otterwp_switch_sanitization'
        )
        );
        $wp_customize->add_control( new Otterwp_Toggle_Switch_Custom_control( $wp_customize, 'otter_woo_floating_cart_shadow_toggle',
            array(
                'label' => __( 'Display Shadow', 'woo-otterwp'),
                'section' => 'otterwp_woo_cart_icon_options',
                'active_callback' => 'woo_otterwp_floating_active',
            )
        ) );
        $wp_customize->add_setting( 'woo_otter_floating_cart_shadow_offsetx',
            array(
                'default' => 0,
                'transport' => 'postMessage',
                'sanitize_callback' => 'otterwp_range_sanitization'
            )
        );

        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_floating_cart_shadow_offsetx',
            array(
                'label' => __( 'Floating Cart Shadow Offset-X (px)', 'woo-otterwp'),
                'section' => 'otterwp_woo_cart_icon_options',
                'active_callback' => 'woo_otterwp_floating_cart_shadow_active',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 30,
                    'step' => 1,
                ),
            )
        ) );
        $wp_customize->add_setting( 'woo_otter_floating_cart_shadow_offsety',
        array(
            'default' => 0,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
    );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_floating_cart_shadow_offsety',
            array(
                'label' => __( 'Floating Cart Shadow Offset-Y (px)', 'woo-otterwp'),
                'section' => 'otterwp_woo_cart_icon_options',
                'active_callback' => 'woo_otterwp_floating_cart_shadow_active',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 30,
                    'step' => 1,
                ),
            )
        ) );
        $wp_customize->add_setting( 'woo_otterwp_floating_cart_shadow_blurr',
        array(
            'default' => 17,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization',
        )
    );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otterwp_floating_cart_shadow_blurr',
            array(
                'label' => __( 'Floating Cart Shadow Blur Radius (px)', 'woo-otterwp'),
                'section' => 'otterwp_woo_cart_icon_options',
                'active_callback' => 'woo_otterwp_floating_cart_shadow_active',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 30,
                    'step' => 1,
                ),
            )
        ) );
        $wp_customize->add_setting( 'woo_otterwp_floating_cart_shadow_spread',
        array(
            'default' => 17,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization',
        )
    );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otterwp_floating_cart_shadow_spread',
            array(
                'label' => __( 'Floating Cart Shadow Spread(px)', 'woo-otterwp' ),
                'section' => 'otterwp_woo_cart_icon_options',
                'active_callback' => 'woo_otterwp_floating_cart_shadow_active',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 30,
                    'step' => 1,
                ),
            )
        ) );
        $wp_customize->add_setting( 'floating_cart_shadow_alpha_color',
        array(
            'default' => 'rgba(0,0,0,0.15)',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        )
    );
    $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'floating_cart_shadow_alpha_color',
        array(
            'label' => __( 'Choose Floating Cart Shadow Color', 'woo-otterwp' ),
            'section' => 'otterwp_woo_cart_icon_options',
            'active_callback' => 'woo_otterwp_floating_cart_shadow_active',
            'show_opacity' => true, 
        )
    ) );
        $wp_customize->add_setting( 'woo_otterwp_floating_cart_position',
            array(
                'default' => 'right-bottom-fixed',
                'transport' => 'refresh',
                'sanitize_callback' => 'otterwp_radio_sanitization'
            )
        );            
        $wp_customize->add_control( new otterwp_Text_Radio_Button_Custom_Control( $wp_customize, 'woo_otterwp_floating_cart_position',
            array(
                'label' => __( 'Choose Floating Cart Position', 'woo-otterwp' ),
                'section' => 'otterwp_woo_cart_icon_options',
                'active_callback' => 'woo_otterwp_floating_active',
                'choices' => array(
                    'left-bottom-fixed' => __( 'Left' ), 
                    'centered-bottom-fixed' => __( 'Centered' ), 
                    'right-bottom-fixed' => __( 'Right' ) 
                )
            )
        ) );
/*################## SINGLE ITEMS SETTINGS ########################*/
         $wp_customize->add_section('otterwp_woo_single_item_options', array(
            'title' => __( 'Single Item Options', 'woo-otterwp'),
            'description' => __( 'You can change shopping cart options from here.', 'woo-otterwp' ),
            'panel' => 'otterwp_woo_options'
        ));
        $wp_customize->add_setting('woo_otterwp_item_bg_color', array(
            'default' => '#fff',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        ));
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_item_bg_color', array(
            'label' => __('Choose Header Background Color', 'woo-otterwp'),
            'section' => 'otterwp_woo_single_item_options',
            'settings' => 'woo_otterwp_item_bg_color'
        
        )));
        $wp_customize->add_setting('woo_otterwp_title_color', array(
            'default' => '#000',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        ));
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_title_color', array(
            'label' => __('Choose Header Title Color', 'woo-otterwp'),
            'section' => 'otterwp_woo_single_item_options',
            'settings' => 'woo_otterwp_title_color'
        
        )));
        $wp_customize->add_setting('woo_otterwp_price_color', array(
            'default' => '#000',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        ));
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_price_color', array(
            'label' => __('Choose Header Price Color', 'woo-otterwp'),
            'section' => 'otterwp_woo_single_item_options',
            'settings' => 'woo_otterwp_price_color'
        
        )));
        $wp_customize->add_setting( 'woo_otterwp_swipe_color',
            array(
                'default' => 'rgba(0,0,0,0.15)',
                'transport' => 'postMessage',
                'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
            )
        );
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_swipe_color', array(
            'label' => __('Choose Header Swipe Indicator Color', 'woo-otterwp'),
            'section' => 'otterwp_woo_single_item_options',
            'settings' => 'woo_otterwp_swipe_color'
        
        )));
        $wp_customize->add_setting( 'woo_otterwp_single_body_bg_color',
        array(
            'default' => '#fff',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        )
    );
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_single_body_bg_color', array(
            'label' => __('Choose Background Color For Body', 'woo-otterwp'),
            'section' => 'otterwp_woo_single_item_options',
            'settings' => 'woo_otterwp_single_body_bg_color'
        
        )));
        $wp_customize->add_setting( 'woo_otterwp_single_body_title_color',
        array(
            'default' => '#000',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        )
    );
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_single_body_title_color', array(
            'label' => __('Choose Color For Body Title', 'woo-otterwp'),
            'section' => 'otterwp_woo_single_item_options',
            'settings' => 'woo_otterwp_single_body_title_color' 
        )));
        $wp_customize->add_setting( 'woo_otterwp_single_body_text_color',
        array(
            'default' => '#808285',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        )
    );
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otterwp_single_body_text_color', array(
            'label' => __('Choose Color For Body Text', 'woo-otterwp'),
            'section' => 'otterwp_woo_single_item_options',
            'settings' => 'woo_otterwp_single_body_text_color' 
        )));
        $wp_customize->add_setting( 'woo_otterwp_header_size',
            array(
                'default' => 100,
                'transport' => 'postMessage',
                'sanitize_callback' => 'otterwp_range_sanitization'
            )
        );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otterwp_header_size',
        array(
            'label' => __( 'Choose Header height (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_single_item_options',
            'input_attrs' => array(
                'min' => 0,
                'max' => 300,
                'step' => 1,
            ),
        )
        ) ); 
        $wp_customize->add_setting( 'woo_otterwp_header_image_size',
        array(
            'default' => 125,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
    );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otterwp_header_image_size',
        array(
            'label' => __( 'Choose Header Image Size (px)', 'woo-otterwp' ),
            'section' => 'otterwp_woo_single_item_options',
            'input_attrs' => array(
                'min' => 0,
                'max' => 250,
                'step' => 1,
            ),
        )
        ) ); 
        $wp_customize->add_setting( 'woo_otterwp_header_title_text_size',
            array(
                'default' => 17,
                'transport' => 'postMessage',
                'sanitize_callback' => 'otterwp_range_sanitization'
            )
        );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otterwp_header_title_text_size',
            array(
                'label' => __( 'Choose Header Title Text Size (px)', 'woo-otterwp' ),
                'section' => 'otterwp_woo_single_item_options',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 30,
                    'step' => 1,
                ),
            )
            ) ); 
        $wp_customize->add_setting( 'woo_otterwp_header_price_text_size',
            array(
                'default' => 17,
                'transport' => 'postMessage',
                'sanitize_callback' => 'otterwp_range_sanitization'
            )
        );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otterwp_header_price_text_size',
            array(
                'label' => __( 'Choose Header Price Font Size (px)', 'woo-otterwp' ),
                'section' => 'otterwp_woo_single_item_options',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 30,
                    'step' => 1,
                ),
            )
        ) ); 
       
        $wp_customize->add_setting( 'woo_otter_single_shadow_offsetx',
            array(
                'default' => 0,
                'transport' => 'postMessage',
                'sanitize_callback' => 'otterwp_range_sanitization'
            )
        );

        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_single_shadow_offsetx',
            array(
                'label' => __( 'Choose Single Item Shadow Offset-X (px)', 'woo-otterwp'),
                'section' => 'otterwp_woo_single_item_options',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 30,
                    'step' => 1,
                ),
            )
        ) );
        $wp_customize->add_setting( 'woo_otter_single_shadow_offsety',
        array(
            'default' => 0,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization'
        )
    );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_single_shadow_offsety',
            array(
                'label' => __( 'Choose Single Item Shadow Offset-Y (px)', 'woo-otterwp'),
                'section' => 'otterwp_woo_single_item_options',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 30,
                    'step' => 1,
                ),
            )
        ) );
        $wp_customize->add_setting( 'woo_otter_single_shadow_blurr',
        array(
            'default' => 17,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization',
        )
    );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_single_shadow_blurr',
            array(
                'label' => __( 'Choose Single Item Shadow Blur Radius (px)', 'woo-otterwp'),
                'section' => 'otterwp_woo_single_item_options',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 30,
                    'step' => 1,
                ),
            )
        ) );
        $wp_customize->add_setting( 'woo_otter_single_shadow_spread',
        array(
            'default' => 17,
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_range_sanitization',
        )
    );
        $wp_customize->add_control( new Otterwp_Slider_Custom_Control( $wp_customize, 'woo_otter_single_shadow_spread',
            array(
                'label' => __( 'Choose Single Item Shadow Spread(px)', 'woo-otterwp' ),
                'section' => 'otterwp_woo_single_item_options',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 30,
                    'step' => 1,
                ),
            )
        ) );
        $wp_customize->add_setting( 'woo_otter_single_shadow_alpha_color',
        array(
            'default' => 'rgba(0,0,0,0.15)',
            'transport' => 'postMessage',
            'sanitize_callback' => 'otterwp_hex_rgba_sanitization'
        )
    );
        $wp_customize->add_control( new Otterwp_Customize_Alpha_Color_Control( $wp_customize, 'woo_otter_single_shadow_alpha_color',
            array(
                'label' => __( 'Choose Single Item Shadow Color', 'woo-otterwp' ),
                'section' => 'otterwp_woo_single_item_options',
                'show_opacity' => true, 
            )
        ) ); 


    


        function woo_otter_cart_text() {
            if ( ( get_theme_mod( 'woo_otter_cart_text_setting' ) ) != '' ) {
                $newval = get_theme_mod( 'woo_otter_cart_text_setting' );
                echo '<div class="otter_head_title otter_center">';
                echo '<h2 class="otter_cart_title">' . esc_html( $newval ) . '</h2>';
                echo '</div>';
            }
        }
        function woo_otter_icon_text() {
            if ( ( get_theme_mod( 'woo_otter_cart_icon_text_setting' ) ) != '' ) {
                $newval = get_theme_mod( 'woo_otter_cart_icon_text_setting' );
                echo '<p class="otter_icon_title">' . esc_html( $newval ) . '</p>';

            }
        }
        function woo_otterwp_disable_cart_active( $control ) {
            if ( 1 === $control->manager->get_setting( 'otter_woo_disable_cart_toggle',)->value() ) {
                return true;
            } else {
                return false;
            }
        }
        function woo_otterwp_icon_active( $control ) {
            if ( 1 === $control->manager->get_setting( 'otter_woo_icon_display',)->value() ) {
                return true;
            } else {
                return false;
            }
        }
        function woo_otterwp_text_active( $control ) {
            if ( 1 === $control->manager->get_setting( 'otter_woo_icon_text_display',)->value() ) {
                return true;
            } else {
                return false;
            }
        }
        function woo_otterwp_count_active( $control ) {
            if ( 1 === $control->manager->get_setting( 'otter_woo_icon_count_display',)->value() ) {
                return true;
            } else {
                return false;
            }
        }
        function woo_otterwp_floating_active( $control ) {
            if ( 1 === $control->manager->get_setting( 'woo_otterwp_cart_floating_switch',)->value() ) {
                return true;
            } else {
                return false;
            }
        }

        function woo_otterwp_item_shadow_active( $control ) {
            if ( 1 === $control->manager->get_setting( 'otter_woo_item_shadow_toggle',)->value() ) {
                return true;
            } else {
                return false;
            }
        }
        
        function woo_otterwp_floating_cart_shadow_active( $control ) {
            if ( 1 === $control->manager->get_setting( 'woo_otterwp_cart_floating_switch',)->value() ) {
                if ( 1 === $control->manager->get_setting( 'otter_woo_floating_cart_shadow_toggle',)->value() ) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        }

        
    }
    

	

}


