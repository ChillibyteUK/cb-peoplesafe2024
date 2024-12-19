<?php
$title = get_field('title');
?>
<!-- related_resources -->
<section class="related_resources py-5">
    <div class="container-xl">
        <?php
        if ($title != "") {
            ?>
        <h2 class="text-center"><?=$title?></h2>
        <?php
        } else {
            ?>
        <h2 class="text-center">Related resources</h2>
        <?php
        }
?>
        <div class="row justify-content-center">
            <?php
            $c = 0;
    foreach (get_field('related_resources') as $r) {
        // $img = get_the_post_thumbnail_url($r->ID, 'large');
        // if (!$img) {
        //     $img = catch_that_image($r);
        // }
        ?>
            <div class="col-md-4" data-aos="fade" data-aos-delay="<?=$c?>">
                <a href="<?=get_the_permalink($r->ID)?>"
                    class="related_resources__card">
                    <?=get_the_post_thumbnail($r->ID, 'large', array('class' => 'related_resources__image'))?>
                    <div class="related_resources__inner">
                        <h3><?=get_the_title($r->ID)?></h3>
                        <div class="related_resources__excerpt">
                            <?php
                        if (get_post_type($r->ID) == 'guides') {
                            echo wp_trim_words(apply_filters('the_content', get_the_content(null, false, $r->ID)), 15);
                        } else {
                            echo wp_trim_words(get_the_content(null, false, $r->ID), 15);
                        }
        ?>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            $c += 100;
    }
?>
        </div>
    </div>
</section>