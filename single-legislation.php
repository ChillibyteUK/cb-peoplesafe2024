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

$catnames = get_the_category(get_the_ID());
$catnameArr = array();
if ($catnames) {
    foreach ($catnames as $obj) {
        $catnameArr[] = '<a href="' . get_category_link( $obj->term_id ) . '">' . $obj->category_nicename . '</a>';
    }
}
$cats = implode(', ', $catnameArr);
$posttags = get_the_tags();
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
        <div class="news__date">Posted: <span><?=get_the_date('j M, Y')?></span><!-- in <span><?=$cats?></span>-->.</div>
        <div class="py-4">
            <?=apply_filters('the_content', get_the_content())?>
        </div>
        <?=related_posts()?>
    </div>
</main>
<?php

get_footer();
