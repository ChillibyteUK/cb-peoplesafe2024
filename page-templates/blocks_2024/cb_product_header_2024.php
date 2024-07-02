<?php
?>
<div class="product_header_2024">
    <div class="container-xl py-5">
        <?php
        if (get_field('hide_breadcrumbs')[0] != 'Yes') {
            ?>
        <div class="page-meta pt-5">
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>
            <?php
        }
        ?>
        <div class="row g-4">
            <div class="col-md-4 order-md-2 product_header_2024__image">
                <div class="product_header_2024__imgbg"></div>
                <img src="<?=get_the_post_thumbnail_url(get_the_ID(),'full')?>" class="product_header_2024__img">
            </div>
            <div class="col-md-8 order-md-1 my-auto">
                <h1><?php
                if (get_field('alt_title')) {
                    echo get_field('alt_title');
                }
                else {
                    echo get_the_title();
                }
                ?></h1>
                <div class="product__intro mb-4"><?=get_field('intro')?></div>
                <?php
                if (get_field('buy_now')) {
                    echo '<a href="' . get_field('buy_now') . '" class="button button-yellow me-3 mr-3"><span>Buy Now</span></a>';
                }
                if (get_field('hide_cta')[0] != 'Yes') {
                    ?>
				<button type="button" class="button button-outline me-3" data-bs-toggle="modal" data-bs-target="#demoModal">Book a Demo</button>
                    <?php
					// <a href="/contact-us/" class="btn btn-primary">Book Demo</a>
                }
                if (get_field('brochure')) {
                    echo '<a href="' . get_field('brochure') . '" target="_blank" class="button button-outline">Download product brochure</a>';
                }

                if (get_field('ebook')) {
					// https://insights.peoplesafe.co.uk/story/peoplesafe-alert-e-book/
                    echo ' <a href="' . get_field('ebook') . '" target="_blank" class="button button-outline">Download product e-book</a>';
                }
                ?>
            </div>
        </div>
    </div>
</div>