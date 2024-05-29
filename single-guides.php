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
        <h1><?=get_the_title()?></h1>
        <?=apply_filters('the_content', get_the_content())?>
    </div>
</main>
<?php

get_footer();
