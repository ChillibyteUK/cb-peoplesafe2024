<!-- case_study/quotes -->
<section class="case_study_quotes py-5">
    <div class="container-xl" data-aos="fade">
        <div class="row g-5">
            <div class="col-lg-5">
                <div class="fs-300 text-blue fw-900 mb-3">Case Studies</div>
                <h2>Hear directly from our customers</h2>
                <p>Don’t just take it from us. Explore what our customers have to say about their experience with Peoplesafe's employee protection services and how it's helped keep their people safe.</p>
                <a href="/case-studies/" class="button button-outline text-center w-100 w-md-auto">View all Case Studies</a>
            </div>
            <div class="col-lg-7">
                <div class="swiper quotes_slider mb-4">
                    <div class="swiper-wrapper">
                        <?php
                        $classes = ['quotes--blue', 'quotes--orange', 'quotes--pink'];
                        $classIndex = 0; // Initialize the class index

                        while (have_rows('quotes')) {
                            the_row();

                            $class = $classes[$classIndex % count($classes)];

                        ?>
                            <div class="swiper-slide quotes_slide">
                                <div class="quotes quotes--large <?= $class ?>">
                                    <?= wp_get_attachment_image(get_sub_field('image'), 'large', false, array('class' => 'quotes__image')) ?>
                                    <div class="quotes__inner">
                                        <div class="quotes__quote">
                                            <?= get_sub_field('quote') ?>
                                        </div>
                                        <div class="quotes__cite"><?= get_sub_field('attribution') ?></div>
                                        <?= wp_get_attachment_image(get_sub_field('logo'), 'medium', false, array('class' => 'quotes__logo')) ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                            $classIndex++;
                        }
                        ?>
                    </div>
                    <div class="swiper-pagination swiper-pagination-quotes"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
add_action('wp_footer', function () {
?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var quotesSlider = new Swiper('.quotes_slider', {
                loop: true,
                // autoplay: {
                //     delay: 4000,
                //     disableOnInteraction: true,
                // },
                pagination: {
                    el: '.swiper-pagination-quotes',
                    clickable: true,
                    dynamicBullets: true,
                },
                slidesPerView: 1,
                slidesPerGroup: 1,
                spaceBetween: 18, // Adjust this value to match your design
                on: {
                    init: function() {
                        setEqualHeight('.quotes_slide');
                    },
                    resize: function() {
                        setEqualHeight('.quotes_slide');
                    }
                }
            });

            window.addEventListener('load', setEqualHeight('.quotes_slide'));

        });
    </script>
<?php
}, 9999);

?>