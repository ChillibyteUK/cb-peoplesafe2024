<!-- sector_nav -->
<section class="sector_nav py-5">
    <div class="container">
        <div class="row">
        <?php
        // $terms = get_terms( array(
        //     'taxonomy' => 'sectors',
        //     'hide_empty' => true,
        // ) );
        // foreach ($terms as $c) {
        //     echo '<div class="col-md-4"><a href="/sectors/' . $c->slug . '/">' . $c->name . '</a></div>';
        // }
        $parent = get_page_by_path( 'sectors' );
        $q = new WP_Query(array(
            'post_type' => 'page',
            'post_parent' => $parent->ID,
            'posts_per_page' => -1
        ));
        while ($q->have_posts()) {
            $q->the_post();
            ?>
            <div class="col-md-4 mb-4 sector_nav__sector">
                <a href="<?=get_the_permalink()?>">
                    <div class="card text-center"><?=get_the_title()?></div>
                </a>
            </div>
            <?php
        }
        wp_reset_postdata();
        ?>
    </div>
</section>