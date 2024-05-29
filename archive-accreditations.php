<?php
/**
 * The main template file
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>
<main id="main" class="pt-5">
    <div class="container py-3">
        <div class="page-meta">
            <h1>Accreditations</h1>
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>
        <div class="pb-5">
            <h2>Taking your worker safety seriously</h2>
            <p>The Peoplesafe personal safety service is accredited to the highest industry standards. It is also consistently monitored, assessed, and rigorously tested to ensure that we provide the very best service possible.</p>
            <p>We strictly adhere to best practice, keeping up with new and existing legislation and stringently following industry guidelines.</p>
            <p>As pioneers in the worker safety sector, Peoplesafe also plays an instrumental role in developing the latest industry standards for better employee protection.</p>
            <p>A committee member of the British Security Industry Association’s (BSIA) Lone Worker Section, we continue to advise and work with key industry stakeholders and regulatory bodies, including the National Police Chief’s Council (NPCC) and the British Standards Institute (BSI).</p>
        </div>
        <h2>Our Accreditations</h2>
        <p>Our business has achieved the following standards/accreditations:</p>
        <div class="row">
            <?php
            while (have_posts()) {
                the_post();
                $img = wp_get_attachment_image_url( get_field('logo'), 'large');
                ?>
                <div class="col-md-6 col-lg-4 accreditation mb-4 pt-2 pb-4">
                    <?php
                    if (get_the_content()) {
                        echo '<a href="' . get_the_permalink() . '">';
                    }
                    ?>
                        <div class="accreditation__image mb-4" style="background-image:url(<?=$img?>)"></div>
                        <div class="accreditation__inner">
                            <div class="accreditation__title"><?=get_the_title()?></div>
                            <div class="accreditation__intro"><?=get_field('intro')?></div>
                        </div>
                    <?php
                    if (get_the_content()) {
                        echo '</a>';
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
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
                <div class="mb-4">Our service is accredited to the highest industry standards, including all five parts of BS 8484:2016. Speak to one of our experts to understand how this benefits your business</div>
                <a href="/contact-us/" class="btn">Learn more</a>    
            </div>
        </div>
    </div>
</section>

</main>
<?php

get_footer();
