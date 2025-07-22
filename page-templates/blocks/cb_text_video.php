<?php
$order_image = (get_field('order') == 'text_left') ? 'order-1 order-lg-2' : 'order-1 order-lg-1';
$order_text = (get_field('order') == 'text_left') ? 'order-2 order-lg-1' : 'order-2 order-lg-2';
$modal = 'x' . random_str(8);

$cols_text = (get_field('split') == '5050' || get_field('split') == '') ? 'col-lg-6' : 'col-lg-8';
$cols_image = (get_field('split') == '5050' || get_field('split') == '') ? 'col-lg-6' : 'col-lg-4';

$text_fade = (get_field('order') == 'text_left') ? 'fade-right' : 'fade-left';
$image_fade = (get_field('order') == 'text_left') ? 'fade-left' : 'fade-right';

$extra_classes = get_field('extra_classes');
$video_provider = get_field('video_provider');
$video_id_raw = get_field('video_id');
$video_id_parts = explode('/', $video_id_raw);
$video_id = $video_provider === 'Vimeo' ? $video_id_parts[0] : $video_id_raw;
$video_hash = $video_provider === 'Vimeo' ? ($video_id_parts[1] ?? '') : '';
?>
<!-- text_video_2024 -->
<section class="text_video_2024 py-5 <?=$extra_classes?>">
    <div class="container-xl">
        <?php
        if (get_field('vid_title')) {
            ?>
        <h1 class="h2 mb-5">
            <?=get_field('vid_title')?>
        </h1>
        <?php
        }?>
        <div class="row g-4">
            <div
                class="<?=$cols_text?> text_video_2024__content py-auto <?=$order_text?>"
                data-aos="<?=$text_fade?>">
                <?php
                if (get_field('pre_title') ?? null) {
                    echo '<div class="fs-300 fw-900 text-blue mb-3">' . get_field('pre_title') . '</div>';
                }
$image_margin = '';
if (get_field('title')) {
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
                class="<?=$cols_image?> text_video_2024__container <?=$vid_margin?> text-center <?=$order_image?>"
                data-aos="<?=$image_fade?>">
                <div class="position-relative pointer">
                    <?php if ($video_provider === 'Vimeo') : ?>
                        <img src="<?= get_vimeo_data_from_id($video_id, 'thumbnail_url') ?>" class="img-fluid product_video pointer" data-bs-toggle="modal" data-bs-target="#modal<?= $modal ?>">
                    <?php else : ?>
                        <img src="https://img.youtube.com/vi/<?= $video_id ?>/hqdefault.jpg" class="img-fluid product_video pointer" data-bs-toggle="modal" data-bs-target="#modal<?= $modal ?>">
                    <?php endif; ?>
                    <div class="play"><span></span></div>
                </div>
                <?php
                if (get_field('content_below_video')) {
                    ?>
                <div class="text-end pt-5">
                    <?=get_field('content_below_video')?>
                </div>
                <?php
                }
?>

                <?php
                if (get_field('video_provider') == 'Vimeo') {
                    ?>
                <?php
                } else {
                    ?>
                <script type="application/ld+json">
                    {
                        "@context": "http://schema.org",
                        "@type": "VideoObject",
                        "name": "<?=get_field('name')?> | Peoplesafe",
                        "description": <?=json_encode(get_field('description'))?> ,
                        "thumbnailUrl": "https://i.ytimg.com/vi/<?=get_field('video_id')?>/default.jpg",
                        "uploadDate": "<?=get_field('video_upload_date')?>",
                        "duration": "<?=cb_time_to_8601(get_field('length'))?>",
                        "embedUrl": "https://www.youtube.com/embed/<?=get_field('video_id')?>"
                    }
                </script>
                <?php
                }
?>
            </div>
        </div>
        <?php
        if (get_field('video_transcript')) {
            ?>
        <style>
            #header_transcript {
                cursor: pointer;

            }

            #header_transcript.collapsed::after {
                content: "+";
            }

            #header_transcript::after {
                content: '-';
                margin-left: 1rem;
            }
        </style>
        <div class="pt-4">
            <div class="collapsed h4" data-bs-toggle="collapse" id="header_transcript"
                data-bs-target="#collapse_transcript" aria-expanded="false" aria-controls="collapse_transcript">Video
                Transcript</div>
            <div class="collapse" id="collapse_transcript" aria-labelledby="heading_transcript">
                <div class="pt-2">
                    <?=apply_filters('the_content', get_field('video_transcript'))?>
                </div>
            </div>
        </div>
        <?php
        }
?>
    </div>
</section>

<div class="modal fade" id="modal<?=$modal?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content product-modal">
            <div class="modal-body">
                <div type="button" class="modal-close" data-bs-dismiss="modal"><i class="fas fa-times"></i></div>
                <div class="ratio ratio-16x9">
                    <div class="lazy-video-wrapper" data-provider="<?= esc_attr($video_provider) ?>" data-video-id="<?= esc_attr($video_id) ?>" data-video-hash="<?= esc_attr($video_hash) ?>"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script nitro-exclude>
jQuery(function($){
  function buildIframe(provider, videoId, hash) {
    let src = '';
    if (provider === 'youtube') {
      src = 'https://www.youtube-nocookie.com/embed/' + videoId + '?autoplay=1';
    } else if (provider === 'vimeo') {
      src = 'https://player.vimeo.com/video/' + videoId + '?autoplay=1&h=' + hash;
    }
    return $('<iframe>', {
      src: src,
      allow: 'autoplay; fullscreen; picture-in-picture',
      allowfullscreen: true,
      frameborder: 0,
      width: '100%',
      height: '100%',
      class: 'embed-responsive-item'
    });
  }

  $(document).on('shown.bs.modal', function (e) {
    const $modal = $(e.target);
    $modal.find('.lazy-video-wrapper').each(function () {
      const $wrapper = $(this);
      if ($wrapper.children('iframe').length === 0) {
        const provider = $wrapper.data('provider').toLowerCase();
        const videoId = $wrapper.data('video-id');
        const hash = $wrapper.data('hash') || '';
        const $iframe = buildIframe(provider, videoId, hash);
        $wrapper.html($iframe);
      }
    });
  });

  $(document).on('hide.bs.modal', function (e) {
    const $modal = $(e.target);
    $modal.find('.lazy-video-wrapper').empty();
  });
});
</script>