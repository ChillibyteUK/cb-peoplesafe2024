<?php
//$uq = random_str(4);
$uq = '';
if (get_field('alt_thumbnail')) {
    $img = wp_get_attachment_image_url(get_field('alt_thumbnail'),'large');
}
else {
    $img = get_vimeo_data_from_id(get_field('vimeo_id'), 'thumbnail_url') ?: get_stylesheet_directory_uri() . '/img/ps-logo-placeholder.png';
}
?>
<section class="gated_modal py-5">
    <div class="container-xl">
        <h2 class="text-center"><?=get_field('block_title')?></h2>
        <div class="row">
            <div class="col-md-12 text-center mb-4 ratio ratio-16x9">
                <iframe src="https://player.vimeo.com/video/<?=get_field('vimeo_id')?>?h=716155803e&autoplay=1&color=ffb422&title=0&byline=0&portrait=0&muted=1" class="embed-responsive-item" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#gatedModal<?=$uq?>"><?=get_field('button_label')?></button>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="gatedModal<?=$uq?>" tabindex="-1" aria-labelledby="gatedLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title text-center mx-auto" id="gatedLabel">
                    <div class="h3 text-black"><?=get_field('modal_title')?></div>
                </div>
                <button type="button" class="btn-modal btn-close align-self-start" style="background:none;border:none"
                    data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div><?=get_field('modal_intro')?></div>
                <iframe loading="lazy" style="border: 0;" src="<?=get_field('modal_form_url')?>"
                    width="100%" height="1200" frameborder="0" scrolling="auto"></iframe>
            </div>
        </div>
    </div>
</div>