<?php
$grad = get_field('theme');
$cta = get_field('cta');
?>
<!-- gradient_cta -->
<section class="gradient_cta py-5 bg_grad--<?=$grad?>">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <h2><?=get_field('title')?></h2>
                <div class="mb-4"><?=get_field('content')?></div>
                <?php
				if (get_field('modal_trigger')[0] == 'Yes') {
					?>
				<button type="button" class="btn" data-toggle="modal" data-target="#demoModal">Book a Demo</button>
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
