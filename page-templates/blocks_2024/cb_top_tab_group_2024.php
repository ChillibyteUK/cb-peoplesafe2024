<section class="top_tab_group_2024 py-5">
    <div class="container-xl">
        <div class="top_tab_group_2024__inner">
            <?php
            $i = 'x' . random_str(4);
            $active = 'active';
            $c = 1;
            $d=0;
            $fade = 'data-aos="fade" data-aos-delay="' . $d . '"';
            while (have_rows('tabs')) {
                the_row();

                
                $icon = wp_get_attachment_image_url(get_sub_field('tab_icon'), 'medium', false);
                $tab_title = get_sub_field('tab_title');
                $pre_title = get_sub_field('pre_title');
                $link = get_sub_field('link');
                $image = wp_get_attachment_image(get_sub_field('image'), 'large', false, array('class' => 'content__image', 'width' => 500, 'height' => 500, 'alt' => $tab_title));
                ?>
            <div data-aos="fade" data-aos-delay="<?=$d?>">
                <div class="pill <?=$active?>" aria-controls="<?=$i?>_tab_<?=$c?>">
                    <img class="pill__icon" src="<?=$icon?>">
                    <div class="pill__title"><?=$tab_title?></div>
                </div>
            </div>
            <div class="content <?=$active?>" id="<?=$i?>_tab_<?=$c?>" <?=$fade?>>
                <?php if ( $image ) : ?>
                    <?= $image; ?>
                <?php endif; ?>

                <div class="content__inner">
                    <?php if ( $pre_title ) : ?>
                        <div class="fs-300 fw-900 text-orange"><?= esc_html( $pre_title ); ?></div>
                    <?php endif; ?>

                    <?php if ( get_sub_field( 'title' ) ) : ?>
                        <h2><?= esc_html( get_sub_field( 'title' ) ); ?></h2>
                    <?php endif; ?>

                    <?php if ( get_sub_field( 'content' ) ) : ?>
                        <p><?= esc_html( get_sub_field( 'content' ) ); ?></p>
                    <?php endif; ?>

                    <?php if ( is_array( $link ) && ! empty( $link['url'] ) ) : ?>
                        <a href="<?= esc_url( $link['url'] ); ?>" class="button button-outline">
                            <?= esc_html( $link['title'] ?? 'Learn more' ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
                <?php
                $c++;
                $d+=50;
                $active = '';
                $fade = '';
            }
            ?>
        </div>
    </div>
</section>