<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
// $mt = is_front_page() ? '' : 'margin-top';
$modal = 0;
?>
<main id="main" class="padding-top">
<section class="gradient_cta bg_grad--yellow py-5">
    <div class="container py-5 my-5 d-flex flex-column justify-content-center align-items-center">
        <h1>404</h1>
        <div class="mb-4">We can't seem to find the page you're looking for</div>
        <a href="/" class="btn">Return to Homepage</a>
    </div>
</section>
</main>
<?php
get_footer();