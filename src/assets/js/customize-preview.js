import $ from 'jquery';

/*################## CART BODY SETTINGS ########################*/
wp.customize( 'woo_otter_cart_text_setting', function( value ) {
    value.bind( function( newVal ) {
        $( '.otter_cart_title' ).html( newVal );
    } );
} );

wp.customize( 'woo_otterwp_cart_header_bg_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_head' ).css( 'background', newval );
    } );
} );

wp.customize( 'woo_otterwp_cart_header_border_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_head' ).css( 'border-color', newval );
    } );
} );
wp.customize( 'woo_otterwp_cart_header_text_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_close line' ).css( 'stroke', newval );
    } );
} );
wp.customize( 'woo_otterwp_cart_header_text_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_cart_title' ).css( 'color', newval );
    } );
} );

wp.customize( 'woo_otterwp_cart_body_bg_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_container' ).css( 'background', newval );
    } );
} );
wp.customize( 'woo_otterwp_cart_header_bg_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_head' ).css( 'background', newval );
    } );
} );
wp.customize('woo_otterwp_cart_header_height', function(value) {
    value.bind(function( newval ) {
        $('.otter_head').css('height', newval + 'px');
    });
});
wp.customize('woo_otterwp_cart_header_height', function(value) {
    value.bind(function( newval ) {
        $('.otter_items_scroll').css('top', newval + 'px');
    });
});
wp.customize('woo_otterwp_cart_header_text_size', function(value) {
    value.bind(function( newval ) {
        $('.otter_cart_title').css('font-size', newval + 'px');
    });
});
wp.customize( 'woo_otterwp_cart_footer_bg_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_footer' ).css( 'background', newval );
    } );
} );
wp.customize( 'woo_otterwp_cart_footer_item_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_footer_products, .otter_footer_products .otter_value' ).css( 'color', newval );
    } );
} );

wp.customize( 'woo_otterwp_cart_footer_item_price_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_subtotale, .otter_value .woocommerce-Price-amount' ).css( 'color', newval );
    } );
} );
wp.customize('woo_otterwp_cart_footer_item_size', function(value) {
    value.bind(function( newval ) {
        $('.otter_footer_products').css('font-size', newval + 'px');
    });
});
wp.customize('woo_otterwp_cart_footer_price_size', function(value) {
    value.bind(function( newval ) {
        $('.otter_footer_total').css('font-size', newval + 'px');
    });
});

/*################## CART ITEMS SETTINGS ########################*/
wp.customize( 'woo_otterwp_cart_item_bg_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_item_wrap' ).css( 'background', newval );
    } );
} );
wp.customize( 'woo_otterwp_cart_item_border_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_item_wrap' ).css( 'border-color', newval );
    } );
} );
wp.customize( 'woo_otterwp_cart_item_title_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_item_title a' ).css( 'color', newval );
    } );
} );
wp.customize( 'woo_otterwp_cart_item_title_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_item_delete svg' ).css( 'stroke', newval );
    } );
} );
wp.customize( 'woo_otterwp_cart_item_price_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_item_price_wrap' ).css( 'color', newval );
    } );
} );
wp.customize( 'woo_otterwp_cart_item_input_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_item_quanity_minus line , .otter_item_quanity_plus line' ).css( 'stroke', newval );
    } );
} );
wp.customize( 'woo_otterwp_cart_item_subtotal_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_item_quanity' ).css( 'color', newval );
    } );
} );
wp.customize( 'woo_otterwp_cart_item_subtotal_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_item_total_price' ).css( 'color', newval );
    } );
} );
wp.customize('woo_otter_in_side_border_radius_size', function(value) {
    value.bind(function( newval ) {
        $('.otter_item_wrap').css('border-radius', newval + 'px');
    });
});
wp.customize('woo_otter_in_side_border_size', function(value) {
    value.bind(function( newval ) {
        $('.otter_item_wrap').css('border-width', newval + 'px');
    });
});
wp.customize('woo_otter_in_side_subtotal_font_size', function(value) {
    value.bind(function( newval ) {
        $('.otter_item_total_price').css('font-size', newval + 'px');
    });
});
wp.customize('woo_otter_in_side_padding_size', function(value) {
    value.bind(function( newval ) {
        $('.otter_item_wrap').css('padding', newval + 'px');
    });
});
wp.customize('woo_otter_in_side_price_font_size', function(value) {
    value.bind(function( newval ) {
        $('.otter_item_price_wrap').css('font-size', newval + 'px');
    });
});
wp.customize('woo_otter_in_side_title_font_size', function(value) {
    value.bind(function( newval ) {
        $('.otter_item_title a').css('font-size', newval + 'px');
    });
});

