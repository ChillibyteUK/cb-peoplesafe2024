<?php
/**
 * The Template for displaying career posts.
 *
 * @package packagename
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

?>
<main id="main" class="pt-5">
    <div class="container py-3">
        <div class="h1">Careers</div>
        <div class="page-meta">
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>
        <h1 class="h2 mb-4"><?=get_the_title()?></h1>
        <?php
        while ( have_posts() ) {
            the_post(); 
            ?>
        <div class="row">
            <div class="col-md-8">
                <h2>The Role</h2>
                <div class="larger pb-4"><?=get_field('banner')?></div>
                <?php
                if (get_field('responsibilities')) {
                    $res = get_field('responsibilities');

                    echo '<h2>Key Responsibilities</h2>';
                    echo '<ul>';

                    foreach ($res as $r) {
                        echo '<li>' . $r['responsibility'] . '</li>';
                    }
                    echo '</ul>';

                }

                if (get_field('job_description')) {
                    echo '<div class="py-4">For the full job description <a href="' . get_field('job_description') . '">click here</a>.</div>';
                }
                ?>
                <div class="py-2">
                <?php
                    echo get_field('contact_details');
                ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="career__card">
                    <div class="h3">Interested? Apply today</div>
                    <div><strong>Job Title</strong></div>
                    <div class="mb-2"><?=get_the_title()?></div>
                    <?php
                    if (get_field('department')) {
                        ?>
                        <div><strong>Department</strong></div>
                        <div class="mb-2"><?=get_field('department')?></div>
                        <?php
                    }
                    if (get_field('reports_to')) {
                        ?>
                        <div><strong>Reporting to</strong></div>
                        <div class="mb-2"><?=get_field('reports_to')?></div>
                        <?php
                    }
                    ?>
                    <a href="mailto:careers@peoplesafe.co.uk?subject=<?=get_the_title()?>" class="mt-3 btn btn-primary">Apply today</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
/*
<script type="application/ld+json">
    {
      "@context" : "https://schema.org/",
      "@type" : "JobPosting",
      "title" : "<?php echo get_the_title(); ?>",
      "description" : "<p><?php echo get_the_title(); ?></p>",
      "hiringOrganization": {
        "@type": "Organization",
        "name": "Carousel",
        "logo": "https://www.carousel.eu/wp-content/themes/cb-carousel/img/carousel-logo-square.png",
        "sameAs": "https://www.carousel.eu/"
      },
      "datePosted" : "<?php echo get_the_date(); ?>",
      "validThrough" : "2030-01-01T00:00",
      "employmentType" : "<?php echo get_field('employment_type'); ?>",
      "jobLocation": {
        "@type": "Place",
          <?php
        $loca = get_field('office');
        $loca = $loca[0];
        $loca = get_term_by('id', $loca, 'locations');
        echo $loca->description;
        ?>
      }
      "baseSalary": {
        "@type": "MonetaryAmount",
        "currency": "GBP",
        "value": {
          "@type": "QuantitativeValue",
          "value": 40.00,
          "unitText": "HOUR"
        }
      }
      ?>
    }
    </script>

<?php 
*/
} ?>
    <!-- main content column -->

    <?php
$cta = get_field('cta');
?>
<!-- gradient_cta -->
<section class="gradient_cta py-5 bg_grad--orange">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <h2>An industry leading UK-based technology business</h2>
                <div class="mb-4">
                    <p>Peoplesafe is an industry leading UK-based technology business centred around the safety of lone and at-risk workers across both public and private sectors.</p>
                    <p>Protecting over 150,000 employees, our customer base includes more than 100 NHS trusts, 150 local authorities, 200 housing associations and hundreds of commercial organisations in sectors including utilities, facilities management, distribution and care.</p>
                </div>
                <a href="/about/" class="btn">Learn more about Peoplesafe</a>    
            </div>
        </div>
    </div>
</section>


</main>
<?php

get_footer();


