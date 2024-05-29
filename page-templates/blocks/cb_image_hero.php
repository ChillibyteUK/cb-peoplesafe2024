<?php
$bg = get_the_post_thumbnail_url( get_the_ID(), 'full' );
$align = get_field('align') == 'left' ? '' : 'offset-lg-6';
$bgalign = get_field('align') == 'left' ? 'image_hero--left' : 'image_hero--right';
?>    
<!-- image_hero -->
<section class="image_hero <?=$bgalign?> py-5" style="background-image:url(<?=$bg?>)">
    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-7 text_image__content <?=$align?>">
                <h1 class="gradient-text--<?=get_field('colour')?>"><?=get_field('title')?></h1>
                <div class="image_hero__content"><?=get_field('content')?></div>
                <?php
                if (get_field('cta_book_a_demo')) {
                    ?>
                <button type="button" class="btn btn-gradient btn-gradient--<?=get_field('colour')?> mb-2 mr-2" data-toggle="modal" data-target="#demoModal">Book a Demo</button>
                    <?php
                }
                else if (get_field('cta')) {
                    $cta = get_field('cta');
                    ?>
                <a class="btn btn-gradient btn-gradient--<?=get_field('colour')?> mb-2 mr-2" href="<?=$cta['url']?>" target="<?=$cta['target']?>"><?=$cta['title']?></a>
                    <?php
                }
		 		if (get_field('cta2')) {
                    $cta2 = get_field('cta2');
                    ?>
                <a class="btn btn-gradient btn-gradient--<?=get_field('colour')?> mb-2 mr-2" href="<?=$cta2['url']?>" target="<?=$cta2['target']?>"><?=$cta2['title']?></a>
                    <?php
                }
                if (get_field('modal_cta') != '') {
                    $id = get_field('modal_cta');
                    ?>
                <button type="button" class="btn btn-gradient btn-gradient--<?=get_field('colour')?> mb-2" data-toggle="modal" data-target="#<?=$id?>">Watch Video</button>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>