wp.customize('woo_otter_item_cart_shadow_alpha_color', function(value) {
    value.bind(function( newval ) {
        var offsetx = wp.customize( 'woo_otter_item_shadow_offsetx' ).get();
        var offsety = wp.customize( 'woo_otter_item_shadow_offsety' ).get();
        var blurr = wp.customize( 'woo_otter_item_shadow_blurr' ).get();
        var spread = wp.customize( 'woo_otter_item_shadow_spread' ).get();
        $('.otter_item_wrap').css('box-shadow', offsetx + "px " + offsety + "px " + blurr + "px " + spread + "px " + newval );
    });
});
wp.customize('woo_otter_item_shadow_spread', function(value) {
    value.bind(function( newval ) {
        var offsetx = wp.customize( 'woo_otter_item_shadow_offsetx' ).get();
        var offsety = wp.customize( 'woo_otter_item_shadow_offsety' ).get();
        var blurr = wp.customize( 'woo_otter_item_shadow_blurr' ).get();
        var color = wp.customize( 'woo_otter_item_cart_shadow_alpha_color' ).get();
        $('.otter_item_wrap').css('box-shadow', offsetx + "px " + offsety + "px " + blurr + "px " + newval + "px " + color );
    });
});
wp.customize('woo_otter_item_shadow_blurr', function(value) {
    value.bind(function( newval ) {
        var offsetx = wp.customize( 'woo_otter_item_shadow_offsetx' ).get();
        var offsety = wp.customize( 'woo_otter_item_shadow_offsety' ).get();
        var spread = wp.customize( 'woo_otter_item_shadow_spread' ).get();
        var color = wp.customize( 'woo_otter_item_cart_shadow_alpha_color' ).get();
        $('.otter_item_wrap').css('box-shadow', offsetx + "px " + offsety + "px " + newval + "px " + spread + "px " + color );
    });
});
wp.customize('woo_otter_item_shadow_offsety', function(value) {
    value.bind(function( newval ) {
        var offsetx = wp.customize( 'woo_otter_item_shadow_offsetx' ).get();
        var blurr = wp.customize( 'woo_otter_item_shadow_blurr' ).get();
        var spread = wp.customize( 'woo_otter_item_shadow_spread' ).get();
        var color = wp.customize( 'woo_otter_item_cart_shadow_alpha_color' ).get();
        $('.otter_item_wrap').css('box-shadow', offsetx + "px " + newval + "px " + blurr + "px " + spread + "px " + color );
    });
});
wp.customize('woo_otter_item_shadow_offsetx', function(value) {
    value.bind(function( newval ) {
        var offsety = wp.customize( 'woo_otter_item_shadow_offsety' ).get();
        var blurr = wp.customize( 'woo_otter_item_shadow_blurr' ).get();
        var spread = wp.customize( 'woo_otter_item_shadow_spread' ).get();
        var color = wp.customize( 'woo_otter_item_cart_shadow_alpha_color' ).get();
        $('.otter_item_wrap').css('box-shadow', newval + "px " + offsety + "px " + blurr + "px " + spread + "px " + color );
    });
});
/*################## CART ICON SETTINGS ########################*/
wp.customize( 'woo_otterwp_cart_icon_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_open path' ).css( 'fill', newval );
    } );
} );
wp.customize( 'woo_otterwp_cart_text_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_cart_title' ).css( 'color', newval );
    } );
} );
wp.customize('woo_otterwp_cart_text_size', function(value) {
    value.bind(function( newval ) {
        $('.otter_icon_title').css('font-size', newval + 'px');
    });
});
wp.customize( 'woo_otterwp_cart_count_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_open_count' ).css( 'color', newval );
    } );
} );
wp.customize( 'woo_otterwp_cart_count_bg_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_open_count' ).css( 'background', newval );
    } );
} );
wp.customize('woo_otterwp_cart_count_border_radius', function(value) {
    value.bind(function( newval ) {
        $('.otter_open_count').css('border-radius', newval + '%');
    });
});
wp.customize('woo_otterwp_cart_count_text_size', function(value) {
    value.bind(function( newval ) {
        $('.otter_open_count').css('font-size', newval + 'px');
    });
});
wp.customize('woo_otter_icon_size', function(value) {
    value.bind(function( newval ) {
        $('.otter_open_image svg').css('width', newval + 'px');
    });
});
wp.customize('woo_otter_icon_size', function(value) {
    value.bind(function( newval ) {
        $('.otter_open_image svg').css('height', newval + 'px');
    });
});
wp.customize('woo_otter_icon_size', function(value) {
    value.bind(function( newval ) {
        $('.otter_open_image').css('height', newval + 'px');
    });
});
wp.customize( 'woo_otterwp_cart_text_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_icon_title' ).css( 'color', newval );
    } );
} );
wp.customize( 'woo_otterwp_floating_cart_bg_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otw-floating-cart' ).css( 'background', newval );
    } );
} );
wp.customize('woo_otterwp_floating_cart_padding', function(value) {
    value.bind(function( newval ) {
        $('.otw-floating-cart').css('padding', newval + 'px');
    });
});
wp.customize('woo_otterwp_floating_cart_border_radius', function(value) {
    value.bind(function( newval ) {
        $('.otw-floating-cart').css('border-radius', newval + 'px');
    });
});
wp.customize('woo_otterwp_floating_cart_shadow', function(value) {
    value.bind(function( newval ) {
        $('.otw-floating-cart').css('box-shadow', 5 + "px " + 10 + "px " + 15 + "px " + 'rgba'+ '(' + 0 + ',' + 0 + ',' + 0 + ',' + + 0 + '.' + newval + ')');
    });
});
wp.customize('woo_otterwp_floating_cart_shadow', function(value) {
    value.bind(function( newval ) {
        $('.otw-floating-cart').css('box-shadow',  newval + "px " + 10 + "px " + 15 + "px " + 'rgba'+ '(' + 0 + ',' + 0 + ',' + 0 + ',' + + 0 + '.' + newval + ')');
    });
});
wp.customize('woo_otter_floating_cart_shadow_offsetx', function(value) {
    value.bind(function( newval ) {
        var two = wp.customize( 'woo_otter_floating_cart_shadow_offsety' ).get();
        var three = wp.customize( 'woo_otterwp_floating_cart_shadow_blurr' ).get();
        var four = wp.customize( 'woo_otterwp_floating_cart_shadow_spread' ).get();
        var color = wp.customize( 'floating_cart_shadow_alpha_color' ).get();
        $('.otw-floating-cart').css('box-shadow', newval + "px " + two + "px " + three + "px " + four + "px " + color );
    });
});
wp.customize('woo_otter_floating_cart_shadow_offsety', function(value) {
    value.bind(function( newval ) {
        var one = wp.customize( 'woo_otter_floating_cart_shadow_offsetx' ).get();
        var three = wp.customize( 'woo_otterwp_floating_cart_shadow_blurr' ).get();
        var four = wp.customize( 'woo_otterwp_floating_cart_shadow_spread' ).get();
        var color = wp.customize( 'floating_cart_shadow_alpha_color' ).get();
        $('.otw-floating-cart').css('box-shadow', one + "px " + newval + "px " + three + "px " + four + "px "  + color );
    });
});
wp.customize('woo_otterwp_floating_cart_shadow_blurr', function(value) {
    value.bind(function( newval ) {
        var one = wp.customize( 'woo_otter_floating_cart_shadow_offsetx' ).get();
        var two = wp.customize( 'woo_otter_floating_cart_shadow_offsety' ).get();
        var four = wp.customize( 'woo_otterwp_floating_cart_shadow_spread' ).get();
        var color = wp.customize( 'floating_cart_shadow_alpha_color' ).get();
        $('.otw-floating-cart').css('box-shadow', one + "px " + two + "px " + newval + "px " + four + "px " + color );
    });
});
wp.customize('woo_otterwp_floating_cart_shadow_spread', function(value) {
    value.bind(function( newval ) {
        var one = wp.customize( 'woo_otter_floating_cart_shadow_offsetx' ).get();
        var two = wp.customize( 'woo_otter_floating_cart_shadow_offsety' ).get();
        var three = wp.customize( 'woo_otterwp_floating_cart_shadow_blurr' ).get();
        var color = wp.customize( 'floating_cart_shadow_alpha_color' ).get();
        $('.otw-floating-cart').css('box-shadow', one + "px " + two + "px " + three + "px " + newval + "px "  + color );
    });
});
wp.customize('floating_cart_shadow_alpha_color', function(value) {
    value.bind(function( newval ) {
        var one = wp.customize( 'woo_otter_floating_cart_shadow_offsetx' ).get();
        var two = wp.customize( 'woo_otter_floating_cart_shadow_offsety' ).get();
        var three = wp.customize( 'woo_otterwp_floating_cart_shadow_blurr' ).get();
        var four = wp.customize( 'woo_otterwp_floating_cart_shadow_spread' ).get();
        $('.otw-floating-cart').css('box-shadow', one + "px " + two + "px " + three + "px " + four + "px " + newval );
    });
});
wp.customize('footer_cart_shadow_alpha_color', function(value) {
    value.bind(function( newval ) {
        var offsetx = wp.customize( 'woo_otter_footer_shadow_offsetx' ).get();
        var offsety = wp.customize( 'woo_otter_footer_shadow_offsety' ).get();
        var blurr = wp.customize( 'woo_otter_footer_shadow_blurr' ).get();
        var spread = wp.customize( 'woo_otter_footer_shadow_spread' ).get();
        $('.otter_footer').css('box-shadow', offsetx + "px " + offsety + "px " + blurr + "px " + spread + "px " + newval );
    });
});
wp.customize('woo_otter_footer_shadow_spread', function(value) {
    value.bind(function( newval ) {
        var offsetx = wp.customize( 'woo_otter_footer_shadow_offsetx' ).get();
        var offsety = wp.customize( 'woo_otter_footer_shadow_offsety' ).get();
        var blurr = wp.customize( 'woo_otter_footer_shadow_blurr' ).get();
        var color = wp.customize( 'footer_cart_shadow_alpha_color' ).get();
        $('.otter_footer').css('box-shadow', offsetx + "px " + offsety + "px " + blurr + "px " + newval + "px " + color );
    });
});
wp.customize('woo_otter_footer_shadow_blurr', function(value) {
    value.bind(function( newval ) {
        var offsetx = wp.customize( 'woo_otter_footer_shadow_offsetx' ).get();
        var offsety = wp.customize( 'woo_otter_footer_shadow_offsety' ).get();
        var spread = wp.customize( 'woo_otter_footer_shadow_spread' ).get();
        var color = wp.customize( 'footer_cart_shadow_alpha_color' ).get();
        $('.otter_footer').css('box-shadow', offsetx + "px " + offsety + "px " + newval + "px " + spread + "px " + color );
    });
});
wp.customize('woo_otter_footer_shadow_offsety', function(value) {
    value.bind(function( newval ) {
        var offsetx = wp.customize( 'woo_otter_footer_shadow_offsetx' ).get();
        var blurr = wp.customize( 'woo_otter_footer_shadow_blurr' ).get();
        var spread = wp.customize( 'woo_otter_footer_shadow_spread' ).get();
        var color = wp.customize( 'footer_cart_shadow_alpha_color' ).get();
        $('.otter_footer').css('box-shadow', offsetx + "px " + newval + "px " + blurr + "px " + spread + "px " + color );
    });
});
wp.customize('woo_otter_footer_shadow_offsetx', function(value) {
    value.bind(function( newval ) {
        var offsety = wp.customize( 'woo_otter_footer_shadow_offsety' ).get();
        var blurr = wp.customize( 'woo_otter_footer_shadow_blurr' ).get();
        var spread = wp.customize( 'woo_otter_footer_shadow_spread' ).get();
        var color = wp.customize( 'footer_cart_shadow_alpha_color' ).get();
        $('.otter_footer').css('box-shadow', newval + "px " + offsety + "px " + blurr + "px " + spread + "px " + color );
    });
});
wp.customize('footer_cart_button_shadow_alpha_color', function(value) {
    value.bind(function( newval ) {
        var offsetx = wp.customize( 'woo_otter_footer_shadow_offsetx' ).get();
        var offsety = wp.customize( 'woo_otter_footer_shadow_offsety' ).get();
        var blurr = wp.customize( 'woo_otter_footer_shadow_blurr' ).get();
        var spread = wp.customize( 'woo_otter_footer_shadow_spread' ).get();
        $('.woocommerce-mini-cart__buttons .button').css('box-shadow', offsetx + "px " + offsety + "px " + blurr + "px " + spread + "px " + newval );
    });
});
wp.customize('woo_otter_footer_button_shadow_spread', function(value) {
    value.bind(function( newval ) {
        var offsetx = wp.customize( 'woo_otter_footer_button_shadow_offsetx' ).get();
        var offsety = wp.customize( 'woo_otter_footer_button_shadow_offsety' ).get();
        var blurr = wp.customize( 'woo_otter_footer_button_shadow_blurr' ).get();
        var color = wp.customize( 'footer_cart_button_shadow_alpha_color' ).get();
        $('.woocommerce-mini-cart__buttons .button').css('box-shadow', offsetx + "px " + offsety + "px " + blurr + "px " + newval + "px " + color );
    });
});
wp.customize('woo_otter_footer_button_shadow_blurr', function(value) {
    value.bind(function( newval ) {
        var offsetx = wp.customize( 'woo_otter_footer_button_shadow_offsetx' ).get();
        var offsety = wp.customize( 'woo_otter_footer_button_shadow_offsety' ).get();
        var spread = wp.customize( 'woo_otter_footer_button_shadow_spread' ).get();
        var color = wp.customize( 'footer_cart_button_shadow_alpha_color' ).get();
        $('.woocommerce-mini-cart__buttons .button').css('box-shadow', offsetx + "px " + offsety + "px " + newval + "px " + spread + "px " + color );
    });
});
wp.customize('woo_otter_footer_button_shadow_offsety', function(value) {
    value.bind(function( newval ) {
        var offsetx = wp.customize( 'woo_otter_footer_button_shadow_offsetx' ).get();
        var blurr = wp.customize( 'woo_otter_footer_button_shadow_blurr' ).get();
        var spread = wp.customize( 'woo_otter_footer_button_shadow_spread' ).get();
        var color = wp.customize( 'footer_cart_button_shadow_alpha_color' ).get();
        $('.woocommerce-mini-cart__buttons .button').css('box-shadow', offsetx + "px " + newval + "px " + blurr + "px " + spread + "px " + color );
    });
});
wp.customize('woo_otter_footer_button_shadow_offsetx', function(value) {
    value.bind(function( newval ) {
        var offsety = wp.customize( 'woo_otter_footer_button_shadow_offsety' ).get();
        var blurr = wp.customize( 'woo_otter_footer_button_shadow_blurr' ).get();
        var spread = wp.customize( 'woo_otter_footer_button_shadow_spread' ).get();
        var color = wp.customize( 'footer_cart_button_shadow_alpha_color' ).get();
        $('.woocommerce-mini-cart__buttons .button').css('box-shadow', newval + "px " + offsety + "px " + blurr + "px " + spread + "px " + color );
    });
});
wp.customize( 'footer_cart_button_alpha_color', function( value ) {
    value.bind( function( newval ) {
        $( '.otter_flex .woocommerce-mini-cart__buttons a.button' ).css( 'background', newval );
    } );
} );
