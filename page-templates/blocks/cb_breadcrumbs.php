<?php
$theme = get_field('theme');
?>
<!-- breadcrumbs -->
<section class="breadcrumbs bg--<?=$theme?>">
    <div class="container">
        <div class="page-meta">
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                // yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                yoast_breadcrumb();
            }
            ?>
        </div>
    </div>
</section>