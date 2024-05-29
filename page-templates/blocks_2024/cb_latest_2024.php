<!-- latest_posts -->
<section class="latest_2024 py-5">
    <div class="container-xl">
        <h2 class="text-center mb-4">Latest News &amp; Blogs</h2>
        <?php
        $excluded = get_field('hidden_posts','options');

        $l = new WP_Query(array(
            'post_type' => array('post','news'), //'guides','whitepapers','legislation'), // ,'case_studies'),
            'posts_per_page' => 4,
            'post_status' => 'publish',
            'post__not_in'    => $excluded,
        ));
        ?>
        <div class="latest_2024__slider mb-5">
            <?php
            $c = 1;
            while ($l->have_posts()) {
                $l->the_post();

                $type = get_post_type($l->ID) == 'post' ? 'blog' : get_post_type($l->ID);
                $img = get_the_post_thumbnail_url( $l->ID, 'large' );
                if (!$img) {
                    $img = catch_that_image(get_post($l->ID));
                }
                ?>
                <div class="laetst_2024__slide px-2 pb-4">
                    <a class="latest_2024__card h-100" href="<?=get_the_permalink($l->ID)?>">
                        <div class="latest_2024__image">
                            <?=get_the_post_thumbnail($l->ID,'large')?>
                            <div class="flash flash--<?=acf_slugify($type)?>"><?=$type?></div>
                        </div>
                        <div class="latest_2024__inner">
                            <h3><?=get_the_title()?></h3>
                            <div class="latest_2024__excerpt mb-2">
                                <?=wp_trim_words(get_the_content($l->ID),15)?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
                $c++;
            }
            ?>
        </div>
        <div class="text-center"><a href="#" class="button button-outline">View All Articles</a></div>
    </div>
</section>
<?php
add_action('wp_footer',function(){
    ?>
<script>
(function($){
    $('.latest_2024__slider').slick({
        infinite: true,
        dots: true,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 6000,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
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
