<?php
/*
Template Name: Woocommerce
*/

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
the_post();

?>
<main id="main" class="pt-5">
    <div class="container py-5" id="">
        <h1><?=get_the_title()?></h1>
        <?php
        the_content();
        ?>
    </div>
</main>
<?php

get_footer();