<?php
$theme = get_field('theme');
?>
<!-- big_quote_slider -->
<section class="quote_slider py-5 bg--<?=$theme?>">
    <div class="container">
        <div class="quote_slider__slider mb-5">
            <?php
            $classes = ['quotes--blue', 'quotes--orange', 'quotes--pink'];
            $classIndex = 0; // Initialize the class index

        while (have_rows('quotes')) {
            the_row();

            $class = $classes[$classIndex % count($classes)];

            ?>
                <div class="quote_slide">
                    <div class="quotes quotes--large <?=$class?>">
                        <?=wp_get_attachment_image( get_sub_field('image'), 'large', false, array('class' => 'quotes__image'))?>
                        <div class="quotes__inner">
                            <div class="quotes__quote">
                                <?=get_sub_field('quote')?>
                            </div>
                            <div class="quotes__cite"><?=get_sub_field('attribution')?></div>
                            <?=wp_get_attachment_image( get_sub_field('logo'), 'medium', false, array('class' => 'quotes__logo'))?>
                        </div>
                    </div>
                </div>
            <?php
            $classIndex++;
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
    $('.quote_slider__slider').slick({
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
