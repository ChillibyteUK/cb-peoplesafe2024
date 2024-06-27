<?php
$i = random_str(4);
$tab1Link = get_field('tab_1_link') ?? null;
$tab2Link = get_field('tab_2_link') ?? null;
$tab3Link = get_field('tab_3_link') ?? null;
?>
<section class="side_tab_group_2024 py-5">
    <div class="container-xl">
        <h2 class="h1 text-center"><?=get_field('title')?></h2>
        <div class="text-center mb-5"><?=get_field('intro')?></div>
        <div class="side_tab_group_2024__inner">
            <div class="contents">
                <img class="content active" id="<?=$i?>_tab1" src="<?=get_stylesheet_directory_uri()?>/img/2024/lone.jpg">
                <img class="content" id="<?=$i?>_tab2" src="<?=get_stylesheet_directory_uri()?>/img/2024/all-employees.jpg">
                <img class="content" id="<?=$i?>_tab3" src="<?=get_stylesheet_directory_uri()?>/img/2024/home-hybrid.jpg">
            </div>
            <div class="pills">

                <div class="pill active" aria-controls="<?=$i?>_tab1">
                    <h3 class="pill__title"><?=get_field('tab_1_title')?></h3>
                    <div class="pill__content">
                        <p><?=get_field('tab_1_content')?><p>
                        <a href="<?=$tab1Link['url']?>" class="button button-outline--white"><?=$tab1Link['title']?></a>
                    </div>
                </div>

                <div class="pill" aria-controls="<?=$i?>_tab2">
                    <h3 class="pill__title"><?=get_field('tab_2_title')?></h3>
                    <div class="pill__content">
                        <p><?=get_field('tab_2_content')?><p>
                        <a href="<?=$tab2Link['url']?>" class="button button-outline--white"><?=$tab2Link['title']?></a>
                    </div>
                </div>

                <div class="pill" aria-controls="<?=$i?>_tab3"> 
                    <h3 class="pill__title"><?=get_field('tab_3_title')?></h3>
                    <div class="pill__content">
                        <p><?=get_field('tab_3_content')?><p>
                        <a href="<?=$tab3Link['url']?>" class="button button-outline--white"><?=$tab3Link['title']?></a>
                    </div>
                </div>

            
            </div>

        </div>
    </div>
</section>