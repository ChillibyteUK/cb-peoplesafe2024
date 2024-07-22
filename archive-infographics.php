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
        <div id="infographics" class="infographics w-100">
            <div class="row g-4">
                <?php
while (have_posts()) {
    the_post();
    $image = wp_get_attachment_image(get_field('file', get_the_ID()), 'large');
    ?>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="<?=get_the_permalink(get_the_ID())?>"
                        class="infographics__card">
                        <div class="infographics__slide">
                            <div class="infographics__image">
                                <?=$image?>
                            </div>
                            <h3>
                                <?=get_the_title()?>
                            </h3>
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