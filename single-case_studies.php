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
        <div class="row">
            <div class="col-md-8 d-flex align-items-center">
                <h1><?=get_the_title()?></h1>
            </div>
            <div class="col-md-4 d-flex align-items-center">
                <img src="<?=get_the_post_thumbnail_url(get_the_ID(),'large')?>" alt="">
            </div>
        </div>
        <div class="py-4">
            <?=apply_filters('the_content', get_the_content())?>
        </div>
    </div>
</main>
<?php

get_footer();
