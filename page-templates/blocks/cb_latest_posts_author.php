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
        <div id="blogs" class="w-100">
            <?php
            while ($l->have_posts()) {
                $l->the_post();
                $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                if (!$img) {
                    $img = catch_that_image($post);
                }
                ?>
                <div class="blog-item mb-4 pt-2 pb-4">
                    <div class="row">
                        <div class="col-md-2 news__image"><img src="<?=$img?>" class="img-fluid"></div>
                        <div class="col-md-10 news__inner">
                            <div class="news__title"><a href="<?=get_the_permalink()?>"><?=get_the_title()?></a></div>
                            <div class="news__date"><?=get_the_date('j M, Y')?></div>
                            <div class="news__intro"><?=wp_trim_words(get_the_content(),30)?></div>
                            <div class="news__link"><a href="<?=get_the_permalink()?>">Read More</a></div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>