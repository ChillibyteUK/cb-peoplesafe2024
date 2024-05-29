<!-- related_products -->
<section class="related_products py-5">
    <div class="container">
        <?php if (!get_field('hide_title')) {
            ?>
        <h2 class="text-center">Related Products</h2>
            <?php
        }
        ?>
        <div class="row justify-content-center products">
            <?php
            foreach (get_field('related_products') as $r) {
                $img = get_the_post_thumbnail_url( $r->ID, 'large' );
                if (!$img) {
                    $img = catch_that_image($r);
                }
                ?>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="products__single">
                    <a href="<?=get_the_permalink($r->ID)?>">
                        <div class="products__image"><img src="<?=$img?>" class="img-fluid"></div>
                        <div class="products__title"><?=get_the_title($r->ID)?></div>
                    </a>
                </div>
            </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>