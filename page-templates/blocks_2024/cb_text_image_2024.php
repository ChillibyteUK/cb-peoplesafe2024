<?php
$orderText = get_field('order') == 'Text Image' ? 'order-2 order-md-1' : 'order-2 order-md-2';
$orderImage = get_field('order') == 'Text Image' ? 'order-1 order-md-2' : 'order-1 order-md-1';

$image_fade = (get_field('order') == 'text_left') ? 'fade-right' : 'fade-left';
$text_fade = (get_field('order') == 'text_left') ? 'fade-left' : 'fade-right';

$l = get_field('cta') ?? null;
?>
<section class="text_image_2024 py-5">
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-md-6 <?=$orderText?>"
                data-aos="<?=$text_fade?>">
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
            <div class="col-md-6 <?=$orderImage?> text-center"
                data-aos="<?=$image_fade?>">
                <?php
                if (get_field('image') ?? null) {
                    echo wp_get_attachment_image(get_field('image'),'full',false);
                }
                elseif (get_field('vimeo_id') ?? null) {
                    ?>
                <div class="vimeo-embed ratio ratio-16x9" id="<?=get_field('vimeo_id')?>" title="VIDEO">
                </div>
                <!-- <iframe src="https://player.vimeo.com/video/<?=get_field('vimeo_id')?>?byline=0&portrait=0" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe> -->
<!--
                <lite-vimeo videoid="<?=get_field('vimeo_id')?>" allowfullscreen>
                    <div class="ltv-playbtn"></div>
                </lite-vimeo>
-->
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php
add_action('wp_footer', function(){
    ?>
<script>
document.querySelectorAll('.vimeo-embed, .youtube-embed').forEach(v => {
  const [poster, src] = v.classList.contains('vimeo-embed') ?
    [`vumbnail.com/${v.id}.jpg`, 'player.vimeo.com/video'] :
    [`i.ytimg.com/vi/${v.id}/hqdefault.jpg`, 'www.youtube.com/embed'];

  v.innerHTML = `<img loading="lazy" src="https://${poster}" alt="${v.title}" aria-label="Play"><div class="ltv-playbtn"></div>`;

  v.children[0].addEventListener('click', () => {
      v.innerHTML = `<iframe allow="autoplay" src="https://${src}/${v.id}?autoplay=1" allowfullscreen></iframe>`;
      v.classList.add('video-loaded');
  });
});
</script>
    <?php
});