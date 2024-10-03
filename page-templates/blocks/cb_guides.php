<section class="guides py-5">
    <div class="container-xl">
    <div class="d-flex justify-content-between align-content-center mb-4">
        <h2 class="mb-0">Guides</h2>
        <a href="/guides/" class="align-self-center kh_link">View all &gt;</a>
    </div>
    <div class="row g-4">
        <?php
            $n = new WP_Query(array(
                'post_type' => 'guides',
                'posts_per_page' => 4,
                'post_status' => 'publish',
                'post__not_in' => get_field('hidden_posts','options')
            ));
            while ($n->have_posts()) {
                $n->the_post();
                $img = get_the_post_thumbnail_url( $n->ID, 'large' );
                if (!$img) {
                    $img = catch_that_image(get_post($n->ID));
                }

                $content = get_the_content(null, false, $n->ID);
                $blocks = parse_blocks($content);
                $left_content = '';
                $content = '';

                foreach ($blocks as $block) {
                    if ($block['blockName'] === 'acf/cb-two-columns') {
                        // Get the left_content field from the block's inner content
                        if (isset($block['attrs']['data']['left_content'])) {
                            $left_content .= ' ' . $block['attrs']['data']['left_content'];
                        }
                    }
                }
                if ($left_content) {
                    // Trim the left_content to 20 words
                    $content = wp_trim_words($left_content, 15);
                } else {
                    // Fallback to regular content if no left_content was found
                    $content = wp_trim_words(get_the_content($n->ID), 15);
                }

                ?>
                <div class="col-lg-3 col-md-6">
                    <a href="<?=get_the_permalink($n->ID)?>" class="guide_card">
                        <div class="guide_card__image">
                            <?=get_the_post_thumbnail(get_the_ID(), 'large', array('class' => 'guide_card__img'))?>
                            <div class="flash flash--guide">Guide</div>
                        </div>
                        <h3><?=get_the_title()?></h3>
                        <div class="guide_card__content"><?=$content?></div>
                    </a>
                </div>
                <?php
            }
            wp_reset_postdata();
        ?>
    </div>
    </div>
</section>