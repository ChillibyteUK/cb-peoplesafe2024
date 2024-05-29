<?php
$dark = get_field('background') == 'dark' ? 'bg--navy' : '';
$overlay = '';
if (isset(get_field('watermark')[0])) {
    $overlay = 'feature--overlay';
}
?>
<section class="feature py-5 <?=$overlay?> <?=$dark?>">
    <div class="container">
        <?php
        if (get_field('intro')) {
            ?>
        <h2 class="text-center"><?=get_field('title')?></h2>
        <div class="text-larger text-center max-ch mb-4"><?=get_field('intro')?></div>
        <?php
        }
        else {
            ?>
            <h2><?=get_field('title')?></h2>
            <?php
        }
        ?>
        <ul class="check cols-lg-2">
        <?php
        while (have_rows('features')) {
            the_row();
            echo '<li>' . get_sub_field('feature') . '</li>';
        }
        ?>
        </ul>
    </div>
</section>