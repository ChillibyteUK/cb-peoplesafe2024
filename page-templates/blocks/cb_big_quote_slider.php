<?php
$theme = get_field('theme');
?>
<!-- big_quote_slider -->
<section class="big_quote_slider py-5 bg--<?=$theme?>">
    <div class="container">
        <div class="big_quote_slider__slider mb-5">
            <?php
        while (have_rows('quotes')) {
            the_row();
            ?>
            <div class="big_quote_slider__slide">
                <?php
                if (get_sub_field('logo')) {
                    ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="big_quote_slider__logo"><?=wp_get_attachment_image(get_sub_field('logo'),[350,200])?></div>
                    </div>
                    <div class="col-md-8">
                        <div class="big_quote_slider__quote"><?=get_sub_field('quote')?></div>
                        <div class="big_quote_slider__attrib"><?=get_sub_field('attribution')?></div>                        
                    </div>
                </div>
                    <?php
                }
                else {
                    ?>
                <div class="big_quote_slider__quote"><?=get_sub_field('quote')?></div>
                <div class="big_quote_slider__attrib"><?=get_sub_field('attribution')?></div>
                    <?php
                }
                ?>
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
    $('.big_quote_slider__slider').slick({
        infinite: true,
        dots: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 8000,
        speed: 1000,
    });
})(jQuery);
</script>
    <?php
},9999);

?>
