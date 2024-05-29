<!-- two_cards -->
<section class="two_cards py-5">
    <div class="container">
        <?php
        if (get_field('title')) {
            $c = get_field('centre_title') ? ' class="text-center"' : '';
            echo '<h2' . $c . '>' . get_field('title') . '</h2>';
        }
        if (get_field('intro')) {
            $c = get_field('centre_title') ? 'text-center' : '';
            echo '<div class="' . $c . ' mb-4">' . get_field('intro') . '</div>';
        }
        $card1 = get_field('card_1');
        $card2 = get_field('card_2');
        ?>
        <div class="row">
            <div class="col-lg-6">
                <img src="<?=wp_get_attachment_image_url($card1['image'],'large')?>" class="img-fluid mb-4">
                <h3><?=$card1['title']?></h3>
                <div class="two_cards__content"><?=$card1['content']?></div>
                <a href="<?=$card1['link']['url']?>" target="<?=$card1['link']['target']?>" class="btn btn-primary"><?=$card1['link']['title']?></a>
            </div>
            <div class="col-lg-6">
                <img src="<?=wp_get_attachment_image_url($card2['image'],'large')?>" class="img-fluid mb-4">
                <h3><?=$card2['title']?></h3>
                <div class="two_cards__content"><?=$card2['content']?></div>
                <a href="<?=$card2['link']['url']?>" target="<?=$card1['link']['target']?>" class="btn btn-primary"><?=$card2['link']['title']?></a>
            </div>
        </div>
    </div>
</section>