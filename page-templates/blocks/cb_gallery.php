<?php
$theme = get_field('theme');
echo '<link rel="stylesheet" href="' . get_stylesheet_directory_uri() . '/css/jquery.fancybox.min.css" />';
?>
<style>
.gallery a { text-decoration: none; }
.gallery__caption{ text-decoration: none; margin-top: 0.5rem; text-align: center; color: black; font-weight: 600; }
</style>
<!-- gallery -->
<section class="gallery py-5 bg--<?=$theme?> <?=$block['className']?>">
    <div class="container">
		<h2 class="mb-4 text-center">Gallery</h2>
        <div class="row justify-content-center">
            <?php
            $images = get_field('gallery');
		    $caption = get_field('show_caption')[0] == 'Yes' ? 1 : 0;
            foreach ($images as $i) {
                $metadata = get_post( $i );
				$the_caption = $caption == 1 ? $metadata->post_excerpt : '';
                ?>
                <div class="col-md-3 mb-4 d-flex justify-content-center align-items-start">
                    <span data-thumb="<?=wp_get_attachment_image_url( $i, 'thumbnail' )?>">
                        <a href="<?=wp_get_attachment_image_url( $i, 'full' )?>" data-fancybox="gallery" data-caption="<?=$the_caption?>">
                            <img src="<?=wp_get_attachment_image_url( $i, 'large' )?>">
							<?php
                            if ($caption == 1 && $the_caption) {
                                echo '<div class="gallery__caption">' . $the_caption . '</div>';
                            }
                            ?>
                        </a>
                    </span>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
<?php
add_action('wp_footer', function () {
    ?>
<script src="<?=get_stylesheet_directory_uri()?>/js/jquery.fancybox.min.js"></script>
    <?php
}, 9999);