<!-- case_user_combo -->
<section class="case_user_combo py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2>Case Studies</h2>
                <?php
                foreach (get_field('case_studies') as $c) {
                    ?>
                    <a href="<?=get_the_permalink($c->ID)?>" class="noline text-dark">
                <div class="row mb-4">
                    <div class="col-sm-3">
                        <?php
                        $img = get_the_post_thumbnail_url($c->ID,'medium') ?
                                get_the_post_thumbnail_url($c->ID,'medium') :
                                get_stylesheet_directory_uri() . '/img/ps-placeholder-200x200.jpg';
                        ?>
                        <img src="<?=$img?>" class="img-fluid">
                    </div>
                    <div class="col-sm-9">
                        <h3 class="h4"><?=get_the_title($c->ID)?></h3>
                                                <div><?php
                        if (get_field('hover_description',$c->ID)) {
                            echo get_field('hover_description',$c->ID);
                        }
                        else {
                            echo wp_trim_words(get_the_content(null,false,$c->ID),20);
                        }
                        ?></div>
                    </div>
                </div>
                    </a>
                    <?php
                }
                ?>
            </div>
            <div class="col-lg-6 border-lg-left">
                <h2>User Stories</h2>
                <div class="story__slider">
                    <?php
                    foreach (get_field('user_stories') as $u) {
                        ?>
                        <div class="story__slide">
                            <h3 class="h4"><?=get_the_title($u->ID)?></h3>
                            <?=get_the_content(null,false,$u->ID)?>
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
        autoplay: true,
        autoplaySpeed: 8000,
    });
})(jQuery);
</script>
    <?php
},9999);

?>
