<style>
.media__item {
    display: block;
    background-color: #090f1b;
    color: #fff;
    padding: 1rem;
    text-decoration: none;
    transition: color 250ms ease-out;
}
a.media__item:hover {
    color: #d68100;
    text-decoration: none;
}
.media__preview {
    aspect-ratio: 1;
    width: 100%;
    object-fit: cover;
    object-position: top;
    margin-bottom: 1rem;
}
.media__turtl {
    width: 100%;
    margin-bottom: 1rem;
}
@media (min-width:992px) {
    .media__turtl {
        aspect-ratio: 1;
    }
}
.media__turtl a {
    width: 100% !important;
}
.media__title {
    font-weight: 700;
    font-size: 1.1rem;
    min-height: 4rem;
}
.media__info {
    font-size: 0.8rem;
}
</style>
<section class="media_block py-5">
    <div class="container-xl">
        <h2><?=get_field('title')?></h2>
        <div class="row g-4">
            <?php
$has_turtl = false;
while(have_rows('content')) {
    the_row();

    if (get_sub_field('media_item')) {
        $item = get_sub_field('media_item');
        $thumb = wp_get_attachment_image_url( $item['id'], 'large' );

        $title = get_sub_field('pdf_title') ?: $item['title'];
        ?>
        <div class="col-md-2 col-lg-3 mb-4">
            <a href="<?=$item['url']?>" class="media__item">
                <img src="<?=$thumb?>" class="media__preview">
                <div class="media__title"><?=$title?></div>
                <div class="media__info">PDF | <?=formatBytes($item['filesize'])?></div>
            </a>
        </div>
        <?php
    }
    else {
        $turtl = get_sub_field('turtl_embed');
        $title = get_sub_field('turtl_title');
        ?>
            <div class="col-md-2 col-lg-3 mb-4">
                <div class="media__item">
                    <div class="media__turtl"><?=$turtl?></div>
                    <div class="media__title"><?=$title?></div>
                    <div class="media__info">&nbsp;</div>
                </div>
            </div>
        <?php
        $has_turtl = true;
    }
}
            ?>
        </div>
    </div>
</section>
<?php

if ($has_turtl) {

    add_action('wp_footer',function(){
    ?>
<script async type="text/javascript" data-turtl-script="embed" data-turtl-assets-hostname="https://assets.turtl.co" src="https://app-static.turtl.co/embed/turtl.embed.v1.js"></script>
    <?php
    });

}