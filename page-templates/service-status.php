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

  // Newest first (so the latest entry is at the top)
  usort($rows, function ($a, $b) {
    $ta = !empty($a['status_time']) ? strtotime($a['status_time']) : 0;
    $tb = !empty($b['status_time']) ? strtotime($b['status_time']) : 0;
    return $tb <=> $ta;
  });

  // simple slug for optional colour hooks
  $slugify = static function ($s) {
    $s = strtolower(trim((string)$s));
    $s = preg_replace('~[^a-z0-9]+~', '-', $s);
    return trim($s, '-') ?: 'update';
  };
?>
<style>
/* ===== Clean vertical timeline (Bootstrap 5) ===== */
.status-tl{
  /* left column width and rail x-position */
  --left-col: 220px;
  --rail-x:   110px;           /* center of the rail within the section */
  --rail-w:   2px;

  position: relative;
  padding-left: var(--left-col);
}

/* continuous rail within the timeline */
.status-tl::before{
  content:"";
  position:absolute;
  left: var(--rail-x);
  top: 0.5rem;
  bottom: 0.5rem;
  width: var(--rail-w);
  background: var(--bs-border-color);
  border-radius: var(--rail-w);
}

.status-tl__item{
  display: grid;
  grid-template-columns: var(--left-col) 1fr;  /* left pill + right content */
  column-gap: 24px;
  margin: 18px 0 26px;
  position: relative;
}

/* left column holds the dot and the pill, without stretching */
.status-tl__left{
  position: relative;
  min-height: 1px; /* don't force any height */
}

/* the small dot on the rail */
.status-tl__dot{
  position: absolute;
  left: var(--rail-x);
  top: 8px;                      /* aligns with the pill */
  transform: translateX(-50%);
  width: 12px; height: 12px;
  background: #fff;
  border-radius: 50%;
  border: 2px solid rgba(0,0,0,.15);
  z-index: 2;
}

/* status pill (compact, not stretched) */
.status-tl__pill{
  display: inline-block;
  padding: .4rem .95rem;
  border: 1px solid var(--bs-border-color);
  border-radius: 999px;
  background: #fff;
  color: var(--bs-body-color);
  font-weight: 500;

  /* place the pill just to the right of the rail */
  position: relative;
  left: calc(var(--rail-x) - 60px); /* tweak 40–70px to taste */
  box-shadow: 0 0 0 6px #fff;       /* cut the rail visually behind */
}

/* right side: timestamp then text */
.status-tl__time{
  font-size: .95rem;
  color: var(--bs-secondary-color);
  margin-bottom: .25rem;
}
.status-tl__text{
  line-height: 1.6;
}

/* highlight the latest entry */
.status-tl__item.is-latest .status-tl__pill{
  background: var(--bs-dark);
  color: #fff;
  border-color: var(--bs-dark);
}
.status-tl__item.is-latest .status-tl__dot{
  background: var(--bs-dark);
  border-color: var(--bs-dark);
}

/* Optional colour hooks by status text (Resolved/Update/etc.) */
.status-tl__item.status-resolved   .status-tl__pill{ background: rgba(var(--bs-success-rgb),.12); color: var(--bs-success); border-color: rgba(var(--bs-success-rgb),.35);}
.status-tl__item.status-monitoring .status-tl__pill{ background: rgba(var(--bs-secondary-rgb),.12); color: var(--bs-secondary); border-color: rgba(var(--bs-secondary-rgb),.35);}
.status-tl__item.status-identified .status-tl__pill{ background: rgba(var(--bs-info-rgb),.12); color: var(--bs-info); border-color: rgba(var(--bs-info-rgb),.35);}
.status-tl__item.status-update     .status-tl__pill{ background: rgba(var(--bs-primary-rgb),.12); color: var(--bs-primary); border-color: rgba(var(--bs-primary-rgb),.35);}
.status-tl__item.status-investigating .status-tl__pill{ background: rgba(var(--bs-warning-rgb),.12); color: var(--bs-warning); border-color: rgba(var(--bs-warning-rgb),.35);}

/* responsive: bring the pill closer on small screens */
@media (max-width: 768px){
  .status-tl{ --left-col: 190px; --rail-x: 95px; }
}
</style>
<section class="status-tl my-4">
  <ul class="status-tl__list list-unstyled m-0">
    <?php foreach ($rows as $i => $r):
      $title   = trim($r['status_title'] ?? '') ?: 'Update';
      $desc    = trim($r['status_description'] ?? '');
      $raw     = $r['status_time'] ?? '';
      $ts      = $raw ? strtotime($raw) : 0;
      $display = $ts ? date_i18n('d m Y \a\t g:i A', $ts) : '';  // <<< TIMESTAMP VISIBLE
      $iso     = $ts ? gmdate('c', $ts) : '';
      $cls     = 'status-tl__item status-' . $slugify($title) . ($i === 0 ? ' is-latest' : '');
    ?>
      <li class="<?php echo esc_attr($cls); ?>">
        <div class="status-tl__left">
          <span class="status-tl__dot" aria-hidden="true"></span>
          <span class="status-tl__pill"><?php echo esc_html($title); ?></span>
        </div>

        <div class="status-tl__right">
          <?php if ($display): ?>
            <div class="status-tl__time">
              <time datetime="<?php echo esc_attr($iso); ?>">
                <?php echo esc_html($display); ?>
              </time>
            </div>
          <?php endif; ?>

          <?php if ($desc): ?>
            <div class="status-tl__text">
              <?php echo wp_kses_post(wpautop($desc)); ?>
            </div>
          <?php endif; ?>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
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