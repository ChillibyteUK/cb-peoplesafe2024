<?php
$theme = get_field('theme');
$padding = get_field('theme') == 'light' ? 'py-5' : 'p-5';
?>
<!-- testimonial_slider -->
<section class="testimonial_slider <?=$padding?> bg--<?=$theme?>">
    <div class="container-xl testimonial_slider__slider">
<?php
foreach (get_field('case_studies') as $c) {
    $post_blocks = parse_blocks( get_the_content( '', false, $c ) );

    $quote = '';
    foreach ( $post_blocks as $block ) {
        if ( 'acf/cb-big-quote' != $block['blockName'] ) {
            continue;   // Skip this block if it's not the right block type
        }
        $quote = $block['attrs']['data']['quote'];
    }

    ?>
    <div class="testimonial_slider__slide">
        <div class="row">
            <div class="col-md-3">
                <img src="<?=get_the_post_thumbnail_url($c,'medium')?>">
            </div>
            <div class="col-md-9">
                <div class="text-center h3"><?=get_the_title($c)?></div>
                <div class="big_quote__quote fs-8"><?=apply_filters('the_content',$quote)?></div>
                <div class="big_quote__link"><a href="<?=get_the_permalink($c)?>">Read More</a></div>
            </div>
        </div>
    </div>
    <?php
}
?>
    </div>
</section>
<?php
add_action('wp_footer',function(){
    ?>
<script>
(function($){
    $('.testimonial_slider__slider').slick({
        infinite: true,
        dots: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 8000,
        speed: 1000,
        fade: true,
        cssEase: 'linear'
    });
})(jQuery);
</script>
    <?php
},9999);

?>