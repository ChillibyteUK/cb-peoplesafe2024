<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


function jobs_func($atts)
{
    ob_start();
    $q = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => 'careers',
        'post_status' => 'publish'
    ));

    if ($q->have_posts()) {
        ?>
<?php
        while ($q->have_posts()) {
            $q->the_post();
            $imageID = '';
            ?>
<div class="joblisting border-bottom py-2 mb-3">
    <a href="<?=get_the_permalink()?>" class="noline">
        <div class="h3"><?=get_the_title()?></div>
    </a>
</div>
<?php
        }
    } else {
        echo 'We do not have any positions available at this time. Check back later to see new postings.';
    }
    
    /* Restore original Post Data */
    wp_reset_postdata();
    ?>
<?php
    return ob_get_clean();
}
add_shortcode('jobs', 'jobs_func');

function jobs_func2022($atts)
{
    ob_start();
    $q = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => 'careers',
        'post_status' => 'publish'
    ));

    ?>
<style>
    .joblisting2022 .job {
        background-color: #f1f1f1;
        border-radius: 0.25rem;
        margin-bottom: 1rem;
        color: black;
    }

	
    .joblisting2022 .job__title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .joblisting2022 .job__intro {
        font-size: 90%;
    }
	.joblisting2022 .job__link {
		text-align: right;
		font-weight: bold;
		padding-right: 0.5rem;
		position: relative;
	}
	.joblisting2022 .job__link::after {
		content: "\f105";
		font-family: fontawesome;
		width: 1rem;
		padding-left: 0rem;
		position: absolute;
		transition: padding-left 0.2s ease;
	}
	.joblisting2022 a:hover .job__link::after {
		padding-left: 1rem;
	}

    .joblisting2022 .job__image {
        background-size: cover;
        background-position: center right;
        background-repeat: no-repeat;
        clip-path: polygon(15% 0, 100% 0, 100% 100%, 0% 100%);
        min-height: 100px;
    }
</style>
<?php

        if ($q->have_posts()) {
            ?>
<?php
            while ($q->have_posts()) {
                $q->the_post();
                $imageID = '';
                $type = get_the_terms(get_the_ID(), 'ctype')[0];
                $icon = wp_get_attachment_image_url(get_field('icon', $type), 'full');
                $bg = wp_get_attachment_image_url(get_field('image', $type), 'full');
                ?>
<div class="container-xl">
    <div class="joblisting2022">
        <a href="<?=get_the_permalink()?>" class="noline">
            <div class="row job">
                <div class="col-md-1 d-flex justify-content-center align-items-center pt-2 pt-md-0">
                    <img src="<?=$icon?>">
                </div>
                <div class="col-md-6 pt-md-4 pb-4">
                    <div class="job__title"><?=get_the_title()?>
                    </div>
                    <div class="job__intro">
                        <?=wp_trim_words(get_field('banner'), 20)?>
						<div class="job__link">Read more</div>
                    </div>
                </div>
                <div class="col-md-5 job__image"
                    style="background-image:url(<?=$bg?>)"></div>
            </div>
        </a>
    </div>
</div>
<?php
            }
        } else {
            echo 'We do not have any positions available at this time. Check back later to see new postings.';
        }
    
        /* Restore original Post Data */
        wp_reset_postdata();
    ?>
<?php
    return ob_get_clean();
}
add_shortcode('jobs2022', 'jobs_func2022');
?>