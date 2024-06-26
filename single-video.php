<?php
/**
 * The template for displaying all single videos
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
the_post();

$catnames = get_the_category(get_the_ID());
$catnameArr = array();
if ($catnames) {
    foreach ($catnames as $obj) {
        $catnameArr[] = '<a href="' . get_category_link( $obj->term_id ) . '">' . $obj->name . '</a>';
    }
}
$cats = implode(', ', $catnameArr);
$posttags = get_the_tags();
?>
<main id="main" class="pt-5">
    <div class="container py-3 mb-4">
        <div class="page-meta">
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>
        <h1 class="news__title"><?=get_the_title()?></h1>
        <div class="py-4">
            <div class="embed-responsive embed-responsive-16by9 mb-4">
                <iframe id="vid<?=$modal?>" class="embed-responsive-item" src="https://player.vimeo.com/video/<?=get_field('vimeo_id')?>?byline=0&portrait=0" allow="autoplay; fullscreen; picture-in-picture" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
            <?=apply_filters('the_content', get_the_content())?>

            <?php
            if(get_field('transcription')) {
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
    <div class="py-4">
        <div class="collapsed h3" data-bs-toggle="collapse" id="header_transcript" data-bs-target="#collapse_transcript" aria-expanded="false" aria-controls="collapse_transcript">Video Transcript</div>
        <div class="collapse" id="collapse_transcript" aria-labelledby="heading_transcript"><div class="pt-2"><?=apply_filters('the_content',get_field('transcription'))?></div></div>
    </div>
            <?php
        }
        ?>
        </div>
        <?=other_videos(get_the_ID())?>
    </div>
</main>
<?php
/* schema markup added by vimeo embed.

$title = get_vimeo_data_from_id(get_field('vimeo_id'), 'title');
$thumb = get_vimeo_data_from_id(get_field('vimeo_id'), 'thumbnail_url');
$date = get_vimeo_data_from_id(get_field('vimeo_id'), 'upload_date');
$duration = get_vimeo_data_from_id(get_field('vimeo_id'), 'duration');
?>
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "VideoObject",
    "name": "<?=$title?> | Peoplesafe",
    "description": <?=json_encode(strip_tags(get_the_content()))?>,
    "thumbnailUrl": "<?=$thumb?>",
    "uploadDate": "<?=$date?>",
    "duration": "PT<?=$duration?>S",
    "embedUrl": "https://player.vimeo.com/video/<?=get_field('vimeo_id')?>"
}
</script>
<?php
*/
get_footer();
