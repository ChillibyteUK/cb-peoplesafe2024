<?php
$theme = get_field('theme');
?>
<!-- two_cols -->
<section class="two_cols py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="bg_grad--<?=$theme?> h3 p-3">Key benefits</div>
                <?php
                while(have_rows('icon_usps')) {
                    the_row();
                    ?>
                <div class="row mb-4">
                    <div class="col-sm-2 px-0">
                        <img src="<?=get_stylesheet_directory_uri()?>/img/icon--<?=get_sub_field('icon')?>.svg" class="icon--<?=$theme?>" width="66" height="66" style="max-width:66px">
                    </div>
                    <div class="col-sm-10">
                        <h2 class="product__icon_title"><?=get_sub_field('title')?></h2>
                        <div><?=get_sub_field('description')?></div>
                    </div>
                </div>
                    <?php
                }
                ?>
            </div>
            <div class="col-md-6">
                <?=apply_filters( 'the_content', get_field('right_content') )?>
            </div>
        </div>
    </div>
</section>