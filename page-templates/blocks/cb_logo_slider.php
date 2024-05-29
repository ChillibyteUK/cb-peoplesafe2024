<!-- logo_slider -->
<section class="logos py-5">
    <div class="container">
		<?php
		if (get_field('title')) {
			?>
		<h2 class="text-center"><?=get_field('title')?></h2>
		    <?php
		}
		else {
			?>
        <h2 class="text-center">Some of our clients</h2>
		    <?php
		}
		?>
        <div class="logo__slider mb-5">
            <?php
        while (have_rows('logos')) {
            the_row();
            ?>
            <div class="logo__slide">
                <?php
                $img = wp_get_attachment_image_url(get_sub_field('logo'),'thumbnail');
                ?>
                <img src="<?=$img?>" class="img-fluid" alt="">
            </div>
            <?php
        }
            ?>
        </div>
        <?php
        if (get_field('show_case_study_link')) {
            ?>
        <div class="text-center">
            <a href="/case-studies/" class="btn btn-primary">View our case studies</a>
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
    $('.logo__slider').slick({
        infinite: true,
        dots: true,
        arrows: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    arrows: true,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 576,
                settings: {
                    arrows: false,
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
