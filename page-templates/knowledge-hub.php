<?php
/*
Template Name: Knowledge Hub
*/

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
the_post();

?>
<main id="main" class="pt-5">
    <div class="container-xl py-5" id="knowledge">
        <div class="text-center">
            <h1><?=get_the_title()?></h1>
            <?=get_the_content()?>
        </div>
        <section class="latest pb-5">
            <h2>Latest</h2>
            <?php
            $l = new WP_Query(array(
                'post_type' => array('post','news','guides','whitepapers','legislation'), // ,'case_studies'),
                'posts_per_page' => 3,
                'post_status' => 'publish',
                'post__not_in' => get_field('hidden_posts','options')
            ));
            ?>
            <div class="latest__grid">
                <?php
                $c = 1;
                while ($l->have_posts()) {
                    $l->the_post();
                    $type = get_post_type($l->ID) == 'post' ? 'blog' : get_post_type($l->ID);
                    $img = get_the_post_thumbnail_url( $l->ID, 'large' );
                    if (!$img) {
                        $img = catch_that_image(get_post($l->ID));
                    }
                    ?>
                    <a href="<?=get_the_permalink($l->ID)?>" class="latest__card">
                        <div class="latest__image">
                            <?=get_the_post_thumbnail(get_the_ID(), 'large')?>
                            <div class="flash flash--<?=acf_slugify($type)?>"><?=ucfirst($type)?></div>
                        </div>
                        <div class="latest__container p-4">
                            <div class="latest__content">
                                <h3 class="mb-2"><?=get_the_title()?></h3>
                                <div class="latest__excerpt">
                                    <?=wp_trim_words(get_the_content($l->ID),20)?>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php
                    $c++;
                }
                ?>
            </div>
        </section>

        <section class="blogs pb-5">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="d-flex justify-content-between align-content-center mb-4">
                        <h2 class="mb-0">Blogs</h2>
                        <a href="/blogs/" class="align-self-center kh_link">View all &gt;</a>
                    </div>
                    <?php
                    $b = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 2,
                        'post_status' => 'publish',
                        'post__not_in' => get_field('hidden_posts','options')
                    ));
                    while ($b->have_posts()) {
                        $b->the_post();
                        $img = get_the_post_thumbnail_url( $b->ID, 'large' );
                        if (!$img) {
                            $img = catch_that_image(get_post($b->ID));
                        }
                        ?>
                        <a href="<?=get_the_permalink($l->ID)?>" class="latest__card latest__card--short mb-4">
                            <div class="latest__image">
                                <?=get_the_post_thumbnail(get_the_ID(), 'large')?>
                                <div class="flash flash--blog">Blog</div>
                            </div>
                            <div class="latest__container p-4">
                                <div class="latest__content">
                                    <h3 class="mb-2"><?=get_the_title()?></h3>
                                    <div class="latest__excerpt">
                                        <?=wp_trim_words(get_the_content($l->ID),20)?>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="col-lg-6">
                    <div class="d-flex justify-content-between align-content-center mb-4">
                        <h2 class="mb-0">News</h2>
                        <a href="/news/" class="align-self-center kh_link">View all &gt;</a>
                    </div>
                    <?php
                    $n = new WP_Query(array(
                        'post_type' => 'news',
                        'posts_per_page' => 2,
                        'post_status' => 'publish',
                        'post__not_in' => get_field('hidden_posts','options')
                    ));
                    while ($n->have_posts()) {
                        $n->the_post();
                        $img = get_the_post_thumbnail_url( $n->ID, 'large' );
                        if (!$img) {
                            $img = catch_that_image(get_post($n->ID));
                        }
                        ?>
                        <a href="<?=get_the_permalink($l->ID)?>" class="latest__card latest__card--short mb-4">
                            <div class="latest__image">
                                <?=get_the_post_thumbnail(get_the_ID(), 'large')?>
                                <div class="flash flash--news">News</div>
                            </div>
                            <div class="latest__container p-4">
                                <div class="latest__content">
                                    <h3 class="mb-2"><?=get_the_title()?></h3>
                                    <div class="latest__excerpt">
                                        <?=wp_trim_words(get_the_content($l->ID),20)?>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>

        <section class="guides pb-5">
            <div class="d-flex justify-content-between align-content-center mb-4">
                <h2 class="mb-0">Guides</h2>
                <a href="/guides/" class="align-self-center kh_link">View all &gt;</a>
            </div>
            <div class="row g-4">
                <?php
                    $n = new WP_Query(array(
                        'post_type' => 'guides',
                        'posts_per_page' => 4,
                        'post_status' => 'publish',
                        'post__not_in' => get_field('hidden_posts','options')
                    ));
                    while ($n->have_posts()) {
                        $n->the_post();
                        $img = get_the_post_thumbnail_url( $n->ID, 'large' );
                        if (!$img) {
                            $img = catch_that_image(get_post($n->ID));
                        }

                        $content = get_the_content(null, false, $n->ID);
                        $blocks = parse_blocks($content);
                        $left_content = '';
                        $content = '';

                        foreach ($blocks as $block) {
                            if ($block['blockName'] === 'acf/cb-two-columns') {
                                // Get the left_content field from the block's inner content
                                if (isset($block['attrs']['data']['left_content'])) {
                                    $left_content .= ' ' . $block['attrs']['data']['left_content'];
                                }
                            }
                        }
                        if ($left_content) {
                            // Trim the left_content to 20 words
                            $content = wp_trim_words($left_content, 15);
                        } else {
                            // Fallback to regular content if no left_content was found
                            $content = wp_trim_words(get_the_content($n->ID), 15);
                        }

                        ?>
                        <div class="col-lg-3 col-md-6">
                            <a href="<?=get_the_permalink($n->ID)?>" class="guide_card">
                                <div class="guide_card__image">
                                    <?=get_the_post_thumbnail(get_the_ID(), 'large', array('class' => 'guide_card__img'))?>
                                    <div class="flash flash--guide">Guide</div>
                                </div>
                                <h3><?=get_the_title()?></h3>
                                <div class="guide_card__content"><?=$content?></div>
                            </a>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                ?>
            </div>
        </section>

        <section class="infographics pb-5">
            <div class="d-flex justify-content-between align-content-center mb-4">
                <h2 class="mb-0">Infographics</h2>
                <a href="/infographics/" class="align-self-center kh_link">View all &gt;</a>
            </div>
            <div class="swiper infographics__slider mb-4">
                <div class="swiper-wrapper">
                <?php
                if (get_field('infographics')) {
                    $q = new WP_Query(array(
                        'post_type' => 'infographics',
                        'posts_per_page' => -1,
                        'post__in' => get_field('infographics')
                    ));
                }
                else {
                    $q = new WP_Query(array(
                        'post_type' => 'infographics',
                        'posts_per_page' => -1,
                    ));
                }

                while ($q->have_posts()) {
                    $q->the_post();
                    $image = wp_get_attachment_image( get_field('file',get_the_ID()), 'large' );
                    ?>
                <div class="swiper-slide infographics__slide">
                    <a href="<?=get_the_permalink(get_field('file',get_the_ID()))?>" download class="infographics__card">
                        <div class="infographics__image">
                            <?=$image?>
                        </div>
                        <h3><?=get_the_title()?></h3>
                    </a>
                </div>
                    <?php
                }
                // wp_reset_postdata();
                ?>
                </div>
                <div class="swiper-pagination swiper-pagination-infographics"></div>
            </div>
        </section>

        <section class="whitepapers pb-5">
            <div class="row">
                <div class="col-lg-6">
                    <div class="d-flex justify-content-between align-content-center mb-4">
                        <h2 class="mb-0">Whitepapers</h2>
                        <a href="/whitepapers/" class="align-self-center kh_link">View all &gt;</a>
                    </div>
                    <?php
                    $w = new WP_Query(array(
                        'post_type' => 'whitepapers',
                        'posts_per_page' => 1,
                        'post_status' => 'publish',
                        'post__not_in' => get_field('hidden_posts','options')
                    ));
                    while ($w->have_posts()) {
                        $w->the_post();
                        ?>
                    <a href="<?=get_the_permalink($l->ID)?>" class="whitepapers__card h-auto">
                        <div class="whitepapers__image">
                            <?=get_the_post_thumbnail(get_the_ID(), 'large', array('class' => 'whitepapers__img'))?>
                            <div class="flash flash--guide">Whitepaper</div>
                        </div>
                        <h3 class="mb-2"><?=get_the_title()?></h3>
                    </a>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="col-lg-6">
                    <div class="d-flex justify-content-between align-content-center mb-4">
                        <h2 class="mb-0">Video</h2>
                        <a href="/video/" class="align-self-center kh_link">View all &gt;</a>
                    </div>
                    <?php
                    $l = new WP_Query(array(
                        'post_type' => 'video',
                        'posts_per_page' => 1,
                        'post_status' => 'publish',
                        'post__not_in' => get_field('hidden_posts','options')
                    ));
                    while ($l->have_posts()) {
                        $l->the_post();
                        // $img = get_the_post_thumbnail( $l->ID, 'large');
                        $img = get_vimeo_data_from_id(get_field('vimeo_id', get_the_ID()), 'thumbnail_url') ?: get_stylesheet_directory_uri() . '/img/ps-logo-placeholder.png';
                        ?>
                    <a href="<?=get_the_permalink($l->ID)?>" class="latest__card h-auto">
                        <div class="latest__image">
                            <img src="<?=$img?>" alt="">
                        </div>
                        <h3 class="mb-2"><?=get_the_title()?></h3>
                    </a>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>

                </div>
            </div>
        </section>
    </div>
    <section class="gradient_cta py-5 bg_grad--orange">
        <div class="gradient_cta__image" style="--bg-url:url(/wp-content/uploads/2024/06/Group-43.png)"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-5">
                    <h2>Find out how you can protect your employees today</h2>
                    <div class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis sed iusto iure omnis voluptatem, in atque id hic placeat reiciendis saepe at ullam labore facere inventore dicta molestias? Quod, neque!</div>
                    <a href="/book-a-demo-video/" class="btn">Book a Demo Today</a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php

add_action('wp_footer', function () {
    ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        var infographicsSlider = new Swiper('.infographics__slider', {
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: true,
            },
            pagination: {
                el: '.swiper-pagination-infographics',
                clickable: true,
                dynamicBullets: true,
            },
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 18, // Adjust this value to match your design
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 18,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 18,
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 18,
                },
            },
            on: {
                init: function() {
                    setEqualHeight('.infographics__slide');
                },
                resize: function() {
                    setEqualHeight('.infographics__slide');
                }
            }
        });

        window.addEventListener('load', setEqualHeight('.infographics__slide'));

    });
</script>
<?php
}, 9999);

get_footer();