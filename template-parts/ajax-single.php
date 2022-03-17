<?php
/**
 * Ajax woocommerce single item template
 *
 * @package     Otterwp
 * @author      Otterwp
 * @link        https://www.otterwp.io/
 * @since       Otterwp 1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
$review_count = $product->get_review_count();
$product_link = $product->get_permalink();
$product_title = $product->get_title();
?>
<div data-id="<?php echo get_the_ID() ?>" class="otw-woocommerce-single otw-top">
            <div class="otw-minimize-btn right-bottom-fixed">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.008 16.008">
                    <g transform="translate(-1865.147 -163.146)">
                        <line x1="15.301" y2="15.301" transform="translate(1865.5 163.5)"/>
                        <line x2="15.301" y2="15.301" transform="translate(1865.5 163.5)"/>
                    </g>
                </svg>
            </div> <!--- .otw-minimize-btn --->
    <div class="otw-woocommerce-header otw-swipe">            
            <div class="otw-woocommerce-header__thumbnail">
                <?php echo woocommerce_get_product_thumbnail(); ?>
            </div><!--- .otw-woocommerce-header__thumbnail --->

        <div class="otw-woocommerce-header__content">

        
            <?php echo woocommerce_template_single_title(); ?>

     
            <?php echo woocommerce_template_single_price(); ?>

        </div> <!--- .otw-woocommerce-header__content --->
        <?php echo woocommerce_template_loop_add_to_cart(); ?>
        <p class="otw-swipe-msg"><?php echo _e('Sipe Down To Close', 'woo-otterwp'); ?></p>
    </div><!--- .otw-woocommerce-header --->

    <div id="project-content" class="otterwp-content">
        <div class="entry-content">
        <div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
        

                <?php do_action( 'woocommerce_before_single_product_summary' ); ?>

                <div class="summary entry-summary">
                    <?php
   
                     echo woocommerce_template_single_title();
                     echo woocommerce_template_single_price();
                     echo woocommerce_template_single_excerpt();
                     echo woocommerce_template_single_add_to_cart();
                     echo woocommerce_template_single_meta();
                     echo woocommerce_template_single_sharing();
                    ?>
                </div><!--- .summary entry-summary --->
            </div><!--- .product --->
            
        
        <div class="otw-woo-description"> 
            <h2><?php printf(__('Description', 'woo-otterwp')); ?></h2>
            <?php the_content(); ?>
        </div><!--- .otw-woo-description --->
        <div class="otw-woo-additional">
            <?php woocommerce_product_additional_information_tab(); ?>
        </div><!--- .otw-woo-additional --->
        

        </div><!--- .entry-content --->
            <div class="otw-woo-related"> <?php woocommerce_output_related_products(); ?></div>
            <?php if(empty($review_count)){?>
            <div class="otw-reply">
                <?php echo '<a class="button otw-reply" href=' . $product_link . '>'. __('Leave a Review for ', 'woo-otterwp') . $product_title . '</a>';?>
            </div><!--- .otw-reply --->
            <div class="otw-margin"></div><!--- .otw-margin --->
        <?php } else{?>
            <div class="otw-reply">
                <?php echo '<a class="button otw-reply" href=' . $product_link . '>'. __('Leave a Review for ', 'woo-otterwp') . $product_title . '</a>';?>
            </div>
            <div class="otw-margin"></div><!--- .otw-margin --->
            <?php } ?>
        </div><!--- .otterwp-content --->

        <?php if(empty($review_count)){?>
            
        <?php } else{ ?>
        <div class="otw-woo-review otw-woo-review-closed">
            <div class="otw-woo-review__avatar">
            <h2><?php printf(__('Reviews', 'woo-otterwp')); ?>
                        <?php echo $review_count;?>
                    </h2>
                <?php echo get_avatar($comments[0]->comment_author_email); ?> 
            </div><!--- .otw-woo-review__avatar --->
            <div class="otw-woo-review__content">
            <p><?php echo  get_comment_excerpt($comments[0])?> </p>
            <?php echo wc_get_rating_html( $product->get_average_rating() ) ?>
            </div><!--- .otw-woo-review__content --->
        </div> <!--- .otw-woo-review --->
       <?php
        }
?>
<?php if(empty($review_count)){                     
    return null;
                } else{ ?>
            <div class="otw-woo-reviews"> 
               
                    

            <div class="otw-woo-reviews__header">
                <h2><?php printf(__('Reviews', 'woo-otterwp')); ?>
                    <?php echo $review_count;?>
                </h2>
                <div class="otw-woo-reviews-close">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.008 16.008">
                        <g transform="translate(-1865.147 -163.146)">
                            <line x1="15.301" y2="15.301" transform="translate(1865.5 163.5)"/>
                            <line x2="15.301" y2="15.301" transform="translate(1865.5 163.5)"/>
                        </g>
                    </svg>
                </div><!--- .otw-woo-reviews-close --->
            </div><!--- .otw-woo-reviews__header --->
           <div class="otw-woo-reviews__body">
 
                <?php wp_list_comments( array( 'callback' => 'woocommerce_comments' ), $comments)  ?>
            
            <div class="otw-reply">
                <?php echo '<a class="button otw-reply" href=' . $product_link . '>'. __('Leave a Review for ', 'woo-otterwp') . $product_title . '</a>';?>
            </div><!--- .otw-reply --->

        
       

        </div><!--- .otw-woo-reviews__body --->
    </div><!--- .otw-woo-reviews --->
    <?php }?>
    <?php if(empty($review_count)){
        return null;
    }else{?>
    <div class="otw-woo-reviews-bg"></div><!--- .otw-woo-reviews-bg --->
    <?php } ?>

</div>
