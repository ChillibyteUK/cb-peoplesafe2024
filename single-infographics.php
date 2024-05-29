<?php
/**
 * The template for displaying all single posts
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
the_post();

?>
<style>
    .btn {
        border: 0;
    }

    .a4-preview {
        aspect-ratio: 1 / 1.41;
        object-fit: cover;
        object-position: top;
    }

    .a4-preview__container {
        position: relative;
    }

    .a4-preview__container::after {
        content: "";
        position: absolute;
        inset: 0;
        background-image: linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 20%);
    }
</style>
<main id="main" class="pt-5">
    <div class="container py-3">
        <div class="page-meta">
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
            }

            $filesize = filesize(get_attached_file(get_field('file', get_the_ID())));
$filesize = size_format($filesize, 2);
?>
        </div>
        <h1 class="news__title"><?=get_the_title()?></h1>
        <div class="row pb-4">
            <div class="col-md-3">
                <a href="<?=get_the_permalink(get_field('file', get_the_ID()))?>"
                    class="noline" download>
                    <div class="a4-preview__container mb-3">
                        <?=wp_get_attachment_image(get_field('file', get_the_ID()), 'large', false, array('class' => 'a4-preview'))?>
                    </div>
                    <div class="btn btn-block btn-gradient--orange mb-2 mr-2">Download
                        <small>(<?=$filesize?>)</small> <i
                            class="fas fa-download"></i>
                    </div>
                </a>
            </div>
            <div class="col-md-9">
                <?=get_field('transcription')?>
            </div>
        </div>
    </div>
</main>
<?php

get_footer();
?>