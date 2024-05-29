<?php
/**
 * The main template file
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

// $term = get_queried_object();
$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
?>
<main id="main" class="pt-5">
    <div class="container py-3">
        <h1>User Stories: <?=$term->name?></h1>
        <div class="page-meta">
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>
        <div id="blogs" class="w-100">
            <?php
            if (have_posts()) {

                while (have_posts()) {
                    the_post();
                    ?>
                <div class="blog-item mb-4 pt-2 pb-4">
                    <h2 class="h2"><?=get_the_title()?></h2>
                    <div class="news__intro"><?=get_the_content()?></div>
                </div>
                    <?php
                }
            }
            else {
                echo 'No posts found.'                ;
            }
            ?>
        </div>
        <?=numeric_posts_nav()?>
    </div>
</section>
</main>
<?php

get_footer();
