<?php
$theme = get_field('theme');

if ( is_page_template( 'landing-page.php' ) ) {
    $text_center = "text-center";
} else {
    $text_center = "";
}
?>
<!-- text_block -->
<section class="text_block py-5 bg--<?=$theme?> <?=$text_center?>">
    <div class="container">
<?php
if (get_field('side_title')) {
    ?>
        <div class="row">
            <div class="col-md-4">
                <?php
                $content = get_field('title') ?? null;
                if (preg_match('/<h[1-6][^>]*>(.*?)<\/h[1-6]>/', $content)) {
                    // If it contains H tags, return the content as it is
                    echo $content;
                } else {
                    // If no H tags are found, wrap the content in an <h2> tag
                    echo '<h2>' . esc_html($content) . '</h2>';
                }
                ?>
            </div>
            <div class="col-md-8">
                <?php
                if (get_field('cta')) {
                    echo '<div class="mb-4">';
                }
                else {
                    echo '<div>';
                }
                echo get_field('content') . '</div>';
                if (get_field('cta')) {
                    $cta = get_field('cta');
                    ?>
                <a href="<?=$cta['url']?>" target="<?=$cta['target']?>" class="btn btn-primary"><?=$cta['title']?></a>
                    <?php
                }
                ?>
            </div>
        </div>
    <?php
}
else {
    $content = get_field('title') ?? null;
    if (preg_match('/<h[1-6][^>]*>(.*?)<\/h[1-6]>/', $content)) {
        // If it contains H tags, return the content as it is
        echo $content;
    } else {
        // If no H tags are found, wrap the content in an <h2> tag
        echo '<h2>' . esc_html($content) . '</h2>';
    }
    if (get_field('cta')) {
        echo '<div class="mb-4">';
    }
    else {
        echo '<div>';
    }
    echo get_field('content') . '</div>';
    if (get_field('cta')) {
        $cta = get_field('cta');
        ?>
    <a href="<?=$cta['url']?>" target="<?=$cta['target']?>" class="btn btn-primary"><?=$cta['title']?></a>
        <?php
    }
}
?>
    </div>
</section>