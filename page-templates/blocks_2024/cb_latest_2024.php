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
        <div class="swiper-container latest_2024__slider mb-5">
            <div class="swiper-wrapper">
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
                    <div class="swiper-slide latest_2024__slide pb-4">
                        <a class="latest_2024__card" href="<?=get_the_permalink($l->ID)?>">
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
            <div class="swiper-pagination"></div>
        </div>
        <div class="text-center"><a href="#" class="button button-outline">View All Articles</a></div>
    </div>
</section>
<?php
add_action('wp_footer',function(){
    ?>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    function setEqualHeight() {
        let maxHeight = 0;
        const slides = document.querySelectorAll('.swiper-slide');

        // Remove existing heights to recalculate
        slides.forEach(slide => {
            slide.style.height = 'auto';
        });

        // Find the maximum height
        slides.forEach(slide => {
            if (slide.offsetHeight > maxHeight) {
                maxHeight = slide.offsetHeight;
            }
        });

        // Set all slides to the maximum height
        slides.forEach(slide => {
            slide.style.height = `${maxHeight}px`;
        });
    }


    var swiper = new Swiper('.latest_2024__slider', {
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: true,
        },
        slidesPerView: 1,
        spaceBetween: 18, // Adjust this value to match your design
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
        },
        on: {
            init: function() {
                setEqualHeight();
            },
            resize: function() {
                setEqualHeight();
            }
        }
    });

    window.addEventListener('load', setEqualHeight);

});
</script>
    <?php
},9999);

?>
