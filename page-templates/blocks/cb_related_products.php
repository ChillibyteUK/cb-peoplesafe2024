<!-- related_products -->
<section class="related_products py-5">
    <div class="container-xl">
        <?php if (!get_field('hide_title')) {
            $title = get_field('title') ?? 'Related Products';
            ?>
        <h2 class="text-center mb-5"><?=$title?></h2>
        <?php
        }
        ?>
        <div class="row justify-content-center">
            <?php
            foreach (get_field('related_products') as $r) {
                // $img = get_the_post_thumbnail_url( $r->ID, 'large' );
                // if (!$img) {
                //     $img = catch_that_image($r);
                // }
                ?>
            <div class="col-md-6 col-lg-3 mb-4">
                <a href="<?=get_the_permalink($r->ID)?>"
                    class="related_products__card">
                    <?=get_the_post_thumbnail($r->ID, 'large', array('class' => 'related_products__image'))?>
                    <div class="related_products__inner">
                        <h3><?=get_the_title($r->ID)?></h3>
                    </div>
                </a>
            </div>
            <?php
            }
        ?>
        </div>
    </div>
</section>