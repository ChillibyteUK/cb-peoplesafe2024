<?php
$overlay = '';
if (isset(get_field('watermark')[0])) {
    $overlay = 'stat_spinner--overlay';
}
?>
<style>.counter{display:inline}</style>
<!-- stat_spinner -->
<section class="stat_spinner <?=$overlay?> py-5">
    <div class="container">
        <div class="stats">
            <?php
            while (have_rows('spinner_stats')) {
                the_row();
            ?>
            <div class="stat">
                <div class="stat__inner">
                    <?php
                    $endval = get_sub_field('stat');
                    $endval = preg_replace('/,/', '.', $endval);
                    $decimals = strlen(substr(strrchr($endval, "."), 1));
					$suffix = get_sub_field('suffix');
                    ?>
                    <!-- <div class="stat__value gradient-text--<?=get_sub_field('colour')?>"> -->
                    <div class="stat__value text--<?=get_sub_field('colour')?>">
                        <?=do_shortcode("[countup start='0' end='{$endval}' decimals='{$decimals}' duration='3' scroll='true']")?><?=$suffix?>
                        <div class="stat__qualifier"><?=get_sub_field('title')?></div>
                    </div>
                    <div class="stat__title"><?=get_sub_field('description')?></div>
                </div>
            </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
<?php
add_action('wp_footer', function () {
    ?>
<script type="text/javascript">
(function($){
    $('.stats').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 6000,
        speed: 1000,
        arrows: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 992,
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
}, 9999);