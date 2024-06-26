<?php
$grad = get_field('theme');
$cta = get_field('cta');
$img = wp_get_attachment_image_url(get_field('image'),'full');
?>
<!-- gradient_cta -->
<section class="gradient_cta py-5 bg_grad--<?=$grad?>">
    <div class="gradient_cta__image" style="--bg-url:url(<?=$img?>)"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-5">
                <h2><?=get_field('title')?></h2>
                <div class="mb-4"><?=get_field('content')?></div>
                <?php
				if (get_field('modal_trigger')[0] == 'Yes') {
					?>
				<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#demoModal">Book a Demo</button>
					<?php
				}
                elseif ($cta) {
                    ?>
                <a href="<?=$cta['url']?>" target="<?=$cta['target']?>" class="btn"><?=$cta['title']?></a>    
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
