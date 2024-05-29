<?php
$grad = get_field('theme');
?>
<!-- banner -->
<section class="banner py-3 bg_grad--<?=$grad?>">
    <div class="container text-larger">
        <div class="ticker">
        <?php
        while (have_rows('content')) {
            the_row();
            echo '<div class="ticker__item">' . get_sub_field('item') . '</div>';
        }
        ?>
        </div>
    </div>
</section>
<?php
add_action('wp_footer',function(){
    ?>
<script>
(function($){
    $('.ticker').slick({
        infinite: true,
        dots: false,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
    });
})(jQuery);
</script>
    <?php
},9999);