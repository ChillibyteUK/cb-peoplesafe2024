<?php
/**
 * The main template file
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>
<style>
.btn-secondary--sm_old.active {
    background-color: #ffa823 !important;
}

.related_products_new .related_products__inner ul {
    display: none;
}

.related_products_new .related_products__card {
    min-height: 450px;
}

@media (min-width: 768px) {
    h1 {
        font-size: 4rem;
    }
}
</style>
<main id="main" class="pt-5">
    <div class="container py-3">
        <div class="page-meta text-center mt-md-5">
            <h1>Safety Products</h1>
        </div>
        <div class="pb-4 text-center">
            <?=apply_filters('the_content',get_field('products_intro','options'))?>
        </div>
        <div class="button-group filter-button-group mb-4 text-center">
            <button class="btn btn-secondary btn-secondary--sm_old active mb-1 p-2 px-3" data-filter="*">All</button>
            <?php
            $terms = get_terms( 'ptypes', array('orderby' => 'menu_order', 'order' => 'desc') );
            foreach ($terms as $t) {
                echo '  <button class="btn btn-secondary btn-secondary--sm mb-1 p-2 px-3" data-filter=".' . $t->slug . '">' . $t->name . '</button>';
            }
            ?>
        </div>

        <section class="related_products related_products_new py-5">
            <div class="container-xl">
                <div class="row justify-content-center" id="products">
                    <?php
                    $c = 0;
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
                        ?>
                    <div class="col-md-6 col-lg-3 mb-4 sproduct <?=$type?>">
                        <a href="<?=get_the_permalink($post->ID)?>"
                            class="related_products__card">
                            <?=get_the_post_thumbnail($post->ID, 'large', array('class' => 'related_products__image'))?>
                            <div class="related_products__inner">
                                <h3><?=get_the_title($post->ID)?></h3>
                                <div class="fs-300">
                                <?php
                                $content = get_the_content(null, false, $post->ID);
                                $blocks = parse_blocks($content);
                            
                                // Loop through the blocks
                                foreach ($blocks as $block) {
                                    // Check if the block name is 'acf/cb-product-header-2024'
                                    if ($block['blockName'] === 'acf/cb-product-header-2024' || $block['blockName'] === 'acf/cb-product-header') {
                                        // Return the content of the 'intro' field
                                        echo isset($block['attrs']['data']['intro']) ? $block['attrs']['data']['intro'] : null;
                                        break;
                                    }
                                }
                                ?>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                        $c += 100;
                    }
                ?>
                </div>
            </div>
        </section>

    </div>
</section>
</main>
<?php
add_action('wp_footer',function(){
    ?>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script>
(function($){

    var $grid = $('#products').isotope({
		itemSelector: '.sproduct',
        layoutMode: 'fitRows',
        fitRows: {
            equalheight: true
        }
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