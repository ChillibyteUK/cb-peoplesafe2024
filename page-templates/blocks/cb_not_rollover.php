<style>
.not-rollover {
    display: flex;
    flex-direction: column;
}
.not-rollover .nr-item {
    position: relative;
    height: 400px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    width: 100%;
}
@media (min-width:992px) {
    .not-rollover {
        flex-direction: row;
    }
    .not-rollover .nr-item {
        width: 33vw;
    }
}
.not-rollover .rollover__content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    min-height: 6rem;
    padding: 1rem;
    background-color: hsla(223, 47%, 7%, 60%);
    font-size: 1.4rem;
    padding: 0.5rem 2rem;
}
</style>
<!-- not_rollover -->
<section class="not-rollover bg--navy">
    <div class="nr-item" style="background-image:url(<?=wp_get_attachment_image_url( get_field('image_1'), 'full' )?>)">
        <div class="rollover__content">
            <?=get_field('title_1')?>
            <div class="h99"><?=get_field('subtitle_1')?></div>
        </div>
    </div>
    <div class="nr-item" style="background-image:url(<?=wp_get_attachment_image_url( get_field('image_2'), 'full' )?>)">
        <div class="rollover__content">
            <?=get_field('title_2')?>
            <div class="h99"><?=get_field('subtitle_2')?></div>
        </div>
    </div>
    <div class="nr-item" style="background-image:url(<?=wp_get_attachment_image_url( get_field('image_3'), 'full' )?>)">
        <div class="rollover__content">
            <?=get_field('title_3')?>
            <div class="h99"><?=get_field('subtitle_3')?></div>
        </div>
    </div>
</section>
