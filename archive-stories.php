<?php
/**
 * The main template file
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>
<main id="main" class="pt-5">
    <div class="container py-3">
        <h1>Real Life Stories</h1>
        <div class="page-meta">
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>
        <div class="pb-4">
			<?=get_field('stories_intro','options')?>
        </div>
    </div>
    <section class="sector_nav py-5">
        <div class="container">
            <div class="row justify-content-center">
            <?php
            $terms = get_terms( 'incidents' );
            foreach ($terms as $t) {
                echo '<div class="col-md-3 mb-4 sector_nav__sector"><a href="/stories/' . $t->slug . '/"><div class="card py-4 text-center">' . $t->name . '</div></a></div>';
            }
            ?>
            </div>
        </div>
    </section>
</main>
<?php

get_footer();
