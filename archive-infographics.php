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
            <h1>Infographics</h1>
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
            }
?>
            <div class="mb-4">
                <?=get_field('infographics_intro', 'options')?>
            </div>
        </div>
        <div id="infographics" class="w-100">
            <div class="row">
                <?php
while (have_posts()) {
    the_post();
    $image = wp_get_attachment_image_url(get_field('file', get_the_ID()), 'large');
    /* <!-- <a href="<?=get_the_permalink(get_field('file', get_the_ID()))?>" class="noline" download> --> */
    ?>
                <div class="col-md-6 col-lg-4 col-xl-3 p-0">
                    <a href="<?=get_the_permalink(get_the_ID())?>"
                        class="noline">
                        <div class="infographics__slide">
                            <div class="infographics__image"
                                style="background-image:url(<?=$image?>)">
                            </div>
                            <div class="infographics__title">
                                <?=get_the_title()?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
}
?>
            </div>
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
            <div class="prev-posts-link alignright"><?php echo get_next_posts_link('Older Entries', $posts->max_num_pages); ?>
    </div>
    <div class="next-posts-link alignleft">
        <?php echo get_previous_posts_link('Newer Entries'); ?>
    </div>
    </nav> -->
    </div>
    </section>
</main>
<?php

get_footer();
?>