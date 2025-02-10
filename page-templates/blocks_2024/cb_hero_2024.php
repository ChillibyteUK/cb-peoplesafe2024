<?php
?>
<div class="product_header_2024">
    <div class="container-xl py-5">
        <?php
        if (get_field('hide_breadcrumbs')[0] != 'Yes') {
            ?>
        <div class="page-meta pt-4">
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
            <div class="col-md-4 order-md-2">
                <img src="<?=get_the_post_thumbnail_url(get_the_ID(),'full')?>" class="img-fluid d-flex mx-auto">
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
                if (get_field('hide_cta')[0] != 'Yes') {
                    if ( get_the_ID( == 10366 ) {
                    ?>
                    <a type="button" href="https://peoplesafe.co.uk/get-a-quote/" class="button button-yellow text-center me-3 w-100 w-md-auto">Get a Quote</a>
                    <?php
                    } else {
                    ?>
                    <button type="button" class="button button-yellow text-center me-3 w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#demoModal">Book a Demo</button>
                    <?php
                    }
                }
                if (get_field('brochure')) {
                    echo '<a href="' . get_field('brochure') . '" target="_blank" class="button button-outline text-center me-3 w-100 w-md-auto">Download Brochure</a>';
                }

                if (get_field('ebook')) {
                    $title = get_field('cta_title') ?: 'Download e-book';
					// https://insights.peoplesafe.co.uk/story/peoplesafe-alert-e-book/
                    echo ' <a href="' . get_field('ebook') . '" target="_blank" class="button button-outline text-center me-3 w-100 w-md-auto">' . $title . '</a>';
                }
                ?>
            </div>
        </div>
    </div>
</div>