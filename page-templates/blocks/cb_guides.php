<section class="pb-5" id="knowledge">
    <div class="container guides ">
        <div class="h2__container">
            <h2>Guides</h2>
            <div class="h2__link"><a href="/guides/">View all</a></div>
        </div>
        <div class="row">
            <?php
                $n = new WP_Query(array(
                    'post_type' => 'guides',
                    'posts_per_page' => 3,
                    'post_status' => 'publish'
                ));
                while ($n->have_posts()) {
                    $n->the_post();
                    $img = get_the_post_thumbnail_url( $n->ID, 'large' );
                    if (!$img) {
                        $img = catch_that_image(get_post($n->ID));
                    }
                    ?>
                    <div class="col-lg-4">
                        <a href="<?=get_the_permalink($n->ID)?>">
                            <div class="latest__image" style="background-image:url('<?=$img?>')"></div>
                            <h3><?=get_the_title()?></h3>
                        </a>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            ?>
        </div>
    </div>
</section>