<!-- timeline -->
<link rel="stylesheet" href="<?=get_stylesheet_directory_uri()?>/css/animate.min.css" />
<section class="timeline mb-5">
    <?php
    $side = 'left';
    while(have_rows('timeline')) {
        the_row();
        $theme = get_sub_field('theme');
        $anim = ucfirst($side);
        ?>
    <div class="timeline__container <?=$theme?> <?=$side?> wow animate__animated animate__fadeIn<?=$anim?>">
        <div class="timeline__content <?=$theme?>">
            <div class="timeline__date d-flex">
                <h2 class="h3"><?=get_sub_field('year')?></h2>
                <?php
                if (get_sub_field('month')) {
                    ?>
                <h3 class="h4 align-self-center">&nbsp;&mdash; <?=get_sub_field('month')?></h3>
                    <?php
                }
                ?>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <?php
                    if (get_sub_field('icon')) {
                        echo '<img src="' . wp_get_attachment_image_url(get_sub_field('icon'),'full') . '">';
                    }
                    else {
                        // tl--grey : Founded
                        // tl--yellow : Acquisition
                        // tl--pink : Product
                        // tl--green : Partnership
                        // tl--orange : Staff
                        if ($theme == 'tl--grey') {
                            echo '<i class="fa fa-2x fa-flag"></i>';
                        }
                        elseif ($theme == 'tl--yellow') {
                            echo '<i class="fa fa-2x fa-landmark"></i>';
                        }
                        elseif ($theme == 'tl--pink') {
                            echo '<i class="fa fa-2x fa-tag"></i>';
                        }
                        elseif ($theme == 'tl--green') {
                            echo '<i class="fa fa-2x fa-handshake"></i>';
                        }
                        elseif ($theme == 'tl--orange') {
                            echo '<i class="fa fa-2x fa-user-tie"></i>';
                        }
                    }
                    ?>
                </div>
                <div class="col-sm-10">
                    <?=get_sub_field('content')?>
                    <?php
                    if (get_sub_field('link')) {
                        ?>
                    <div class="text-right"><a href="<?=get_the_permalink(get_sub_field('link')[0])?>">Read more</a></div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
        <?php
        $side = $side == 'left' ? 'right' : 'left';
    }        
    ?>
</section>
<script src="<?=get_stylesheet_directory_uri()?>/js/wow.min.js"></script>
