<?php
$i = 'x' . random_str(4);
$tab1Link = get_field('tab_1_link') ?? null;
$tab2Link = get_field('tab_2_link') ?? null;
$tab3Link = get_field('tab_3_link') ?? null;
$titleClass = get_field('title_class') == 'H1' ? 'h1' : '';

$d = 0;
?>
<section class="side_tab_group_2024 py-5">
    <div class="container-xl">
        <?php
        if (get_field('title') ?? null) {
            ?>
        <h2 class="<?=$titleClass?> mb-4 text-center" data-aos="fade"><?=get_field('title')?></h2>
            <?php
            $d+=200;
        }
        if (get_field('intro') ?? null) {
            ?>
        <div class="text-center mb-5" data-aos="fade" data-aos-delay="<?=$d?>"><?=get_field('intro')?></div>
            <?php
            $d+=200;
        }
        ?>
        <div class="side_tab_group_2024__inner">
            <div class="contents" data-aos="fade" data-aos-delay="<?=$d?>">
                <?=wp_get_attachment_image(get_field('tab_1_image'),'large',false,array('class' => 'content active', 'alt' => '', 'id' => $i . '_tab1'))?>
                <?=wp_get_attachment_image(get_field('tab_2_image'),'large',false,array('class' => 'content', 'alt' => '', 'id' => $i . '_tab2'))?>
                <?=wp_get_attachment_image(get_field('tab_3_image'),'large',false,array('class' => 'content', 'alt' => '', 'id' => $i . '_tab3'))?>
            </div>
            <div class="pills">
                <?php
                $d += 200;
                ?>
                <div class="pill active" aria-controls="<?=$i?>_tab1" data-aos="fade" data-aos-delay="<?=$d?>">
                    <h3 class="pill__title"><?=get_field('tab_1_title')?></h3>
                    <div class="pill__content">
                        <p><?=get_field('tab_1_content')?><p>
                        <?php
                        if (!empty($tab1Link)) {
                            ?>
                        <a href="<?=$tab1Link['url']?>" class="button button-outline--white"><?=$tab1Link['title']?></a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                $d += 200;
                ?>
                <div class="pill" aria-controls="<?=$i?>_tab2" data-aos="fade" data-aos-delay="<?=$d?>">
                    <h3 class="pill__title"><?=get_field('tab_2_title')?></h3>
                    <div class="pill__content">
                        <p><?=get_field('tab_2_content')?><p>
                        <?php
                        if (!empty($tab2Link)) {
                            ?>
                        <a href="<?=$tab2Link['url']?>" class="button button-outline--white"><?=$tab2Link['title']?></a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                $d += 200;
                ?>
                <div class="pill" aria-controls="<?=$i?>_tab3" data-aos="fade" data-aos-delay="<?=$d?>"> 
                    <h3 class="pill__title"><?=get_field('tab_3_title')?></h3>
                    <div class="pill__content">
                        <p><?=get_field('tab_3_content')?><p>
                        <?php
                        if (!empty($tab3Link)) {
                            ?>
                        <a href="<?=$tab3Link['url']?>" class="button button-outline--white"><?=$tab3Link['title']?></a>
                            <?php
                        }
                        ?>
                    </div>
                </div>

            
            </div>

        </div>
    </div>
</section>