<?php
$title = get_field('title');
?>
<!-- related_resources -->
<section class="related_resources py-5">
    <div class="container">
        <?php
        if ( $title != "" ) {
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
            foreach (get_field('related_resources') as $r) {
                $img = get_the_post_thumbnail_url( $r->ID, 'large' );
                if (!$img) {
                    $img = catch_that_image($r);
                }
                ?>
                <div class="col-md-4 mb-4 mb-md-0 related_resources__card">
                    <a href="<?=get_the_permalink($r->ID)?>" class="noline text-dark">
                        <img src="<?=$img?>" class="related_resources__image">
                        <h3 class="related_resources__title"><?=get_the_title($r->ID)?></h3>
                        <div class="related_resources__content">
                            <?php
                            if (get_post_type( $r->ID ) == 'guides') {
								echo wp_trim_words(apply_filters('the_content', get_the_content(null, false, $r->ID)),20);
                            }
                            else {
                                echo wp_trim_words(get_the_content(null,false,$r->ID),20);
                            }
                            ?>
                        </div>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>