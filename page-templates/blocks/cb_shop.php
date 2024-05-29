<!-- shop -->
<style>
.shop_section {
    background: rgb(0,114,152);
    background: linear-gradient(76deg, rgba(0,114,152,1) 0%, rgba(32,188,169,1) 100%);
}

.shop_section_products h2,
.shop_section_products span.price {
    color: #fff !important;
}

.shop_section_products .btn-primary {
    background-color: #fff !important;
    color: #358da0 !important;
    border-color: #fff;
}

.shop_section_products .btn-primary:hover {
    background-color: #ffa823 !important;
    border-color: #ffa823;
    color: #000!important;
}
</style>
<section class="shop_section py-5 py-md-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12 pt-5 pb-3">
                <h2 class="text-center text-white"><?=get_field('shop_title')?></h2>
                <p class="text-center text-white"><?=get_field('shop_sub_title')?></p>
            </div>
        </div>
<?php
$featured_posts = get_field('skus');
if( $featured_posts ):
?>
        <div class="row">
    <?php foreach( $featured_posts as $post ):
        $featured_img_url = get_the_post_thumbnail_url($post->ID,'large'); 
        ?>
            <div class="col-lg-3 col-12 col-md-6 shop_section_products mb-4">
                <a href="<?php the_permalink($post->ID); ?>"><img src="<?=$featured_img_url?>" alt="<?php the_title($post->ID); ?>" class="img-fluid"></a>
                <div class="text-white h4 mt-3"><?php echo get_the_title($post->ID); ?></div>
                <div class="text-white">
                    <?php
                    $product = wc_get_product( $post->ID );
                    $price = $product->get_price();
                    if ( $post->ID == 7117 ) {
                        $key_1_value = get_post_meta( 7122, 'fee_settings_product_cost', true );
                        $key_1_value_premium = get_post_meta( 7194, 'fee_settings_product_cost', true );
                        $price = '<span class="hide_me">Upfront cost: ' . $price;
                        $price .= '<br>Monthly cost: £' . $key_1_value . ' - £' . $key_1_value_premium . '</span>';
                    } elseif ( $post->ID == 7115 ) {
                        $key_1_value = get_post_meta( 7121, 'fee_settings_product_cost', true );
                        $price = 'Upfront cost: ' . $price;
                        $price .= '<br>Monthly cost: £' . $key_1_value;
                    } elseif ( $post->ID == 7111 ) {
                        //Peoplesafe SOS App
                        $key_1_value = get_post_meta( 7124, 'fee_settings_product_cost', true );
                        $connection_fee = get_post_meta( 7125, 'fee_settings_product_cost', true );
                        $price = 'Upfront cost: £' . $connection_fee;
                        $price .= '<br>Monthly cost: £' . $key_1_value;
                    } elseif ($post->ID == 7113 ) {
                        //PS Pro App
                        $key_1_value = get_post_meta( 7123, 'fee_settings_product_cost', true );
                        $connection_fee = get_post_meta( 7125, 'fee_settings_product_cost', true );
                        $price = 'Upfront cost: £' . $connection_fee;
                        $price .= '<br>Monthly cost: £' . $key_1_value;
                    }
                    echo $price;
                    ?>
                </div>
                <a href="<?php the_permalink($post->ID); ?>" class="btn btn-primary w-100 my-4">Buy Now</a>
            </div>
    <?php endforeach; ?>
        </div>
    <?php 
    // Reset the global post object so that the rest of the page works correctly.
    wp_reset_postdata(); ?>
<?php
endif;
?>
    </div>
</section>