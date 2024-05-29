<?php
/*
Template Name: Support Centre
*/

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
the_post();

?>
<style>
.portal__card {
    padding: 2rem;
    margin-top: 5rem;
    text-align: center;
}
.portal__image {
    display: block;
    max-width: 300px;
    margin-top: -5rem;
    margin-bottom: 1rem;
    margin-inline: auto;
}
</style>
<main id="main" class="pt-5">
<section class="bg--navy">
    <div class="container py-5 text-center">
        <h1 class="h2"><?=get_the_title()?></h1>
        <div class="pb-4">
            <?=get_the_content()?>
        </div>
    </div>
</section>
<section class="portal">
    <div class="container pt-4 pb-5">
        <div class="row">
			<div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="portal__card bg_grad--green">
                    <img src="<?=wp_get_attachment_image_url(get_field('nexus_helpcentre_screen','options'),'large')?>" alt="Nexus" class="portal__image">
                    <h3>Nexus Helpcentre</h3>
                    <a href="<?=get_field('nexus_helpcentre_url','options')?>" class="btn btn-white">Visit</a>
                </div>
            </div>
			<div class="col-md-3"></div>
        </div>
    </div>
</section>
<section class="gradient_cta py-5 bg_grad--orange">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <h2>Having trouble logging in?</h2>
                <div class="mb-4">Please contact the Customer Support team if you are having difficulty accessing your online management portal account.</div>
                <a href="/contact-us/" target="" class="btn">Contact Us</a>    
            </div>
        </div>
    </div>
</section>
</main>
<?php

get_footer();