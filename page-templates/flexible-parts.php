<?php
/**
 * Setup for page blocks
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (have_rows('flexible_blocks')) {
    while (have_rows('flexible_blocks')) {
        the_row();

        get_template_part('/page-templates/flex-blocks/' . get_row_layout());

    }
}
elseif (get_the_content()) {
    the_content();
}
else {
    echo 'no sections';
}

?>

