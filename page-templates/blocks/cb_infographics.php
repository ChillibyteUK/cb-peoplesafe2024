<section class="infographics">
    <div class="container-xl">
        <h2>Infographics</h2>
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
            ?>
        </div>
    </div>
</section>
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
        cssEase: 'linear'
    });
})(jQuery);
</script>
    <?php
},9999);

?>