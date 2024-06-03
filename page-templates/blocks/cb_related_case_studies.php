<?php
$q = new WP_Query(array(
    'post_type' => 'case_studies',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'sectors',
            'terms' => get_field('sectors')
        )
    )
));
?>
<!-- related_case_studies -->
<div class="related_case_studies py-5">
    <div class="container-xl">
        <h2 class="text-center mb-5">Related Case Studies</h2>
        <div class="swiper cs__slider mb-4">
            <div class="swiper-wrapper">
                <?php
        while ($q->have_posts()) {
            $q->the_post();
            // $img = get_the_post_thumbnail_url(get_the_ID(), 'large') ?
            //         get_the_post_thumbnail_url(get_the_ID(), 'large') :
            //         get_stylesheet_directory_uri() . '/img/ps-placeholder-200x200.jpg';
            ?>
                <div class="cs__slide swiper-slide pb-4">
                    <a href="<?=get_the_permalink()?>"
                        class="cs__card">
                        <?=get_the_post_thumbnail(get_the_ID(), 'large', array('class' => '','alt' => get_the_title() ))?>
                        <div class="cs__inner pr-4">
                            <h3><?=get_the_title()?></h3>
                            <div class="cs__excerpt mb-2">
                                <?=wp_trim_words(get_the_content(), 20)?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
        }
?>
            </div>
            <div class="swiper-pagination swiper-pagination-casestudies"></div>
        </div>
    </div>
</div>
<?php
wp_reset_postdata();

add_action('wp_footer', function () {
    ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var logoSlider = new Swiper('.cs__slider', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination-casestudies',
                dynamicBullets: true,
            },
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 18,
            breakpoints: {
                768: {
                    slidesPerView: 1,
                    spaceBetween: 18,
                },
                992: {
                    slidesPerView: 2,
                    spaceBetween: 18,
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 18,
                }
            },
            on: {
                init: function() {
                    setEqualHeight('.cs__slide');
                },
                resize: function() {
                    setEqualHeight('.cs__slide');
                }
            }
        });

        window.addEventListener('load', setEqualHeight('.cs__slide'));
    });
</script>
<?php
}, 9999);

?>