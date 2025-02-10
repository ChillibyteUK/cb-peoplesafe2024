<?php
/**
 * The main template file
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$user = wp_get_current_user();

if($user && isset($user->user_login) && 'chillibyte' == $user->user_login) {
?>
<style>
.btn-secondary--sm_old.active {
    background-color: #ffa823 !important;
}
</style>
<main id="main" class="pt-5">
    <div class="container py-3">
        <div class="page-meta text-center">
            <h1>Safety Products</h1>
        </div>
        <div class="pb-4 text-center">
            <?=apply_filters('the_content',get_field('products_intro','options'))?>
        </div>
        <div class="button-group filter-button-group mb-4 text-center">
            <button class="btn btn-secondary btn-secondary--sm_old active mb-1" data-filter="*">All</button>
            <?php
            $terms = get_terms( 'ptypes', array('orderby' => 'menu_order', 'order' => 'desc') );
            foreach ($terms as $t) {
                echo '  <button class="btn btn-secondary btn-secondary--sm mb-1" data-filter=".' . $t->slug . '">' . $t->name . '</button>';
            }
            ?>
        </div>
        <div id="products" class="row">
            <?php
            while (have_posts()) {
                the_post();
                $types = get_the_terms(get_the_ID(),'ptypes');
                // $type = $types ? $types[0]->slug : '';
                $type = $types ? implode(" ", wp_list_pluck($types,'slug')) : '';

                $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                if (get_field('alternative_product_image')) {
                    $img = wp_get_attachment_image_url(get_field('alternative_product_image'), 'large');
                }
                elseif (!$img) {
                    $img = catch_that_image($post);
                }
                // $cats = get_the_category();
                // $category = $cats[0]->name;
                ?>
                <div class="col-md-4 mb-4 sproduct <?=$type?>">
                    <div class="products__single">
                        <div class="products__desc">
                            <?=get_field( 'hover_content', get_the_ID() )?>
                        </div>
                        <a href="<?=get_the_permalink()?>">
                            <div class="products__image"><img src="<?=$img?>" class="img-fluid"></div>
                            <div class="products__title"><?=get_the_title()?></div>
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?=numeric_posts_nav()?>
    </div>
</section>
</main>
<?php
} else {
?>
<main id="main" class="pt-5">
    <div class="container py-3">
        <div class="page-meta">
            <h1>Safety Products</h1>
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>
        <div class="pb-4">
            <?=apply_filters('the_content',get_field('products_intro','options'))?>
        </div>
        <div class="button-group filter-button-group mb-4">
            <button class="btn btn-secondary btn-secondary--sm active mb-1" data-filter="*">All</button>
            <?php
            $terms = get_terms( 'ptypes', array('orderby' => 'menu_order', 'order' => 'desc') );
            foreach ($terms as $t) {
                echo '  <button class="btn btn-secondary btn-secondary--sm mb-1" data-filter=".' . $t->slug . '">' . $t->name . '</button>';
            }
            ?>
        </div>
        <div id="products" class="row">
            <?php
            while (have_posts()) {
                the_post();
                $types = get_the_terms(get_the_ID(),'ptypes');
                // $type = $types ? $types[0]->slug : '';
                $type = $types ? implode(" ", wp_list_pluck($types,'slug')) : '';

                $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                if (get_field('alternative_product_image')) {
                    $img = wp_get_attachment_image_url(get_field('alternative_product_image'), 'large');
                }
                elseif (!$img) {
                    $img = catch_that_image($post);
                }
                // $cats = get_the_category();
                // $category = $cats[0]->name;
                ?>
                <div class="col-md-4 mb-4 sproduct <?=$type?>">
                    <div class="products__single">
                        <div class="products__desc">
                            <?=get_field( 'hover_content', get_the_ID() )?>
                        </div>
                        <a href="<?=get_the_permalink()?>">
                            <div class="products__image"><img src="<?=$img?>" class="img-fluid"></div>
                            <div class="products__title"><?=get_the_title()?></div>
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?=numeric_posts_nav()?>
    </div>
</section>
</main>
<?php
}
?>
<?php
add_action('wp_footer',function(){
    ?>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script>
(function($){

    var $grid = $('#products').isotope({
		itemSelector: '.sproduct',
        layoutMode: 'fitRows',
	});

    <?php
    if (isset($_REQUEST['q'])) {
        $f = $_REQUEST['q'];
        ?>
        $('.filter-button-group').find('.active').removeClass('active');
        $('.filter-button-group').find(`[data-filter='.<?=$f?>']`).addClass('active');
        $grid.isotope({filter: '.<?=$f?>'});
        <?php
    }
    ?>
    
    $('.filter-button-group').on( 'click', 'button', function() {
        currentFilter = $(this).attr('data-filter');
        $('.filter-button-group').find('.active').removeClass('active');
        $(this).addClass('active');
        $grid.isotope({filter: currentFilter});
    });


})( jQuery );
</script>
    <?php
});

get_footer();
