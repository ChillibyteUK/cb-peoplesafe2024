<?php
$grad = get_field('theme');
$cta = get_field('cta');
?>
<!-- gradient_preview -->
<section class="gradient_cta py-5 bg_grad--<?=$grad?>">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?=wp_get_attachment_image_url(get_field('image'),'large')?>">
            </div>
            <div class="col-md-6">
                <h2><?=get_field('title')?></h2>
                <div class="mb-4"><?=get_field('content')?></div>
                <?php
                if ($cta) {
                    ?>
                <a href="<?=$cta['url']?>" target="<?=$cta['target']?>" class="btn"><?=$cta['title']?></a>    
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
