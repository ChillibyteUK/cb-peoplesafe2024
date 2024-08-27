<?php
$orderText = get_field('order') == 'Text Image' ? 'order-2 order-md-1' : 'order-2 order-md-2';
$orderImage = get_field('order') == 'Text Image' ? 'order-1 order-md-2' : 'order-1 order-md-1';

$l = get_field('cta') ?? null;
?>
<section class="text_image_2024 py-5">
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-md-6 <?=$orderText?>">
                <div class="fs-300 fw-900 text-blue mb-3"><?=get_field('pre_title')?></div>
                <h2><?=get_field('title')?></h2>
                <p><?=get_field('content')?></p>
                <?php
                if (!empty($l)) {
                    ?>
                <a href="<?=$l['url']?>" target="<?=$l['target']?>" class="button button-yellow text-center w-100 w-md-auto"><span><?=$l['title']?></span></a>
                    <?php
                }
                ?>
            </div>
            <div class="col-md-6 <?=$orderImage?> text-center">
                <?php
                if (get_field('image') ?? null) {
                    echo wp_get_attachment_image(get_field('image'),'full',false);
                }
                elseif (get_field('vimeo_id') ?? null) {
                    ?>
                <lite-vimeo videoid="<?=get_field('vimeo_id')?>" allowfullscreen>
                    <div class="ltv-playbtn"></div>
                </lite-vimeo>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php
add_action('wp_footer', function() {
    ?>
<script type="module" src="https://cdn.jsdelivr.net/npm/lite-vimeo-embed/+esm" defer></script>
    <?php
});