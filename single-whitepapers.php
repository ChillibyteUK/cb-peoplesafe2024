<?php
/**
 * The template for displaying all single posts
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
the_post();

?>
<main id="main" class="pt-5">
    <div class="container py-3">
        <div class="page-meta">
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>
        <h1 class="news__title"><?=get_the_title()?></h1>
        <div class="py-4">
            <?=apply_filters('the_content', get_the_content())?>
        </div>
    </div>
</main>
<?php

get_footer();
