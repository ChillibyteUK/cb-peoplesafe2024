<!-- case_study/quotes -->
<section class="case_study_quotes py-5">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-5">
                <div class="fs-300 text-blue fw-900 mb-3">Case Studies</div>
                <h2>Hear directly from our customers</h2>
                <p>Don’t just take it from us. Explore what our customers have to say about their experience with Peoplesafe's employee protection services and how it's helped keep their people safe.</p>
                <a href="#" class="button button-outline">View all Case Studies</a>
            </div>
            <div class="col-lg-7">
                <div class="quotes_slider">
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
    </div>
</section>
<?php
add_action('wp_footer',function(){
    ?>
<script>
(function($){
    $('.quotes_slider').slick({
        infinite: true,
        dots: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 6000,
    });
})(jQuery);
</script>
    <?php
},9999);

?>
