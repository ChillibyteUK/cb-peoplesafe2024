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
                <h2><?=get_field('title')?></h2>
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
    if (get_field('title')) {
        echo '<h2>' . get_field('title') . '</h2>';
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