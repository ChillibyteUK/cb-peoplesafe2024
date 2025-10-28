<?php
/*
Template Name: Service Status
*/

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
the_post();

?>
<style>
.status { width: 20px; height: 20px; border-radius: 100%; }
.status--green { background-color: green; }
.status--amber { background-color: orange; }
.status--red { background-color: red; }
</style>
<main id="main" class="pt-5">
    <div class="container py-5" id="knowledge">
        <div class="page-meta">
            <h1>Service Status</h1>
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>
        <?php
        if (get_field('message')) {
            ?>
        <div class="pb-4">
            <?=get_field('message')?>
        </div>
            <?php
        }

        $s = get_field('status');
        $state = $s['arc'] + $s['css'] + $s['al'] + $s['psp'] + $s['ma'] + $s['dev'];

        // echo "STATE: " . $state;
        $message = 'Partly degraded';
        $colour = 'yellow';

        if ($state == 6) { 
            $message = 'Fully operational';
            $colour = 'green';
        }
        if ($state == 0) {
            $message = 'Down';
            $colour = 'red';
        }

        function statusDot($s) {
            if ($s == 1) {
                return 'green';
            }
            if ($s == 0) {
                return 'red';
            }
            return 'amber';
        }

        function statusText($s) {
            if ($s == 1) {
                return 'Operational';
            }
            if ($s == 0) {
                return 'Down';
            }
            return 'Degraded';
        }
        ?>
        <div class="p-4 mb-4 h2 bg--<?=$colour?>"><?=$message?></div>
        <div class="row">
            <div class="col-md-6">
                <div class="h3">Services</div>
                <div class="row pb-2">
                    <div class="col-1 text-center"><?php
                        $c = statusDot($s['arc']);
                        $m = statusText($s['arc']);
                    ?><div class="status status--<?=$c?>"></div></div>
                    <div class="col-6"><strong>ARC Services</strong></div>
                    <div class="col-5"><?=$m?></div>
                </div>
                <div class="row pb-2">
                    <div class="col-1 text-center"><?php
                        $c = statusDot($s['css']);
                        $m = statusText($s['css']);
                    ?><div class="status status--<?=$c?>"></div></div>
                    <div class="col-6"><strong>Customer Support Services</strong></div>
                    <div class="col-5"><?=$m?></div>
                </div>
                <div class="row pb-2">
                    <div class="col-1 text-center"><?php
                        $c = statusDot($s['al']);
                        $m = statusText($s['al']);
                    ?><div class="status status--<?=$c?>"></div></div>
                    <div class="col-6"><strong>Activity Lines</strong></div>
                    <div class="col-5"><?=$m?></div>
                </div>
                <div class="row pb-2">
                    <div class="col-1 text-center"><?php
                        $c = statusDot($s['psp']);
                        $m = statusText($s['psp']);
                    ?><div class="status status--<?=$c?>"></div></div>
                    <div class="col-6"><strong>Peoplesafe Portal</strong></div>
                    <div class="col-5"><?=$m?></div>
                </div>
                <div class="row pb-2">
                    <div class="col-1 text-center"><?php
                        $c = statusDot($s['ma']);
                        $m = statusText($s['ma']);
                    ?><div class="status status--<?=$c?>"></div></div>
                    <div class="col-6"><strong>Mobile Apps</strong></div>
                    <div class="col-5"><?=$m?></div>
                </div>
                <div class="row pb-2">
                    <div class="col-1 text-center"><?php
                        $c = statusDot($s['dev']);
                        $m = statusText($s['dev']);
                    ?><div class="status status--<?=$c?>"></div></div>
                    <div class="col-6"><strong>Devices</strong></div>
                    <div class="col-5"><?=$m?></div>
                </div>




<?php
/**
 * Status timeline (ACF repeater: status_history)
 * - status_title        (text)
 * - status_description  (text)
 * - status_time         (date time)
 */
$rows = get_field('status_history');

if ($rows && is_array($rows)) {
?>
<section class="my-4 row">
    <div class="h3">Updates</div>
    <?php foreach ($rows as $i => $r):
      $title   = trim($r['status_title'] ?? '') ?: 'Update';
      $desc    = trim($r['status_description'] ?? '');
      $raw     = $r['status_time'] ?? '';
    ?>
    <div class="row">
        <div class="col-12 col-lg-3">
            <span class="badge rounded-pill bg-primary mb-2"><?php echo esc_html($title); ?></span>
        </div>
        <div class="col-12 col-lg-9">
            <div class="status-tl__time text-muted small"><?php echo esc_html($raw); ?></div>
          <?php if ($desc): ?>
            <div class="status-tl__text">
              <?php echo wp_kses_post(wpautop($desc)); ?>
            </div>
          <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</section>
<?php } ?>





			</div>
            <div class="col-md-6 bg--grey p-4">
                <h2 class="h3">Report a service problem</h2>
                <?=get_field('form_code')?>
            </div>
        </div>
    </div>
</main>
<?php

get_footer();