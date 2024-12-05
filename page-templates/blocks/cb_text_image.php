<?php
$order_image = (get_field('order') == 'text_left') ? 'order-1 order-lg-2' : 'order-1 order-lg-1';
$order_text = (get_field('order') == 'text_left') ? 'order-2 order-lg-1' : 'order-2 order-lg-2';

$image_fade = (get_field('order') == 'text_left') ? 'fade-left' : 'fade-right';
$text_fade = (get_field('order') == 'text_left') ? 'fade-right' : 'fade-left';

$cols_text = (get_field('split') == '5050' || get_field('split') == '') ? 'col-lg-6' : 'col-lg-8';
$cols_image = (get_field('split') == '5050' || get_field('split') == '') ? 'col-lg-6' : 'col-lg-4';

?>
<!-- text_image -->
<section class="text_image py-5 <?=$theme?>">
    <div class="container-xl">
        <div class="row g-4">
            <div
                class="<?=$cols_text?> text_image__content py-auto <?=$order_text?>"
                data-aos="<?=$text_fade?>">
                <?php
                if (get_field('pre_title') ?? null) {
                    echo '<div class="fs-300 fw-900 text-blue mb-3">' . get_field('pre_title') . '</div>';
                }
if (get_field('title') ?? null) {
    echo '<h2>' . get_field('title') . '</h2>';
}
?>
                <p><?=get_field('content')?></p>
                <?php
if (get_field('cta')) {
    $cta = get_field('cta');
    echo '<a href="' . $cta['url'] . '" target="' . $cta['target'] . '" class="button button-yellow"><span>' . $cta['title'] . '</span></a>';
}
?>
            </div>
            <div
                class="<?=$cols_image?> text-center py-auto <?=$order_image?>"
                data-aos="<?=$image_fade?>">
                <?=wp_get_attachment_image(get_field('image'), 'large', false, array('class' => 'text_image__image'))?>
            </div>
        </div>
    </div>
</section>