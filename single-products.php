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

// $catnames = get_the_category(get_the_ID());
// $catnameArr = array();
// if ($catnames) {
//     foreach ($catnames as $obj) {
//         $catnameArr[] = '<a href="' . get_category_link( $obj->term_id ) . '">' . $obj->category_nicename . '</a>';
//     }
// }
// $cats = implode(', ', $catnameArr);
// $posttags = get_the_tags();
?>
<main id="main" class="product">
    <?php
    the_content();
    ?>
</main>
<?php

get_footer();
