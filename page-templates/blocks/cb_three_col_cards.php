<?php
$img1 = wp_get_attachment_image_url(get_field('card_1_image'),'large');
$img2 = wp_get_attachment_image_url(get_field('card_2_image'),'large');
$img3 = wp_get_attachment_image_url(get_field('card_3_image'),'large');
?>
<section class="three_col_cards">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-4">
                <div class="three_col_cards__card three_col_cards__card--<?=get_field('card_1_colour')?>">
                    <div class="three_col_cards__image" style="background-image:url(<?=$img1?>)"></div>
                    <div class="three_col_cards__content">
                        <h2><?=get_field('card_1_title')?></h2>
                        <ul>
                            <?=cb_list(get_field('card_1_content'))?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="three_col_cards__card three_col_cards__card--<?=get_field('card_2_colour')?>">
                    <div class="three_col_cards__image" style="background-image:url(<?=$img2?>)"></div>
                    <div class="three_col_cards__content">
                        <h2><?=get_field('card_2_title')?></h2>
                        <ul>
                            <?=cb_list(get_field('card_2_content'))?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="three_col_cards__card three_col_cards__card--<?=get_field('card_3_colour')?>">
                    <div class="three_col_cards__image" style="background-image:url(<?=$img3?>)"></div>
                    <div class="three_col_cards__content">
                        <h2><?=get_field('card_3_title')?></h2>
                        <ul>
                            <?=cb_list(get_field('card_3_content'))?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>