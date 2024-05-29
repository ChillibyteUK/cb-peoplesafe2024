<?php

switch (get_field('theme')) {
    case 'dark':
        $bg = 'bg--dark';
        break;
    case 'light':
        $bg = 'bg--light';
        break;
    default:
        $bg = 'bg_grad--' . get_field('theme');
}

$cta = get_field('cta');
?>
<style>
    .newsletter_signup form {
        display: flex;
        gap: 1rem;
    }

    .newsletter_signup .gform_body {
        width: 80%;
        max-width: 400px;
    }

    .newsletter_signup .gform_body input[type=email] {
        font-size: 1rem !important;
        min-height: 45px;
    }

    .newsletter_signup .gform_footer {
        padding: 0 !important;
        margin: 0 !important;
    }

    .newsletter_signup .gform_footer input[type=submit] {
        background: black;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
    }

    .newsletter_signup .bg--dark .gform_footer input[type=submit] {
        background-color: #ffb423;
        color: black;
    }
</style>
<!-- newsletter_signup -->
<section class="newsletter_signup py-5 <?=$bg?>">
    <div class="container">
        <div class="row">
            <div class="col-md-5 order-md-2">
                <img src="<?=get_stylesheet_directory_uri()?>/img/Newsletter.png"
                    style="max-width:350px">
            </div>
            <div class="col-md-7 order-md-1">
                <h2><?=get_field('title')?></h2>
                <p><?=get_field('intro')?></p>
                <?=do_shortcode('[gravityform id="1" title="false"]')?>
            </div>
        </div>
    </div>
</section>