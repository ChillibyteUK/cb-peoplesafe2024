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
    <div class="container py-5" id="knowledge">
        <h1><?=get_the_title()?></h1>
        <?php
        the_content();
        ?>
        <section class="latest pb-5">
            <div class="h2__container">
                <h2>Latest</h2>
            </div>
            <?php
            $l = new WP_Query(array(
                'post_type' => array('post','news','guides','whitepapers','legislation'), // ,'case_studies'),
                'posts_per_page' => 3,
                'post_status' => 'publish',
                'post__not_in' => get_field('hidden_posts','options')
            ));
            ?>
            <div class="row">
                <?php
                $c = 1;
                while ($l->have_posts()) {
                    $l->the_post();
                    if ($c == 1) {
                        echo '<div class="col-lg-6 mb-4 mb-lg-0 latest__preview">';
                    }
                    else {
                        echo '<div class="col-lg-3 mb-4 mb-lg-0 latest__preview">';
                    }
                    $type = get_post_type($l->ID) == 'post' ? 'blog' : get_post_type($l->ID);
                    $img = get_the_post_thumbnail_url( $l->ID, 'large' );
                    if (!$img) {
                        $img = catch_that_image(get_post($l->ID));
                    }
                    ?>
                    <a href="<?=get_the_permalink($l->ID)?>">
                        <div class="latest__container">
                            <div class="latest__image" style="background-image:url('<?=$img?>')">
                                <div class="flash"><?=ucfirst($type)?></div>
                            </div>
                            <div class="latest__content">
                                <h3><?=get_the_title()?></h3>
                                <div class="latest__excerpt mb-2">
                                    <?=wp_trim_words(get_the_content($l->ID),20)?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                    $c++;
                }
                ?>
            </div>
        </section>

        <section class="blogs pb-5">
            <div class="row">
                <div class="col-lg-6">
                    <div class="h2__container">
                        <h2>Blogs</h2>
                        <div class="h2__link"><a href="/blogs/">View all</a></div>
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
                        <a href="<?=get_the_permalink($b->ID)?>">
                            <div class="row mb-2 mx-0">
                                <div class="col-lg-4 blogs__image" style="background-image:url('<?=$img?>')"></div>
                                <div class="col-lg-8 py-2"><h3><?=get_the_title()?></h3></div>
                            </div>
                        </a>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="col-lg-6">
                    <div class="h2__container">
                        <h2>News</h2>
                        <div class="h2__link"><a href="/news/">View all</a></div>
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
                        <a href="<?=get_the_permalink($n->ID)?>">
                            <div class="row mb-2 mx-0">
                                <div class="col-lg-4 blogs__image" style="background-image:url('<?=$img?>')"></div>
                                <div class="col-lg-8 py-2"><h3><?=get_the_title()?></h3></div>
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
            <div class="h2__container">
                <h2>Guides</h2>
                <div class="h2__link"><a href="/guides/">View all</a></div>
            </div>
            <div class="row">
                <?php
                    $n = new WP_Query(array(
                        'post_type' => 'guides',
                        'posts_per_page' => 3,
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
                        <div class="col-lg-4">
                            <a href="<?=get_the_permalink($n->ID)?>">
                                <div class="latest__image" style="background-image:url('<?=$img?>')"></div>
                                <h3><?=get_the_title()?></h3>
                            </a>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                ?>
            </div>
        </section>

        <section class="infographics pb-5">
            <div class="h2__container">
                <h2>Infographics</h2>
                <div class="h2__link"><a href="/infographics/" class="noline">View all</a></div>
            </div>
            <div class="infographics__slider">
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
                    $image = wp_get_attachment_image_url( get_field('file',get_the_ID()), 'large' );
                    ?>
                <div>
                    <a href="<?=get_the_permalink(get_field('file',get_the_ID()))?>" download>
                        <div class="infographics__slide">
                            <div class="infographics__image" style="background-image:url(<?=$image?>)"></div>
                            <div class="infographics__title"><?=get_the_title()?></div>
                        </div>
                    </a>
                </div>
                    <?php
                }
                // wp_reset_postdata();
                ?>
            </div>
        </section>
<?php
/*
        <section class="guides pb-5">
            <div class="h2__container">
                <h2>Case Studies</h2>
                <div class="h2__link"><a href="/case-studies/">View all</a></div>
            </div>
            <div class="row">
                <?php
                    $c = new WP_Query(array(
                        'post_type' => 'case_studies',
                        'posts_per_page' => 4,
                        'post_status' => 'publish'
                    ));
                    while ($c->have_posts()) {
                        $c->the_post();
                        $img = get_the_post_thumbnail_url( $c->ID, 'large' );
                        if (!$img) {
                            $img = catch_that_image(get_post($c->ID));
                        }
                        ?>
                        <div class="col-md-6 col-lg-3">
                            <a href="<?=get_the_permalink($c->ID)?>">
                                <div class="caseStudy__image" style="background-image:url('<?=$img?>')"></div>
                                <h3><?=get_the_title()?></h3>
                            </a>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                ?>
            </div>
        </section>
*/
?>

        <section class="whitepapers pb-5">
            <div class="row">
                <div class="col-lg-6">
                    <div class="h2__container">
                        <h2>Whitepapers</h2>
                        <div class="h2__link"><a href="/whitepapers/">View all</a></div>
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
                        $img = get_the_post_thumbnail_url( $w->ID, 'large' );
                        if (!$img) {
                            $img = catch_that_image(get_post($w->ID));
                        }
                        ?>
                    <a href="<?=get_the_permalink($w->ID)?>">
                        <div class="latest__image" style="background-image:url('<?=$img?>')"></div>
                        <h3><?=get_the_title()?></h3>   
                    </a>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="col-lg-6">
                    <div class="h2__container">
                        <h2>Legislation Information</h2>
                        <div class="h2__link"><a href="/legislation/">View all</a></div>
                    </div>
                    <?php
                    $l = new WP_Query(array(
                        'post_type' => 'legislation',
                        'posts_per_page' => 1,
                        'post_status' => 'publish',
                        'post__not_in' => get_field('hidden_posts','options')
                    ));
                    while ($l->have_posts()) {
                        $l->the_post();
                        $img = get_the_post_thumbnail_url( $l->ID, 'large' );
                        if (!$img) {
                            $img = catch_that_image(get_post($l->ID));
                        }
                        ?>
                    <a href="<?=get_the_permalink($l->ID)?>">
                        <div class="latest__image" style="background-image:url('<?=$img?>')"></div>
                        <h3><?=get_the_title()?></h3>   
                    </a>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>

                </div>
            </div>
        </section>

    </div>
</main>
<?php

add_action('wp_footer',function(){
    ?>
<script>
(function($){
    $('.infographics__slider').slick({
        infinite: true,
        dots: false,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        speed: 1000,
        cssEase: 'linear',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
})(jQuery);
</script>
    <?php
},9999);

get_footer();