<!-- video -->
<div class="embed-responsive embed-responsive-16by9 my-4">
<?php
if (get_field('video_provider') == 'YouTube') {
    ?>
    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?=get_field('video_id')?>" allow="autoplay; fullscreen; picture-in-picture" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
    <?php
}
else {
    ?>
    <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/<?=get_field('video_id')?>?byline=0&portrait=0" allow="autoplay; fullscreen; picture-in-picture" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
    <?php
}
?>
</div>
<?php
if (get_field('name')) {
    ?>
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "VideoObject",
    "name": "<?=get_field('name')?> | Peoplesafe",
    "description": <?=json_encode(get_field('description'))?>,
    "thumbnailUrl": "https://i.ytimg.com/vi/<?=get_field('video_id')?>/default.jpg",
    "duration": "<?=cb_time_to_8601(get_field('length'))?>",
    "embedUrl": "https://www.youtube.com/embed/<?=get_field('video_id')?>"
}
</script>
    <?php
}