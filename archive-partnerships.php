<?php
/**
 * The main template file
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$menu = get_field('projects_sidebar_menu','options');
$delay = 1;
?>
<main id="main" class="pt-5">
    <div class="container py-3">
        <h1>Partnerships</h1>
        <div class="page-meta">
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>
        <div class="pb-5">
            <h2>Working collaboratively to improve employee safety</h2>
            <p>Our desire and dedication to keeping your people safe extends beyond the technology and services we provide ourselves. Our established business partnerships provide access to valuable add-on services and products that provide you with even greater levels of employee protection.</p>
            <p>Here are some of our valued partners. Click learn more about how our relationships can benefit your business.</p>
        </div>
        <div class="row">
            <?php
            $q = new WP_Query(array(
                'post_type' => 'products',
                'meta_query' => array(
                    array(
                        'key' => 'is_partnership',
                        'value' => 'Yes',
                        'compare' => 'LIKE'
                    )
                )
            ));
            
            while ($q->have_posts()) {
                $q->the_post();
                $img = wp_get_attachment_image_url( get_field('partnership_logo'), 'large' );
                
                ?>
                <div class="col-md-3 mb-4 pt-2 pb-4 partnership">
                    <a href="<?=get_the_permalink()?>" class="noline text-dark h4">
                        <div class="partnership__image "><img src="<?=$img?>" class="img-fluid"></div>
                        Partnership with <?=get_the_title()?>
                    </a>
                </div>
                <?php
            }
            wp_reset_postdata();
			
            $q = new WP_Query(array(
                'post_type' => 'news',
                'meta_query' => array(
                    array(
                        'key' => 'is_partnership',
                        'value' => 'Yes',
                        'compare' => 'LIKE'
                    )
                )
            ));
			while ($q->have_posts()) {
                $q->the_post();
                $img = wp_get_attachment_image_url( get_field('partnership_logo'), 'large' );
                $title = get_field('partnership_title') ?: get_the_title();
                ?>
                <div class="col-md-3 mb-4 pt-2 pb-4 partnership">
                    <a href="<?=get_the_permalink()?>" class="noline text-dark h4">
                        <div class="partnership__image "><img src="<?=$img?>" class="img-fluid"></div>
                        Partnership with <?=$title?>
                    </a>
                </div>
                <?php
            }
            wp_reset_postdata();
			
            while (have_posts()) {
                the_post();
                $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                if (!$img) {
                    $img = catch_that_image($post);
                }
                ?>
                <div class="col-md-3 mb-4 pt-2 pb-4 partnership">
                    <a href="<?=get_the_permalink()?>" class="noline text-dark h4">
                        <div class="partnership__image "><img src="<?=$img?>" class="img-fluid"></div>
                        Partnership with <?=get_the_title()?>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
        <?=numeric_posts_nav()?>
    </div>
</section>
<?php
$grad = 'orange';
?>
<!-- gradient_cta -->
<section class="gradient_cta py-5 bg_grad--<?=$grad?>">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <h2>Contact us</h2>
                <div class="mb-4">For more information or to discuss a potential partnership, please get in touch.</div>
                <a href="/contact-us/" class="btn">Get in touch</a>    
            </div>
        </div>
    </div>
</section>

</main>
<?php

get_footer();
