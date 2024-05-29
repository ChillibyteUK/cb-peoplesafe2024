<?php
$images = get_field('logos');
?>
<!-- featured_in -->
<section class="featured_in">
    <div class="container-xl py-5">
        <h2 class="text-center">As featured in</h2>
        <div class="featured_in__images">
            <?php
            foreach ($images as $i) {
                ?>
            <div class="featured_in__image">
                <?php
                $img = wp_get_attachment_image_url($i,'full');
                ?>
                <img src="<?=$img?>" class="img-fluid" alt="">
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
    $('.featured_in__images').slick({
        infinite: true,
        dots: false,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 1000,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    dots: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
})(jQuery);
</script>
    <?php
},9999);