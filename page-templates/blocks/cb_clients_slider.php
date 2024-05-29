<?php
$q = new WP_Query( array(
    'post_type' => 'case_studies',
    'post_status' => 'publish',
    'posts_per_page' => -1
) );
?>
<!-- clients_slider -->
<section class="clients py-5">
    <div class="container">
        <h2 class="text-center">Some of our clients</h2>
        <div class="clients__slider">
            <?php
        while ($q->have_posts()) {
            $q->the_post();
            if (!get_the_post_thumbnail_url(get_the_ID(),'large')) {
                continue;
            }
            ?>
            <div class="clients__slide">
                <a href="<?=get_the_permalink()?>">
                    <?php
                    $img = get_the_post_thumbnail_url(get_the_ID(),'large');
                    ?>
                    <img src="<?=$img?>" class="img-fluid" alt="<?=get_the_title()?>">
                </a>
            </div>
            <?php
        }
            ?>
        </div>
    </div>
</section>
<?php
wp_reset_postdata();

add_action('wp_footer',function(){
    ?>
<script>
(function($){
    $('.clients__slider').slick({
        infinite: true,
        dots: false,
        arrows: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
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

?>
