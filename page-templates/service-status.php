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
/* ===== Rail layout (grid) ===== */
.status-timeline {                /* wraps all items */
  position: relative;
  padding-left: 200px;            /* width of the left column */
  z-index: 0;
}

/* vertical rail */
.status-timeline::before {
  content: "";
  position: absolute;
  left: 100px;                    /* center of the left column */
  top: 0;
  bottom: 0;
  width: 2px;
  background: rgba(var(--bs-secondary-rgb,108,117,125), .25);
}

/* each entry */
.status-timeline__item {
  display: grid;
  grid-template-columns: 200px 1fr; /* left column + right content */
  column-gap: 24px;
  padding: 12px 0 24px;
  position: relative;
}

/* left column sits over the rail */
.status-timeline__left { position: relative; min-height: 56px; }

/* dot on the rail */
.status-timeline__dot {
  position: absolute;
  left: 100px;
  top: 12px;
  transform: translateX(-50%);
  width: 16px;
  height: 16px;
  border-radius: 50%;
  background: #fff;
  border: 3px solid rgba(var(--bs-secondary-rgb,108,117,125), .35);
  z-index: 1;
}

/* pill (status label) */
.status-timeline__badge {
  display: inline-block;
  padding: .35rem .85rem;
  border: 1px solid rgba(var(--bs-secondary-rgb,108,117,125), .25);
  border-radius: 999px;
  background: #fff;
  color: var(--bs-body-color);
  font-weight: 500;
  position: relative;
  top: -2px;
  margin-left: 44px;              /* offset from the rail */
}

/* right column */
.status-timeline__right { padding-top: 2px; }
.status-timeline__meta time {
  display: block;
  font-size: .95rem;
  color: var(--bs-secondary-color, #6c757d);
  margin-bottom: .25rem;
}
.status-timeline__body { line-height: 1.6; }

/* latest item emphasis */
.status-timeline__item.is-active .status-timeline__badge {
  background: var(--bs-dark);
  color: #fff;
  border-color: var(--bs-dark);
}
.status-timeline__item.is-active .status-timeline__dot {
  background: var(--bs-dark);
  border-color: var(--bs-dark);
}

/* optional status colours (if you add status--resolved etc.) */
.status--resolved .status-timeline__dot,
.status--resolved .status-timeline__badge { border-color: var(--bs-success); }
.status--resolved .status-timeline__badge { background: rgba(var(--bs-success-rgb), .1); color: var(--bs-success); }

.status--investigating .status-timeline__dot,
.status--investigating .status-timeline__badge { border-color: var(--bs-warning); }
.status--investigating .status-timeline__badge { background: rgba(var(--bs-warning-rgb), .1); color: var(--bs-warning); }

.status--identified .status-timeline__dot,
.status--identified .status-timeline__badge { border-color: var(--bs-info); }
.status--identified .status-timeline__badge { background: rgba(var(--bs-info-rgb), .1); color: var(--bs-info); }

.status--monitoring .status-timeline__dot,
.status--monitoring .status-timeline__badge { border-color: var(--bs-secondary); }
.status--monitoring .status-timeline__badge { background: rgba(var(--bs-secondary-rgb), .1); color: var(--bs-secondary); }

.status--update .status-timeline__dot,
.status--update .status-timeline__badge { border-color: var(--bs-primary); }
.status--update .status-timeline__badge { background: rgba(var(--bs-primary-rgb), .1); color: var(--bs-primary); }

/* ========= TIMELINE (variable based) ========= */
.status-timeline {
  /* Tune these two to fit your page column */
  --col-left: 160px;                 /* width of the left column (rail + pill)  */
  --rail-x: calc(var(--col-left)/2); /* rail center relative to the timeline box */

  position: relative;
  padding-left: var(--col-left);
  z-index: 0;                        /* create a stacking context */
}

/* vertical rail */
.status-timeline::before {
  content: "";
  position: absolute;
  left: var(--rail-x);
  top: 0;
  bottom: 0;
  width: 2px;
  background: rgba(var(--bs-secondary-rgb,108,117,125), .25);
  z-index: 0;                        /* keep it behind everything */
}

/* each entry */
.status-timeline__item {
  display: grid;
  grid-template-columns: var(--col-left) 1fr;
  column-gap: 24px;
  padding: 12px 0 24px;
  position: relative;
}

.status-timeline__left {
  position: relative;
  min-height: 56px;
  z-index: 2;                        /* make sure it’s above the rail */
}

/* rail dot */
.status-timeline__dot {
  position: absolute;
  left: var(--rail-x);
  top: 12px;
  transform: translateX(-50%);
  width: 16px;
  height: 16px;
  border-radius: 50%;
  background: #fff;
  border: 3px solid rgba(var(--bs-secondary-rgb,108,117,125), .35);
  z-index: 2;
}

/* status pill */
.status-timeline__badge {
  display: inline-block;
  padding: .35rem .85rem;
  border: 1px solid rgba(var(--bs-secondary-rgb,108,117,125), .25);
  border-radius: 999px;
  background: #fff;
  color: var(--bs-body-color);
  font-weight: 500;
  position: relative;
  top: -2px;
  margin-left: 36px;                 /* gap from the rail */
  white-space: nowrap;               /* keep pill on one line */
  z-index: 2;                        /* above the rail */
}

/* right side */
.status-timeline__right { padding-top: 2px; }
.status-timeline__meta time {
  display: block;
  font-size: .95rem;
  color: var(--bs-secondary-color, #6c757d);
  margin-bottom: .25rem;
}
.status-timeline__body { line-height: 1.6; }

/* latest item emphasis */
.status-timeline__item.is-active .status-timeline__badge {
  background: var(--bs-dark);
  color: #fff;
  border-color: var(--bs-dark);
}
.status-timeline__item.is-active .status-timeline__dot {
  background: var(--bs-dark);
  border-color: var(--bs-dark);
}

/* optional: status colours (if you add status--resolved etc.) */
.status--resolved .status-timeline__dot,
.status--resolved .status-timeline__badge { border-color: var(--bs-success); }
.status--resolved .status-timeline__badge { background: rgba(var(--bs-success-rgb), .1); color: var(--bs-success); }

/* responsive */
@media (max-width: 768px) {
  .status-timeline {
    --col-left: 44px;
    --rail-x: 22px;
  }
  .status-timeline__item { grid-template-columns: 1fr; }
  .status-timeline__badge { margin-left: 28px; }
}

/* ===== Responsive (stack on mobile) ===== */
@media (max-width: 768px) {
  .status-timeline { padding-left: 42px; }
  .status-timeline::before { left: 21px; }
  .status-timeline__item { grid-template-columns: 1fr; }
  .status-timeline__dot { left: 21px; }
  .status-timeline__badge { margin-left: 32px; }
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
          <div class="status-timeline__left">
            <span class="status-timeline__dot" aria-hidden="true"></span>
            <span class="status-timeline__badge">
              <?php echo esc_html($title); ?>
            </span>
          </div>

          <div class="status-timeline__right">
            <?php if ($display !== ''): ?>
              <div class="status-timeline__meta">
                <time datetime="<?php echo esc_attr($iso); ?>">
                  <?php echo esc_html($display); ?>
                </time>
              </div>
            <?php endif; ?>

            <?php if ($desc !== ''): ?>
              <div class="status-timeline__body">
                <?php echo wp_kses_post(wpautop($desc)); ?>
              </div>
            <?php endif; ?>
          </div>
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