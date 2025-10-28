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
 * - status_title (text)
 * - status_description (text)
 * - status_time (date time)
 */

$rows = get_field('status_history');
?>

  <?php if (!empty($rows) && is_array($rows)) : ?>
<section class="status-timeline-wrap mt-4">
  <div class="status-timeline__heading h3">Updates</div>

<style>
/* ===== Timeline base ===== */
.status-timeline-wrap {
  --tl-rail-w: 2px;
  --tl-dot: 12px;
  --tl-gap: 1rem;
}

.status-timeline {
  position: relative;
  margin-left: calc(var(--tl-dot) + .5rem);
  padding-left: 1rem;
}

/* Vertical rail */
.status-timeline::before {
  content: "";
  position: absolute;
  left: calc(-1rem - var(--tl-dot) / 2 + var(--tl-rail-w) / 2);
  top: 0.25rem;
  bottom: 0.25rem;
  width: var(--tl-rail-w);
  background: var(--bs-border-color);
  border-radius: var(--tl-rail-w);
}

/* Individual items */
.status-timeline__item {
  position: relative;
  padding: .25rem 0 .75rem 0;
  margin-bottom: var(--tl-gap);
}

/* Dot (left) */
.status-timeline__item::before {
  content: "";
  position: absolute;
  left: calc(-1rem - var(--tl-dot) / 2);
  top: .6rem;            /* tweak if your header font size differs */
  width: var(--tl-dot);
  height: var(--tl-dot);
  border-radius: 50%;
  border: 2px solid var(--bs-border-color);
  background: var(--bs-body-bg);
  box-shadow: 0 0 0 2px var(--bs-body-bg); /* “cut” the rail behind */
}

/* Active (latest) item accent */
.status-timeline__item.is-active::before {
  background: var(--bs-success);
  border-color: var(--bs-success);
}
.status-timeline__item.is-active .status-timeline__badge {
  background: rgba(var(--bs-success-rgb), .1);
  color: var(--bs-success);
  border-color: rgba(var(--bs-success-rgb), .25);
}

/* Header layout */
.status-timeline__header {
  display: flex;
  align-items: center;
  gap: .5rem;
  flex-wrap: wrap;
}

/* Badge (status label) */
.status-timeline__badge {
  display: inline-block;
  padding: .15rem .5rem;
  border: 1px solid var(--bs-border-color);
  border-radius: 2rem;
  font-size: .875rem;
  line-height: 1.25rem;
  background: var(--bs-body-bg);
  color: var(--bs-body-color);
}

/* Time */
.status-timeline__time {
  margin-left: auto;
  font-size: .875rem;
  color: var(--bs-secondary-color);
}

/* Body text */
.status-timeline__body {
  margin-top: .5rem;
  color: var(--bs-body-color);
}

/* ===== Optional: colour mapping by status (add a class in PHP) ===== */
/* We’ll add .status--resolved / .status--investigating / etc. to the <article> */

.status-timeline__item.status--resolved::before {
  background: var(--bs-success);
  border-color: var(--bs-success);
}
.status-timeline__item.status--investigating::before {
  background: var(--bs-warning);
  border-color: var(--bs-warning);
}
.status-timeline__item.status--identified::before {
  background: var(--bs-info);
  border-color: var(--bs-info);
}
.status-timeline__item.status--monitoring::before {
  background: var(--bs-secondary);
  border-color: var(--bs-secondary);
}
.status-timeline__item.status--update::before {
  background: var(--bs-primary);
  border-color: var(--bs-primary);
}

/* Match the badge to the dot colour (light pill w/ coloured text) */
.status-timeline__item.status--resolved .status-timeline__badge {
  background: rgba(var(--bs-success-rgb), .1);
  color: var(--bs-success);
  border-color: rgba(var(--bs-success-rgb), .25);
}
.status-timeline__item.status--investigating .status-timeline__badge {
  background: rgba(var(--bs-warning-rgb), .1);
  color: var(--bs-warning);
  border-color: rgba(var(--bs-warning-rgb), .25);
}
.status-timeline__item.status--identified .status-timeline__badge {
  background: rgba(var(--bs-info-rgb), .1);
  color: var(--bs-info);
  border-color: rgba(var(--bs-info-rgb), .25);
}
.status-timeline__item.status--monitoring .status-timeline__badge {
  background: rgba(var(--bs-secondary-rgb), .1);
  color: var(--bs-secondary);
  border-color: rgba(var(--bs-secondary-rgb), .25);
}
.status-timeline__item.status--update .status-timeline__badge {
  background: rgba(var(--bs-primary-rgb), .1);
  color: var(--bs-primary);
  border-color: rgba(var(--bs-primary-rgb), .25);
}
</style>
    <?php
    // newest first
    usort($rows, function ($a, $b) {
        $ta = isset($a['status_time']) ? strtotime($a['status_time']) : 0;
        $tb = isset($b['status_time']) ? strtotime($b['status_time']) : 0;
        return $tb <=> $ta;
    });
    ?>

    <div class="status-timeline">
      <?php foreach ($rows as $i => $r) :
        $title = isset($r['status_title']) ? trim($r['status_title']) : '';
        $desc  = isset($r['status_description']) ? trim($r['status_description']) : '';
        $raw   = isset($r['status_time']) ? $r['status_time'] : '';
        $ts    = $raw ? strtotime($raw) : 0;

        $display = $ts ? date_i18n('d m Y \a\t g:i A', $ts) : '';
        $iso     = $ts ? gmdate('c', $ts) : '';
      ?>
        <article class="status-timeline__item<?php echo $i === 0 ? ' is-active' : ''; ?>">
          <span class="status-timeline__dot" aria-hidden="true"></span>
          <span class="status-timeline__line" aria-hidden="true"></span>

          <header class="status-timeline__header">
            <?php if ($title !== '') : ?>
              <span class="status-timeline__badge"><?php echo esc_html($title); ?></span>
            <?php endif; ?>
            <?php if ($display !== '') : ?>
              <time class="status-timeline__time" datetime="<?php echo esc_attr($iso); ?>">
                <?php echo esc_html($display); ?>
              </time>
            <?php endif; ?>
          </header>

          <?php if ($desc !== '') : ?>
            <div class="status-timeline__body">
              <?php echo wp_kses_post(wpautop($desc)); ?>
            </div>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    </div>
</section>

  <?php endif; ?>
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