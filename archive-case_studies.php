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
<main id="main" class="pt-5">
    <div class="container py-3">
        <div class="page-meta">
            <h1>Case Studies</h1>
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>
        <div class="pb-4">
			<?=apply_filters('the_content',get_field('case_study_intro','options'))?>
        </div>
        <div class="row">
            <div class="col-md-1">
                <strong>Sector</strong>
            </div>
            <div class="col-md-5">
                <select class="filters-select form-control mb-4">
                    <option value="*">All</option>
                    <?php
                    $terms = get_terms( 'sectors' );
                    foreach ($terms as $t) {
                        echo '  <option value=".' . $t->slug . '">' . $t->name . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div id="cs" class="row">
            <?php
            while (have_posts()) {
                the_post();
                $types = get_the_terms(get_the_ID(),'sectors');
                $type = join(' ',wp_list_pluck($types, 'slug')); // ? $types[0]->slug : '';
                $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                if (!$img) {
                    $img = catch_that_image($post);
                }
                // $cats = get_the_category();
                // $category = $cats[0]->name;
                ?>
                <div class="col-md-4 mb-4 caseStudy <?=$type?>">
                    <div class="caseStudy__single">
                        <div class="caseStudy__desc">
                            <?=get_field('hover_description')?>
                        </div>
                        <a href="<?=get_the_permalink()?>">
                            <div class="caseStudy__image">
                                <img src="<?=$img?>" class="img-fluid">
                            </div>
                            <div class="caseStudy__title"><?=get_the_title()?></div>
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
add_action('wp_footer',function(){
    ?>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script>
(function($){

    var $grid = $('#cs').isotope({
		itemSelector: '.caseStudy',
        layoutMode: 'fitRows',
	});
    
    $('.filters-select').on( 'change', function() {
        var currentFilter = this.value;
        $grid.isotope({filter: currentFilter});
    });


})( jQuery );
</script>
    <?php
});

get_footer();
