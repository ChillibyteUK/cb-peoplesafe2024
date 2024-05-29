<!-- case_study/quotes -->
<section class="case_study_quotes py-5">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-5">
                <div class="fs-300 text-blue fw-900 mb-3">Case Studies</div>
                <h2>Hear directly from our customers</h2>
                <p>Lorem ipsum dolor sit amet consectetur. Molestie pulvinar feugiat risus convallis et leo neque commodo. Odio odio in commodo egestas dictumst risus porttitor ac quam.</p>
                <a href="#" class="button button-outline">View all Case Studies</a>
            </div>
            <div class="col-lg-7">
                <div class="quotes_slider">
                    <div class="quote_slide">
                        <div class="quotes quotes--blue">
                            <img class="quotes__image" src="<?=get_stylesheet_directory_uri()?>/img/2024/cutouts/cutout1.png">
                            <div class="quotes__inner">
                                <div class="quotes__quote">
                                    "All in all, it's complete peace of mind that our Engineers have protection when out working."
                                </div>
                                <div class="quotes__cite">Alan Cowlishaw, Compliance Engineer</div>
                                <img class="quotes__logo" src="/wp-content/uploads/2018/11/talk-talk-1-300x169.png">
                            </div>
                        </div>
                    </div>
                    <div class="quote_slide">
                        <div class="quotes quotes--orange">
                            <img class="quotes__image" src="<?=get_stylesheet_directory_uri()?>/img/2024/cutouts/cutout2.png">
                            <div class="quotes__inner">
                                <div class="quotes__quote">
                                    "Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores voluptas architecto aspernatur"
                                </div>
                                <div class="quotes__cite">Chester Drawers, Compliance Engineer</div>
                                <img class="quotes__logo" src="/wp-content/uploads/2019/01/optivo-300x169.png">
                            </div>
                        </div>
                    </div>
                    <div class="quote_slide">
                        <div class="quotes quotes--pink">
                            <img class="quotes__image" src="<?=get_stylesheet_directory_uri()?>/img/2024/cutouts/cutout3.png">
                            <div class="quotes__inner">
                                <div class="quotes__quote">
                                    "Ad vel sunt non mollitia praesentium, laborum repellendus sit totam tempora veritatis!"
                                </div>
                                <div class="quotes__cite">Paddy O'Furniture, Compliance Engineer</div>
                                <img class="quotes__logo" src="/wp-content/uploads/2018/11/centre-point-300x169.png">
                            </div>
                        </div>
                    </div>
                </div>
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
