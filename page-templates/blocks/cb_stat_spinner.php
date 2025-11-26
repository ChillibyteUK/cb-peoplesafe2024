<?php
$class = $block['className'] ?? 'pt-5';
$img = get_field('image') ?: get_stylesheet_directory_uri() . '/img/2024/cutouts/cutout4.png';
$title = get_field('title') ?: 'Protection you can count on';
?>
<section class="stat_spinner <?=$class?>" data-aos="fade">
    <div class="container-xl">
        <div class="row g-5">
            <div class="col-md-4 order-2 order-md-1">
                <img src="<?=$img?>"
                    alt="">
            </div>
            <div class="col-md-8 order-1 order-md-2">
                <h3><?=$title?></h3>
                <div class="stats">
                    <?php
                    while (have_rows('spinner_stats')) {
                        the_row();
                        $endval = get_sub_field('stat');
                        $endval = preg_replace('/,/', '.', $endval);
                        $decimals = strlen(substr(strrchr($endval, "."), 1));
                        $prefix = get_sub_field('prefix') ?? null;
                        $suffix = get_sub_field('suffix') ?? null;
                        ?>
                    <div class="stat__stat">
                        <div class="stat__value text-orange">
                            <?=$prefix?><div class="counter" data-count="<?=$endval?>">0</div><?=$suffix?>
                        </div>
                        <div class="stat__qualifier">
                            <?=get_sub_field('title')?>
                        </div>
                        <div class="stat__title">
                            <?=get_sub_field('description')?>
                        </div>
                    </div>
                    <?php
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?= esc_url( get_stylesheet_directory_uri() . '/js/countUp.min.js' ); ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.counter').forEach(function(counter) {
        const countTo = parseFloat(counter.getAttribute('data-count'));
        const countUp = new CountUp(counter, countTo, {
            duration: 4,
            useEasing: false
        });
        countUp.start();
    });
});
</script>