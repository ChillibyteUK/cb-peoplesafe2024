<!-- latest_posts -->
<?php
$author = get_field('author');
$author_name = get_field('author_name');
$title = get_field('title');
$text = get_field('text');
$photo = get_field('photo');
$linkedin = get_field('linkedin');
$author_obj = get_user_by('id', $author);
?>
<section class="py-5">
    <div class="container-xl">
        <div class="h1__container">
            <h1 class="h2"><?=$author_name?> – <?=$title?></h1>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?php if( !empty( $photo ) ): ?>
                    <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>" />
                <?php endif; ?>
            </div>
            <div class="col-lg-9">
                <?=$text?>
                <?php
                if ($linkedin) {
                ?>
                <div class="social mt-4">
                    <a href="<?=$linkedin?>" target="_blank"><i class="fab fa-linkedin"></i></a> 
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
<section class="pb-5" id="knowledge">
    <div class="container latest">
        <div class="h2__container">
            <h2>Posts by <?php echo $author_obj->display_name; ?></h2>
        </div>
        <?php
        $excluded = get_field('hidden_posts','options');

        $l = new WP_Query(array(
            'post_type' => array('post','news'), //'guides','whitepapers','legislation'), // ,'case_studies'),
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'post__not_in'    => $excluded,
            'author' => $author
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