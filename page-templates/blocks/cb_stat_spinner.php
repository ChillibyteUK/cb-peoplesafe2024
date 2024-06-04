<?php
$class = $block['className'] ?? 'pt-5';
?>
<section class="stat_spinner <?=$class?>">
    <div class="container-xl">
        <div class="row g-5">
            <div class="col-md-4 order-2 order-md-1">
                <img src="<?=get_stylesheet_directory_uri()?>/img/2024/cutouts/cutout4.png"
                    alt="">
            </div>
            <div class="col-md-8 order-1 order-md-2">
                <h3>Protection you can count on</h3>
                <div class="stats">
                    <?php
                    while (have_rows('spinner_stats')) {
                        the_row();
                        $endval = get_sub_field('stat');
                        $endval = preg_replace('/,/', '.', $endval);
                        $decimals = strlen(substr(strrchr($endval, "."), 1));
                        $suffix = get_sub_field('suffix');
                        ?>
                    <div class="stat__stat">
                        <div class="stat__value text-orange">
                            <?=do_shortcode("[countup start='0' end='{$endval}' decimals='{$decimals}' duration='3' scroll='true']")?><?=$suffix?>
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