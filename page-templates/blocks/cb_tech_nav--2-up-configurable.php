<?php
$blockTitle = get_field('title');
$blockLink = get_field('link') ?: '#form';
$blockCTA = get_field('block_cta') ?: 'Book a demo';


$devImage = get_field('devices_image') ?: get_stylesheet_directory_uri() . '/img/safety-devices.png';
$devTitle = get_field('devices_title') ?: 'Lone Worker Devices';
$devText = get_field('devices_text') ?: 'Dedicated SOS devices discreetly designed to protect lone and at-risk workers';

$appImage = get_field('app_image') ?: get_stylesheet_directory_uri() . '/img/safety-apps.png';
$appTitle = get_field('app_title') ?: 'Lone Worker Apps';
$appText = get_field('app_text') ?: 'Simple to use personal safety app with enhanced features for lone workers who need extra protection';

?>
<style>
.tech_nav img {
    height: 300px;
    object-fit: contain;
    margin-bottom: 1rem;
}
</style>
<!-- tech_nav -->
<section class="tech_nav py-5 py-md-0">
    <div class="container">
        <div class="row">
            <div class="col-md-4 my-auto">
                <h2><?=$blockTitle?></h2>
				<a href="<?=$blockLink?>" class="btn btn-primary"><?=$blockCTA?></a>
            </div>
            <div class="col-md-4 text-center mb-4">
                <img src="<?=$devImage?>" class="img-fluid tech_nav__image">
                <h3 class="h4"><?=$devTitle?></h3>
                <?=$devText?>
            </div>
            <div class="col-md-4 text-center mb-4">
                <img src="<?=$appImage?>" class="img-fluid tech_nav__image">
                <h3 class="h4"><?=$appTitle?></h3>
                <?=$appText?>
            </div>
        </div>
    </div>
</section>