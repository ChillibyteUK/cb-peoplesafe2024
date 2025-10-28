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
 * Status timeline (ACF repeater `status_history`)
 *  - status_title (text)
 *  - status_description (text)
 *  - status_time (date time)
 */
$rows = get_field('status_history');
if ($rows && is_array($rows)) {

  // Newest first
  usort($rows, function($a,$b){
    $ta = !empty($a['status_time']) ? strtotime($a['status_time']) : 0;
    $tb = !empty($b['status_time']) ? strtotime($b['status_time']) : 0;
    return $tb <=> $ta;
  });

  // helper: make a class from the title (Resolved → resolved, etc.)
  $slug = static function($s){
    $s = strtolower(trim((string)$s));
    $s = preg_replace('~[^a-z0-9]+~','-',$s);
    return trim($s,'-') ?: 'update';
  };
?>
<style>
/* ===== Timeline (Bootstrap 5 friendly) ===== */
.tl{
  --tl-left: 230px;           /* width of left column (pill side) */
  --tl-rail: 2px;             /* rail thickness */
  --tl-rail-color: var(--bs-border-color);
  position: relative;
  padding-left: var(--tl-left);
}

/* continuous rail inside the timeline only */
.tl::before{
  content:"";
  position:absolute;
  left: calc(var(--tl-left) / 2);
  top: .75rem;                  /* start a little below the first pill */
  bottom: .75rem;
  width: var(--tl-rail);
  background: var(--tl-rail-color);
  border-radius: var(--tl-rail);
}

/* each entry uses a 2-col grid: pill (left) + content (right) */
.tl-item{
  display: grid;
  grid-template-columns: var(--tl-left) 1fr;
  column-gap: 24px;
  padding: 10px 0 28px;
}

/* left column: centres the pill over the rail */
.tl-left{
  position: relative;
  display: flex;
  justify-content: center;
}

/* pill */
.tl-pill{
  display:inline-block;
  padding: .5rem 1.25rem;
  border: 1px solid var(--bs-border-color);
  border-radius: 999px;
  background: #fff;
  color: var(--bs-body-color);
  font-weight: 500;
  box-shadow: 0 0 0 6px #fff;     /* “punch” the rail behind the pill */
}

/* right column */
.tl-time{
  font-size: .95rem;
  color: var(--bs-secondary-color);
  margin-bottom: .35rem;
}
.tl-body{
  color: var(--bs-body-color);
  line-height: 1.55;
}

/* highlight the latest entry */
.tl-item.is-active .tl-pill{
  background: var(--bs-dark);
  color: #fff;
  border-color: var(--bs-dark);
}

/* optional colour mapping by status */
.tl-item.status-resolved   .tl-pill{ background: rgba(var(--bs-success-rgb),.12); color: var(--bs-success); border-color: rgba(var(--bs-success-rgb),.35); }
.tl-item.status-monitoring .tl-pill{ background: rgba(var(--bs-secondary-rgb),.12); color: var(--bs-secondary); border-color: rgba(var(--bs-secondary-rgb),.35); }
.tl-item.status-identified .tl-pill{ background: rgba(var(--bs-info-rgb),.12); color: var(--bs-info); border-color: rgba(var(--bs-info-rgb),.35); }
.tl-item.status-update     .tl-pill{ background: rgba(var(--bs-primary-rgb),.12); color: var(--bs-primary); border-color: rgba(var(--bs-primary-rgb),.35); }
.tl-item.status-investigating .tl-pill{ background: rgba(var(--bs-warning-rgb),.12); color: var(--bs-warning); border-color: rgba(var(--bs-warning-rgb),.35); }

/* responsive: tighten the left column on small screens */
@media (max-width: 768px){
  .tl{ --tl-left: 180px; }
}
</style>
<section class="tl my-4">
  <?php foreach ($rows as $i => $r):
    $title   = trim($r['status_title'] ?? '') ?: 'Update';
    $desc    = trim($r['status_description'] ?? '');
    $raw     = $r['status_time'] ?? '';
    $ts      = $raw ? strtotime($raw) : 0;
    $display = $ts ? date_i18n('d m Y \a\t g:i A', $ts) : '';
    $iso     = $ts ? gmdate('c', $ts) : '';
    $cls     = 'tl-item status-'.$slug($title).($i === 0 ? ' is-active' : '');
  ?>
    <article class="<?php echo esc_attr($cls); ?>">
      <div class="tl-left">
        <span class="tl-pill"><?php echo esc_html($title); ?></span>
      </div>

      <div class="tl-right">
        <?php if ($display): ?>
          <div class="tl-time">
            <time datetime="<?php echo esc_attr($iso); ?>"><?php echo esc_html($display); ?></time>
          </div>
        <?php endif; ?>

        <?php if ($desc): ?>
          <div class="tl-body">
            <?php echo wp_kses_post(wpautop($desc)); ?>
          </div>
        <?php endif; ?>
      </div>
    </article>
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