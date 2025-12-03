<!-- latest_posts -->
<section class="latest bg-blue-200 py-5">
    <div class="container-xl">
        <h2 class="text-center mb-4" data-aos="fade">Latest News &amp; Blogs</h2>
        <?php
        $excluded = get_field('hidden_posts', 'options');

        $l = new WP_Query(array(
            'post_type' => array('post','news'), //'guides','whitepapers','legislation'), // ,'case_studies'),
            'posts_per_page' => 4,
            'post_status' => 'publish',
            'post__not_in'    => $excluded,
        ));
        $d=50;
        ?>
        <div class="swiper latest__slider mb-4">
            <div class="swiper-wrapper">
                <?php
        while ($l->have_posts()) {
            $l->the_post();

            $type = get_post_type($l->ID) == 'post' ? 'blog' : get_post_type($l->ID);
            $img = get_the_post_thumbnail_url($l->ID, 'large');
            if (!$img) {
                $img = catch_that_image(get_post($l->ID));
            }
            ?>
                <div class="swiper-slide latest__slide pb-4" data-aos="fade" data-aos-delay="<?=$d?>">
                    <a class="latest__card"
                        href="<?=get_the_permalink($l->ID)?>">
                        <div class="latest__image">
                            <?=get_the_post_thumbnail($l->ID, 'large')?>
                            <div
                                class="flash flash--<?=acf_slugify($type)?>">
                                <?=$type?>
                            </div>
                        </div>
                        <div class="latest__inner">
                            <h3><?=get_the_title()?></h3>
                            <div class="latest__excerpt mb-2">
                                <?=wp_trim_words(get_the_content($l->ID), 15)?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                $d+=50;
        }
        ?>
            </div>
            <div class="swiper-pagination swiper-pagination-news"></div>
        </div>
        <div class="text-center"><a href="/resources/" class="button button-outline">View All Articles</a></div>
    </div>
</section>
<?php
add_action('wp_footer', function () {
    ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        var latestSlider = new Swiper('.latest__slider', {
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: true,
            },
            pagination: {
                el: '.swiper-pagination-news',
                clickable: true,
                dynamicBullets: true,
            },
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 18,
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
            }
        });

    });
</script>
<?php
}, 9999);

        ?>