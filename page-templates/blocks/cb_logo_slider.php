<!-- logo_slider -->
<section class="logos py-5">
    <div class="container-xl">
        <?php
        $d=0;
        if (get_field('title')) {
            ?>
        <h2 class="text-center" data-aos="fade">
            <?=get_field('title')?>
        </h2>
            <?php
        } else {
            ?>
        <h2 class="text-center" data-aos="fade">Some of our clients</h2>
        <?php
        }
        $d+=100;
        ?>
        <div class="swiper logo__slider mb-5" data-aos="fade" data-aos-delay="<?=$d?>">
            <div class="swiper-wrapper">
                <?php
        while (have_rows('logos')) {
            the_row();
            ?>
                <div class="swiper-slide logo__slide">
                    <?=wp_get_attachment_image(get_sub_field('logo'), 'thumbnail')?>
                </div>
            <?php
        }
        ?>
            </div>
            <div class="swiper-pagination swiper-pagination-logos"></div>
        </div>
        <?php
        $d+=100;
        if (get_field('show_case_study_link')) {
            ?>
        <div class="text-center" data-aos="fade" data-aos-delay="<?=$d?>">
            <a href="/case-studies/" class="button button-yellow"><span>View our case studies</span></a>
        </div>
        <?php
        }
        ?>
    </div>
</section>
<?php
add_action('wp_footer', function () {
    ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var logoSlider = new Swiper('.logo__slider', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination-logos',
                dynamicBullets: true,
            },
            slidesPerView: 2,
            slidesPerGroup: 1,
            spaceBetween: 18,
            breakpoints: {
                768: {
                    slidesPerView: 3,
                    spaceBetween: 18,
                },
                992: {
                    slidesPerView: 4,
                    spaceBetween: 18,
                },
                1200: {
                    slidesPerView: 5,
                    spaceBetween: 18,
                }
            }
        });
    });
</script>
<?php
}, 9999);

        ?>