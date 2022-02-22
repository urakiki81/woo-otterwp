import $ from 'jquery';
$(document).ready(function() {
    var nonce = woo_my_ajax_object.nonce;
    var startTime;
    var touchingElement = false;
    var dragDirection = "";
     var startY = 0,
         startX = 0;
     var currentY = 0,
         currentX = 0;
     var isOpen = false;
     var isMoving = false;
     var lastY = 0;
     var lastX = 0;
     var moveY = 0; 
     var maxOpacity = 1;
     var position = "";
     var newOpacity = 0;
     var menuHeight = 240;
     var postid = "";

     function debounce(func, wait = 10, immediate = true) {
        var timeout;
        return function() {
          var context = this, args = arguments;
          var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
          };
          var callNow = immediate && !timeout;
          clearTimeout(timeout);
          timeout = setTimeout(later, wait);
          if (callNow) func.apply(context, args);
        };
      };

     $(document).on("touchstart", ".otw-woocommerce-header",  true, function(evt) {
         startTime = new Date().getTime();
         startY = evt.touches[0].pageY;
         startX = evt.touches[0].pageX;

         touchingElement = true;
         touchStart(startY, startX, $(this)); 
          
       });
 
   
       $(document).on("touchend", ".otw-woocommerce-header",  function() {
   
 
     // Calculating new position of scrollbar
 
         const translateY = currentY - startY; // distance moved in the x axis
         const translateX = currentX - startX; // distance moved in the y axis
 
         const timeTaken = (new Date().getTime() - startTime);
         touchingElement = false;
         touchEnd(currentY, currentX, translateY, translateX, timeTaken, $(this));     
      
     });
     $(document).on("touchmove", ".otw-woocommerce-header", debounce(function(evt) {

         const hight = this.clientHeight;
 
 
         currentY = evt.touches[0].pageY;
         currentX = evt.touches[0].pageX;
         const translateY = currentY - startY; // distance moved in the x axis
         const translateX = currentX - startX; // distance moved in the y axis
         
         touchMove(evt, currentY, currentX, translateY, translateX, hight, $(this));
 
     }));
 
   function touchStart(startY, startX) {
     
         $('.otw-woocommerce-single').addClass('otw-no-transition');
     
         isOpen = true;
         isMoving = true;
         lastY = startY;
         lastX = startX;
 
         if (isOpen) {
            moveY = 0;
        } else {
            moveY = -menuHeight;
        }
         
        
     }
     function touchMove(evt, currentY, currentX, translateY, translateX, hight, thisObj) {
               var menuHeight = hight;
               requestAnimationFrame(updateUi); 
                   if (!dragDirection) {
 
                     if (Math.abs(translateY) >= Math.abs(translateX)) {
                         dragDirection = "vertical";
                     } else {
                         dragDirection = "horizontal";
                     }
                      
                 }
                 if (dragDirection === "horizontal") {
                     lastY = currentY;
                     lastX = currentX;
                 } else{  
                     if (moveY + (currentY - lastY) > 0 && moveY + (currentY - lastY) > -menuHeight) {
                         moveY = moveY + (currentY - lastY);
                     
                     }else if (moveY + (currentY - lastY) < 0 && moveY + (currentY - lastY) > -menuHeight){
                       evt.stopPropagation();
                     }
 
                     lastY = currentY;
                     lastX = currentX;
 
 
                     var percentageBeforeDif = (Math.abs(moveY) * 100) / menuHeight;
                     var percentage = 100 - percentageBeforeDif;
                     newOpacity = (((maxOpacity) * percentage) / 100);                    
                          
                 }
                 if(moveY > 0){
                     
                 }
                    
           }
           
         
           
 
       
       function touchEnd(currentY, currentX, translateY, translateX, timeTaken, hight, thisObj, position) {
         var menuHeight = hight;
         isMoving = false;
         var velocity = 0.3;
     
         $('.otw-woocommerce-single').removeClass('otw-no-transition');
                if (currentY === 0 && currentX === 0) {
                if (isOpen) {
        
                } else {
            
        
                }
                } else {
                    if (isOpen) {
                        if ((translateY < (-menuHeight) / 2) || (Math.abs(translateY) / timeTaken > velocity)) {
                                openMenu(translateY);
                                closeMenu(translateY, position, currentY, currentX);                   
                            isOpen = false;
                        } else {
                            openMenu();
                            isOpen = true;
                            translateY = null;
                        }
                    } else {
                        if (translateY > menuHeight / 2 || (Math.abs(translateY) / timeTaken > velocity)) {
                            openMenu();
                            isOpen = true;
                            translateY = null;
                        } else {
                            closeMenu(translateY);
                            openMenu(translateY);
                            isOpen = false;
                           
                        }
            
                    }
                }
         translateY = null;
     }
 
   function closeMenu(translateY) {

           if (translateY > 0 || !isOpen) {
           
            MenuIsClosed();  
            window.location.hash = '';
            $(window).scrollTop(position);
         
           }
                    
       }
 
   function openMenu() {
         $('.otw-woocommerce-single').attr("style", "");
         $('.otterwp-content').attr("style", "");
         if ($(".otw-woo-reviews.otw-woo-reviews-open")[0]){
            $('.otw-woo-reviews').attr("style", "");
            $('.otw-woo-reviews-bg').attr("style", "");
            $('.otw-woo-reviews-bg').addClass("otw-transition");
        }
        isOpen = true;
        startY = 0,
        startX = 0;
        currentY = 0,
        currentX = 0; 
        return false; 
 
       
     }
     function MenuIsClosed() { 
        $('.otw-woocommerce-single').removeClass("otw-top");
        $('.otw-woocommerce-single').addClass("otw-bottom");
        $('.otw-floating-cart').addClass("otw-add-height");
        $('.otw-archive__content').attr("style", "");
        $('.otw-woocommerce-single').attr("style", "");
        if ($(".otw-woo-reviews.otw-woo-reviews-open")[0]){
           $('.otw-woo-reviews-bg').removeClass("otw-transition");
       }
        $('body').attr("style", "");
        $('html').attr("style", "");
        startY = 0,
        startX = 0;
        currentY = 0,
        currentX = 0; 
        return false; 
       }
       function MenuIsOpen(e) {
            $('.otw-woocommerce-single').removeClass("otw-bottom");
            $('.otw-woocommerce-single').addClass("otw-top");
            $('.otterwp-content').attr("style", "");
            $('html').css('height', '100vh');
            $('body').css('overflow','hidden');
            $('body').css('position','fixed');
            $('body').css('top', - position);
           
            return false; 
            
       }

      $(document).off('click').on('click', ".otw-bottom .otw-woocommerce-header__content, .otw-bottom .otw-woocommerce-header__thumbnail", function opneClosedMenu(e) {
        position = $(document).scrollTop() + 46;
        var container = $('body');
        - container.offset().top 
        + container.scrollTop();
        if ($('div.otw-bottom').length) {
            window.location.hash = postid; 
            return false;     
        }
        return false; 
       
      });
      $(document).on('click', ".otw-minimize-btn", function minimizeMenu (e) {

            MenuIsClosed();
            window.location.hash = '';
            $(window).scrollTop(position);
        
        });
        $(window).on("resize", function (e) {
            checkScreenSize();
        });
    
        checkScreenSize();
        
        function checkScreenSize(){
            var newWindowWidth = $(window).width();
            if (newWindowWidth < 481) { // if window width is under threshhold for mobile divices
                $(document).on('click', '.otter-woo-data', function (e) {
                    e.preventDefault();
                    postid = $(this).attr('data-id');  
                    updateItem(e);
                   
                  });
                  $(document).on('click', '.product_type_grouped', function (e) {
                    e.preventDefault();
                    $(".otw-woocommerce-single").remove();
                    postid = $(this).attr('data-product_id');
                    updateItem(e);
                    
                  });                  
                  $(document).on('click', '.product_type_variable', function (e) {
                    e.preventDefault();
                    $(".otw-woocommerce-single").remove();
                    postid = $(this).attr('data-product_id');
                    updateItem(e);
                  });
                  
                  $(document).ready(function(){
                        $(document).trigger('onLandEvent', [1011]);
                  });
  

            }else{// else window width is greater then threshold for mobile divices
                if ($(".otw-woo-ative")[0]){// if on shop page
                    var hash = window.location.hash;
                    var hashid = hash.replace("#", "");
                    var a_href = $(".otter-woo-data[data-id='" + hashid +"'] a").attr('href');;
                    if (!hashid) // if hash is null remove mobile content 
                    {
                        $(".otw-woocommerce-single").remove();
                                        
                    }else// if hash has a value redirect to full page
                    {
                        $(this).once(window.location.replace(a_href));
                    }
            }
            }

        }
        function updateItem(e, scrollPos) {
            $(".otw-woocommerce-single").remove();
            var scrollPos = $(document).scrollTop() + 46;
            position = scrollPos;
            var container = $('body');
            - container.offset().top 
            + container.scrollTop();
            $.ajax({
                type: "POST",
                url: woo_my_ajax_object.ajax_url,
                timeout: 3000,
                security: nonce,
                data: {
                    action: 'otterwp_woo_load_more',
                    postid: postid,
                    security: nonce,
                },
                beforeSend: function(){
                    $( ".otw-loading" ).addClass("otter_items_wrap_loading");
                },
                error: function () {
                    $( ".otw-loading" ).removeClass("otter_items_wrap_loading");
                    alert( "Opps somthing went wrong. Try again" );
                },
                complete: function(){
                    $( ".otw-loading" ).removeClass("otter_items_wrap_loading");
                }, 
                
                success: function (data) {

                    
                        if(!data)// if data is empty do nothing
                        {
                            $('body').attr("style", "");
                            $('html').attr("style", "");
                            alert( "Opps somthing went wrong. Try again" );
                        }else// else load mobile content
                        {
                        setTimeout(function(){
                            $('body').css('position','fixed');
                            $('body').css('overflow','hidden');
                            $('html').css('height', '100vh');
                            $('body').css('top', -position);
                            $('body').append(data);
                            $( '.woocommerce-product-gallery', data ).each( function() {
                            $( '.woocommerce-product-gallery' ).wc_product_gallery();
                            
                            $.getScript(site.theme_path);
                            window.location.hash = postid;
                        },50);
                        } );
                        }
                        
                       
                    
                        },
   
                    });
                    e.stopImmediatePropagation();
                    return false; 
        }
        function updateUi() {
          
            if (isMoving)// if isMoving is true
            {
                if(moveY > 0){
                    $('.otw-woocommerce-header').removeClass('otw-swipe');
                    $('.otw-top').css("transform", "translateY(" +  moveY + 'px' + ")");
                    $('.otterwp-content').css("opacity", newOpacity);
                    if ($(".otw-woo-reviews.otw-woo-reviews-open")[0]){
                        $('.otw-woo-reviews').css("opacity", newOpacity);
                        $('.otw-woo-reviews').addClass("no-transition");
                        $('.otw-woo-reviews-bg').addClass("no-transition");
                    }
                    requestAnimationFrame(updateUi);
                }
            }else// else isMoving is false
            {
                $('.otw-woocommerce-header').addClass('otw-swipe');
                if ($(".otw-woo-reviews.otw-woo-reviews-open")[0]){
                    $('.otw-woo-reviews').removeClass("no-transition");
                    $('.otw-woo-reviews-bg').removeClass("no-transition");
                }

            }
        };

        $(document).on('hashChange', function(e, eventInfo) { 
       e.stopPropagation? e.stopPropagation() : e.cancelBubble = true;
        e.preventDefault();
            var subscribers = $('.otw-woo-ative');
            subscribers.trigger('hashChangeHandler', [eventInfo]);
        });
        $(document).one('onLandEvent', function(e, eventInfo) { 
            var subscribers = $('.otw-woo-ative');
            subscribers.trigger('onLandHandler', [eventInfo]);
            e.stopPropagation();
        });

        $(window).bind('hashchange', function() {
                $(document).trigger('hashChange', [1011]);
        });
       
        $(document).on('hashChangeHandler', function(e) {
            var hash = window.location.hash; // Assign hash to varalible
            var hashid = hash.replace("#", ""); // remove # from number
            if(hashid === '')// hash is empte closed page
            {
                MenuIsClosed();
            }else 
            {
                if (hashid === postid)// hash matchs postid open page
                {
                        MenuIsOpen(e);
                                      
                }else // hash dose not match loads new mobile content
                {
                    postid = hashid
                    updateItem(e);
                    }
                }
                return false;    
        });
        $(document).one('onLandHandler', function(e) { 
            if ($(".otw-woo-ative")[0]){
                if (postid == null){
                    return;
                }else{  
                    if(window.location.hash.length === 0){
                        return;
                    }else{              
                    var hash = window.location.hash;
                    postid = hash.replace("#", "");
                    updateItem(e);
                    }
                }
            }
            
            
        });
        
});
