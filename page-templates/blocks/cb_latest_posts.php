<!-- latest_posts -->
<section class="py-5" id="knowledge">
    <div class="container latest">
        <div class="h2__container">
            <h2>Latest news &amp; blogs</h2>
        </div>
        <?php
        $excluded = get_field('hidden_posts','options');

        $l = new WP_Query(array(
            'post_type' => array('post','news'), //'guides','whitepapers','legislation'), // ,'case_studies'),
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'post__not_in'    => $excluded,
        ));
        ?>
        <div class="row">
            <?php
            $c = 1;
            while ($l->have_posts()) {
                $l->the_post();
                if ($c == 1) {
                    echo '<div class="col-lg-6 mb-4 mb-lg-0 latest__preview">';
                }
                else {
                    echo '<div class="col-lg-3 mb-4 mb-lg-0 latest__preview">';
                }
                $type = get_post_type($l->ID) == 'post' ? 'blog' : get_post_type($l->ID);
                $img = get_the_post_thumbnail_url( $l->ID, 'large' );
                if (!$img) {
                    $img = catch_that_image(get_post($l->ID));
                }
                ?>
                <a href="<?=get_the_permalink($l->ID)?>">
                    <div class="latest__container">
                        <div class="latest__image" style="background-image:url('<?=$img?>')">
                            <div class="flash"><?=ucfirst($type)?></div>
                        </div>
                        <div class="latest__content">
                            <h3><?=get_the_title()?></h3>
                            <div class="latest__excerpt mb-2">
                                <?=wp_trim_words(get_the_content($l->ID),20)?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
                $c++;
            }
            ?>
        </div>
    </div>
</section>