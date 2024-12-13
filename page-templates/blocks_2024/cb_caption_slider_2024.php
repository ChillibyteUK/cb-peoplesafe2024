<!-- logo_slider -->
<section class="captions py-5">
    <div class="container-xl">
        <?php
        $d = 0;
        if (get_field('title')) {
        ?>
            <h2 class="text-center" data-aos="fade">
                <?= get_field('title') ?>
            </h2>
        <?php
            $d += 100;
        }
        ?>
        <div class="swiper captions__slider mb-5" data-aos="fade" data-aos-delay="<?= $d ?>">
            <div class="swiper-wrapper">
                <?php
                while (have_rows('cards')) {
                    the_row();
                    $l = get_sub_field('page') ?? null;
                ?>
                    <div class="swiper-slide captions__slide">
                        <a href="<?= $l['url'] ?>">
                            <?= wp_get_attachment_image(get_sub_field('image'), 'thumbnail') ?>
                            <div><?= get_sub_field('caption') ?></div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="swiper-pagination swiper-pagination-captions"></div>
        </div>
    </div>
</section>
<?php
add_action('wp_footer', function () {
?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var logoSlider = new Swiper('.captions__slider', {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination-captions',
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