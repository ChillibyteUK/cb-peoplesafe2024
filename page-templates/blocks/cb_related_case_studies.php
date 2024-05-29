<?php
$q = new WP_Query( array(
    'post_type' => 'case_studies',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'sectors',
            'terms' => get_field('sectors')
        )
    )
) );
?>
<!-- related_case_studies -->
<div class="related_case_studies py-5">
    <div class="container">
        <h2 class="text-center">Related Case Studies</h2>
        <div class="cs__slider">
            <?php
        while ($q->have_posts()) {
            $q->the_post();
            ?>
            <div class="cs__slide">
                <a href="<?=get_the_permalink()?>">
                    <?php
                    $img = get_the_post_thumbnail_url(get_the_ID(),'large') ?
                            get_the_post_thumbnail_url(get_the_ID(),'large') :
                            get_stylesheet_directory_uri() . '/img/ps-placeholder-200x200.jpg';
                    ?>
                    <img src="<?=$img?>" class="img-fluid" alt="<?=get_the_title()?>">
                    <div class="cs__content pr-4">
                        <h3 class="h4"><?=get_the_title()?></h3>
                        <?=wp_trim_words(get_the_content(),20)?>
                    </div>
                </a>
            </div>
            <?php
        }
            ?>
        </div>
    </div>
</div>
<?php
wp_reset_postdata();

add_action('wp_footer',function(){
    ?>
<script>
(function($){
    $('.cs__slider').slick({
        infinite: true,
        dots: true,
        arrows: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
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
