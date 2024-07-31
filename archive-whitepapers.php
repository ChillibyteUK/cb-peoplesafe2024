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
            <h1>Whitepapers</h1>
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>
        <div id="blogs" class="w-100">
            <?php
            while (have_posts()) {
                the_post();
                $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                if (!$img) {
                    $img = catch_that_image($post);
                }
                // $cats = get_the_category();
                // $category = $cats[0]->name;
                ?>
                <div class="blog-item mb-4 pt-2 pb-4">
                    <div class="row">
                        <div class="col-md-2 news__image"><img src="<?=$img?>" class="img-fluid"></div>
                        <div class="col-md-10 news__inner">
                            <div class="news__title"><a href="<?=get_the_permalink()?>"><?=get_the_title()?></a></div>
                            <div class="news__intro"><?=wp_trim_words(get_the_content(),30)?></div>
                            <div class="news__link"><a href="<?=get_the_permalink()?>">Read More</a></div>
                        </div>
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
