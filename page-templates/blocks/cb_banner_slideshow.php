<?php

$title = get_field('title') ?? null;
$header_theme = get_field('title_theme');

?>
<style>
:root {
    --banner-height: 400px;
}
.banner_slideshow .slides {
    height: var(--banner-height);
}
.banner_slideshow .slide {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    isolation: isolate;
}
.banner_slideshow .carousel-item {
    height: var(--banner-height);
}
.banner_slideshow .carousel-item .container-xl {
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100%;
}
.slide .overlay {
    position: absolute;
    inset:0;
    z-index: -1;
}
.slides.text-white .overlay {
    background-color: rgb(0 0 0 / 0.6);
}
.slides.text-black .overlay {
    background-color: rgb(255 255 255 / 0.2);
}
.banner_slideshow .bg-black {
    background-color: #0a0f1c;
}
</style>
<section class="banner_slideshow">
    <?php
    $show_theme = get_field('title_theme') ?: '';
    $show_theme_bg = $show_theme == 'text-black' ? 'bg-white' : 'bg-black';
    if ($title) {
        ?>
    <div class="banner_slideshow__title_container <?=$show_theme_bg?>">
        <div class="container-xl py-4">
            <h2 class="text-center mb-0 <?=$show_theme?>"><?=$title?></h2>
        </div>
    </div>
        <?php
    }
    $slides_theme = get_field('slideshow_theme') ?: '';
    if (have_rows('slides')) {
        $active = 'active';
        ?>
    <div class="slides carousel slide <?=$slides_theme?>" id="bannerSlideshow" data-bs-ride="carousel" data-bs-interval="4000" data-touch="true">
        <div class="carousel-inner">
        <?php
        while (have_rows('slides')) {
            the_row();
            $bg = wp_get_attachment_image_url(get_sub_field('slide_background'),'large');
            ?>
<div class="slide carousel-item <?=$active?>" style="background-image:url(<?=$bg?>)">
    <div class="overlay"></div>
    <div class="container-xl py-5">
        <h3 class="slide__title"><?=get_sub_field('slide_title')?></h3>
        <div><?=get_sub_field('slide_content')?></div>
        <?php
        if (get_sub_field('slide_cta')) {
            $s = get_sub_field('slide_cta');
            ?>
            <div class="pt-4">
                <a href="<?=$s['url']?>" target="<?=$s['target']?>" class="btn btn-primary"><?=$s['title']?></a>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php
            $active = '';
        }
        ?>
            </div>
			<a class="d-none d-xl-flex carousel-control-prev" href="#bannerSlideshow" role="button" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
		  	</a>
		  	<a class="d-none d-xl-flex carousel-control-next" href="#bannerSlideshow" role="button" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
		  	</a>
        </div>
        <?php
    }
    ?>
</section>