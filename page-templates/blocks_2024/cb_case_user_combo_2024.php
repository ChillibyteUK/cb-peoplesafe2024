<!-- case_user_combo -->
<section class="case_user_combo_2024 py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column">
                <h2>Case Studies</h2>
                <div class="case_user_combo_2024__cs">
                <?php
                foreach (get_field('case_studies') as $c) {
                    ?>
                    <a href="<?=get_the_permalink($c->ID)?>" class="case_user_combo_2024__card">
                        <div class="case_user_combo_2024__pill">Case Study</div>
                        <?php
                        $img = get_the_post_thumbnail_url($c->ID,'medium') ?
                                get_the_post_thumbnail_url($c->ID,'medium') :
                                get_stylesheet_directory_uri() . '/img/ps-placeholder-200x200.jpg';
                        ?>
                        <img src="<?=$img?>" class="case_user_combo_2024__logo">
                        <h3 class="case_user_combo_2024__title"><?=get_the_title($c->ID)?></h3>
                        <div class="case_user_combo_2024__excerpt"><?=wp_trim_words(get_the_content(null,false,$c->ID),30)?></div>
                    </a>
                    <?php
                }
                ?>
                </div>
            </div>
            <div class="col-lg-6">
                <h2>User Stories</h2>
                <div class="story__slider">
                    <?php
                    foreach (get_field('user_stories') as $u) {
                        ?>
                        <div class="story__slide">
                            <div class="story__slide_inner">
                                <h3 class="h4"><?=get_the_title($u->ID)?></h3>
                                <?=get_the_content(null,false,$u->ID)?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
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
    $('.story__slider').slick({
        infinite: true,
        dots: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        // autoplay: true,
        autoplay: false,
        autoplaySpeed: 8000,
        rows: 1
    });
})(jQuery);
</script>
    <?php
},9999);

?>
