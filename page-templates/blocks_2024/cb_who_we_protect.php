<?php
$loneLink = get_field('lone_workers_link');
$allLink = get_field('all_employees_link');
$hybridLink = get_field('hybrid_workers_link');
?>
<section class="who_we_protect py-5">
    <div class="container-xl">
        <h2 class="h1 text-center"><?=get_field('title')?></h2>
        <div class="text-center mb-5"><?=get_field('intro')?></div>
        <div class="who_we_protect__inner">
            <div class="contents">
                <img class="content active" id="lone" src="<?=get_stylesheet_directory_uri()?>/img/2024/lone.jpg">
                <img class="content" id="all" src="<?=get_stylesheet_directory_uri()?>/img/2024/all-employees.jpg">
                <img class="content" id="home" src="<?=get_stylesheet_directory_uri()?>/img/2024/home-hybrid.jpg">
            </div>
            <div class="pills">

                <div class="pill active" aria-controls="lone">
                    <h3 class="pill__title">Lone Workers</h3>
                    <div class="pill__content">
                        <p><?=get_field('lone_workers_content')?><p>
                        <a href="<?=$loneLink['url']?>" class="button button-outline--white"><?=$loneLink['title']?></a>
                    </div>
                </div>

                <div class="pill" aria-controls="all">
                    <h3 class="pill__title">All Employees</h3>
                    <div class="pill__content">
                        <p><?=get_field('all_employees_content')?><p>
                        <a href="<?=$allLink['url']?>" class="button button-outline--white"><?=$allLink['title']?></a>
                    </div>
                </div>

                <div class="pill" aria-controls="home">
                    <h3 class="pill__title">Home &amp; Hybrid Workers</h3>
                    <div class="pill__content">
                        <p><?=get_field('hybrid_workers_content')?><p>
                        <a href="<?=$hybridLink['url']?>" class="button button-outline--white"><?=$hybridLink['title']?></a>
                    </div>
                </div>

            
            </div>

        </div>
    </div>
</section>