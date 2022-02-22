(function( $ ) {
    var nonce = wooOtterwpVars.nonce;

    $(document).ready(function(){
        if($(".woocommerce-variation-add-to-cart-disabled")[0] != undefined){
            return;
          }else{
      
        


        $('body').on('click','.otter_close, .otter_bg',function () {
            otter_hide();
        });
        $('body').on('click','.otter_open',function () {
            otter_show();
        });
        
        $('body').on( 'added_to_cart', function(e, fragments, cart_hash, this_button){
            
            if ($(".otter_woo_slide")[0]){
            otter_show();
            }
            otter_get_cart();
        });
        $('body').on('click','.otter_item_delete',function () {
            var key = $(this).data('key');
            var item = $(this).parents('.otter_item_wrap');
            otter_remove_item(key,item);
        });

        $('body').on('click','.otter_item_quanity_update',function () {
            otter_quanity_update_buttons($(this));
        });

        $('body').on('blur','.otter_item_quanity',function () {
            otter_quanity_update($(this));
        });

        $(document).on('click', '.single_add_to_cart_button', function (e) {
            e.preventDefault();
            var $button = $(this),
                $form = $button.closest('form.cart'),
                product_id = $form.find('input[name=add-to-cart]').val() || $button.val();
            if (!product_id)
                return;

            if ($button.is('.disabled'))
                return;

            var data = {
                action: 'otter_add_to_cart',
                'add-to-cart': product_id,
            };

            $form.serializeArray().forEach(function (element) {
                data[element.name] = element.value;
            });

            $(document.body).trigger('adding_to_cart', [$button, data]);
            
            jQuery.ajax({
                type: 'post',
                url: wooOtterwpVars.ajaxurl,
                data: data,
                beforeSend: function (response) {
                    $button.removeClass('added').addClass('loading');
                },
                success: function (response) {

                    if (response.error & response.product_url) {
                        window.location = response.product_url;
                        return;
                    } else {
                        $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $button]);

                        $('.woocommerce-notices-wrapper').empty().append(response.notices);

                    }
                },
            });

            return false;

        });
    }

    });

    function otter_hide() {

            $('.otter_container_wrap').removeClass('otter_show');
            $('.otter_bg').removeClass('otter_show');      
    }

    function otter_show() {
      
            $('.otter_container_wrap').addClass('otter_show');
            $('.otter_bg').addClass('otter_show');       
    }

    function otter_get_cart() {
        $( '.otter_items_wrap' ).addClass( 'otter_items_wrap_loading' );
        var data = {
            action: 'otter_get_cart',
            type: wooOtterwpVars.cart_type,
        };
        $.post( wooOtterwpVars.ajaxurl, data, function( response ) {
            var cart_response = JSON.parse( response );
            $( '.otter_items' ).html( cart_response['html'] );

            $('.otter_footer_products .otter_value, .otter_open_count').html(cart_response['count']);
            $('.otter_footer_total .otter_value').html(cart_response['total']);
            if (!$('.otter_open').hasClass('otter_open_active')){
                $('.otter_open').addClass('otter_open_active');
            }
            $( '.otter_items_wrap' ).removeClass( 'otter_items_wrap_loading' );
            nonce = cart_response['nonce'];
        } );
    }

    var otter_quanity_update_send = true;
    function otter_quanity_update_buttons( el ) {
        if(otter_quanity_update_send){
            $( '.otter_items_wrap' ).addClass( 'otter_items_wrap_loading' );
            otter_quanity_update_send = false;
            var wrap = $(el).parents('.otter_item_wrap');
            var input = $(wrap).find('.otter_item_quanity');
            var key = $(input).data('key');
            var number = parseInt($(input).val());
            var type = $(el).data('type');
            if(type=='minus'){
                number--;
            } else {
                number++;
            }
            if (number<1){
                number = 1;
            }
            $(input).val(number);
            var data = {
                action: 'otter_quanity_update',
                key: key,
                number: number,
                security: nonce
            };
            $(wrap).addClass('loading');
            $.post( wooOtterwpVars.ajaxurl, data, function( response ) {
                var cart_response = JSON.parse( response );
                $('.otter_footer_products .otter_value, .otter_open_count').html(cart_response['count']);
                $('.otter_footer_total .otter_value').html(cart_response['total']);
                $(wrap).find('.otter_item_total_price').html(cart_response['item_price']);
                $(wrap).removeClass('loading');
                otter_quanity_update_send = true;
                $( '.otter_items_wrap' ).removeClass( 'otter_items_wrap_loading' );
            } );
        }
    }

    function otter_quanity_update( input ) {
        $( '.otter_items_wrap' ).addClass( 'otter_items_wrap_loading' );
        var wrap = $(input).parents('.otter_item_wrap');
        var key = $(input).data('key');
        var number = parseInt($(input).val());
        if (!number || number<1){
            number = 1;
        }
        $(input).val(number);
        var data = {
            action: 'otter_quanity_update',
            key: key,
            number: number,
            security: nonce
        };
        $(wrap).addClass('loading');
        $.post( wooOtterwpVars.ajaxurl, data, function( response ) {
            var cart_response = JSON.parse( response );
            $('.otter_footer_products .otter_value, .otter_open_count').html(cart_response['count']);
            $('.otter_footer_total .otter_value').html(cart_response['total']);
            $(wrap).find('.otter_item_total_price').html(cart_response['item_price']);
            $(wrap).removeClass('loading');
            otter_quanity_update_send = true;
            $( '.otter_items_wrap' ).removeClass( 'otter_items_wrap_loading' );
        } );
    }

    function otter_remove_item( key,item ) {
        var data = {
            action: 'otter_delete_item',
            key: key,
            security: nonce
        };
        if (wooOtterwpVars.cart_type=='left'){
            $(item).animate({right: '100%'}, 300, function () {
                $(item).remove();

            });
        } else {
            $(item).animate({left: '100%'}, 300, function () {
                $(item).remove();
            });
        }

        $.post( wooOtterwpVars.ajaxurl, data, function( response ) {
            var cart_response = JSON.parse( response );
            $('.otter_footer_products .otter_value, .otter_open_count').html(cart_response['count']);
            $('.otter_footer_total .otter_value').html(cart_response['total']);
            if(!parseInt(cart_response['count'])){
                $('.bottom-tray').removeClass('cart-open');
                $('.otter_open').removeClass('otter_open_active');
                otter_hide();
            }
        } );
    }


    public_otter_show = otter_show;
    public_otter_get_cart = otter_get_cart;



})( jQuery );

