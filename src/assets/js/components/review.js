import $ from 'jquery';
$(document).ready(function() {

    var startTime;
    var touchingElement = false;
    var dragDirection = "";
     var startY = 0,
         startX = 0;
     var currentY = 0,
         currentX = 0;
     var isOpen = false;
     var isMoving = false;
     var menuHeight = "";
     var lastY = 0;
     var lastX = 0;
     var moveY = 0; // where in the screen is the menu currently
     var maxOpacity = 1;

     var newOpacity = 0;
     
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
   
     $(document).on("touchstart", ".otw-woo-reviews__header", function(evt) {
        $('.otw-woo-reviews-bg').addClass("otw-transition");
         startTime = new Date().getTime();
         startY = evt.touches[0].pageY;
         startX = evt.touches[0].pageX;
         //var hight = this.clientHeight;
         touchingElement = true;
         touchStart(startY, startX, $(this)); 
         $('.otw-woo-reviews-bg').removeClass("has-transition");
       });
   
       $(document).on("touchend", ".otw-woo-reviews__header", function(evt) {
   
 
     // Calculating new position of scrollbar
     $('.otw-woo-reviews').removeClass("no-transition");
     $('.otw-woo-reviews-bg').removeClass("no-transition");
         const translateY = currentY - startY; // distance moved in the x axis
         const translateX = currentX - startX; // distance moved in the y axis
 
         const timeTaken = (new Date().getTime() - startTime);
         touchingElement = false;
         touchEnd(currentY, currentX, translateY, translateX, timeTaken, $(this));
      
     });
     $(document).on("touchmove", ".otw-woo-reviews__header",  debounce(function(evt) {
         // if (!touchingElement)
         //     return;
         const hight = this.clientHeight;
 
         currentY = evt.touches[0].pageY;
         currentX = evt.touches[0].pageX;
         const translateY = currentY - startY; // distance moved in the x axis
         const translateX = currentX - startX; // distance moved in the y axis
         
         touchMove(evt, currentY, currentX, translateY, translateX, hight, $(this));
         evt.stopPropagation();
     }));
 
   function touchStart(startY, startX) {
     
        $('.otw-woo-reviews').addClass("no-transition");
        $('.otw-woo-reviews-bg').addClass("no-transition");
     
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
               //var menuHeight = hight;
               var id = $(thisObj);
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
 
 
                     var percentageBeforeDif = (Math.abs(moveY) * 100) / 200;
                     var percentage = 100 - percentageBeforeDif;
                     newOpacity = (((maxOpacity) * percentage) / 100 );
                     //var newHeight = menuHeight - moveY / 25;
                    
                 }
                 requestAnimationFrame(updateUi);                 
           }
           
         
           
 
       
       function touchEnd(currentY, currentX, translateY, translateX, timeTaken, hight, thisObj, position) {
         //var menuHeight = hight;
         isMoving = false;
         var velocity = 0.3;
         const id = $(thisObj);
     
        
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
                   openMenu(thisObj);
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
                   translateY = null;
               }
 
           }
           
         }

         newOpacity = '';
         translateY = null;
     }
     function updateUi() {
  
        if (isMoving) {
            $('.otw-woo-reviews__header').removeClass('otw-swipe');
            $('.otw-woo-reviews-bg').css("opacity", newOpacity);
            $('.otw-woo-reviews').css("transform", "translateY(" +  moveY + 'px' + ")");
            requestAnimationFrame(updateUi);            
        }else{
            $('.otw-woo-reviews__header').addClass('otw-swipe');
            $('.otw-woo-reviews-bg').attr("style", "");
            $('.otw-woo-reviews-bg').removeClass("no-transition");
        }
    }
   function closeMenu(translateY) {
           if (translateY > 0 || !isOpen) {
             $('.otw-woo-reviews').removeClass("otw-woo-reviews-open");
             $('.otw-woo-review').removeClass("otw-woo-review-open");
             $('.otw-woo-review').addClass("otw-woo-review-closed");
             $('.otw-woo-reviews-bg').removeClass("otw-transition");  
             $('.otw-woo-reviews-bg').removeClass("has-transition");
             $('.otw-woo-reviews-bg').attr("style", "");
             $('.otw-woo-reviews').attr("style", "");
             startY = 0,
             startX = 0;
             currentY = 0,
             currentX = 0;       
            if ($(".otw-floating-cart")[0]){
                $(".otw-floating-cart").addClass("otw-add-height");
            }             
           }
           
           
       }
   function openMenu() {
    $('.otw-woo-reviews').attr("style", "");
    $('.otw-woo-reviews').removeClass("no-transition");
    startY = 0,
    startX = 0;
    currentY = 0,
    currentX = 0; 
     }
     $(document).on('click', '.otw-woo-review-closed', function (e) {
        $('.otw-woo-review').removeClass("otw-woo-review-closed");
        $('.otw-woo-review').addClass("otw-woo-review-open");
        $('.otw-woo-reviews').addClass("otw-woo-reviews-open");
        $('.otw-woo-reviews').removeClass("no-transition");
        $('.otw-woo-reviews-bg').addClass("otw-transition");
        $('.otw-woo-reviews-bg').addClass("has-transition");
        if ($(".otw-floating-cart")[0]){
            $(".otw-floating-cart").removeClass("otw-add-height");
        }


   });
     $(document).on('click', '.otw-woo-reviews-close', function (e) {
        $('.otw-woo-reviews').removeClass("otw-woo-reviews-open");
        $('.otw-woo-review').removeClass("otw-woo-review-open");
        $('.otw-woo-review').addClass("otw-woo-review-closed");
        $('.otw-woo-reviews-bg').removeClass("has-transition");
        $('.otw-woo-reviews-bg').removeClass("otw-transition");   
        $('.otw-woo-reviews').attr("style", "");
       
       if ($(".otw-floating-cart")[0]){
           $(".otw-floating-cart").addClass("otw-add-height");
       }  

     });
});

