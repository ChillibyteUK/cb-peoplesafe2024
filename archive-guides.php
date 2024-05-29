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

</style>
<main id="main" class="pt-5">
    <div class="container py-3">
        <div class="page-meta">
            <h1>Guides</h1>
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>
        <div class="row">
            <?php
            while (have_posts()) {
                the_post();
				if (get_field('hide_from_index')[0] === 'Yes') {
                    continue;
                }
                $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                if (!$img) {
                    $img = catch_that_image($post);
                }
                // $cats = get_the_category();
                // $category = $cats[0]->name;
                ?>
                <div class="col-md-6 col-lg-4 col-xl-3 mb-4 pt-2 pb-4">
                    <div class="guide">
                        <a href="<?=get_the_permalink()?>">
                            <div class="guide__image"><img src="<?=$img?>" class="img-fluid"></div>
                            <div class="guide__inner">
                                <div class="guide__title"><?=get_the_title()?></div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <!-- <div class="scroller-status">
            <div class="loader-ellips infinite-scroll-request">
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
            </div>
        </div> -->
        <?=numeric_posts_nav()?>


        <!-- <nav class="pagination">
            <div class="prev-posts-link alignright"><?php echo get_next_posts_link('Older Entries', $posts->max_num_pages); ?></div>
            <div class="next-posts-link alignleft"><?php echo get_previous_posts_link('Newer Entries'); ?></div>
        </nav> -->
    </div>
</section>
</main>
<?php

get_footer();
