<?php
$class = $block['className'] ?? 'py-5';
?>
<!-- related_products -->
<section class="related_products <?=$class?>">
    <div class="container-xl">
        <?php if (!get_field('hide_title')) {
            $title = get_field('title') ?? 'Related Products';
            ?>
        <h2 class="text-center mb-4"><?=$title?></h2>
        <?php
        }
        ?>
        <div class="row justify-content-center">
            <?php
            foreach (get_field('related_products') as $r) {
                // $img = get_the_post_thumbnail_url( $r->ID, 'large' );
                // if (!$img) {
                //     $img = catch_that_image($r);
                // }
                ?>
            <div class="col-md-6 col-lg-3 mb-4">
                <a href="<?=get_the_permalink($r->ID)?>"
                    class="related_products__card">
                    <?=get_the_post_thumbnail($r->ID, 'large', array('class' => 'related_products__image'))?>
                    <div class="related_products__inner">
                        <h3><?=get_the_title($r->ID)?></h3>
                        <div class="fs-300">
                        <?php
                        $content = get_the_content(null, false, $r->ID);
                        $blocks = parse_blocks($content);
                    
                        // Loop through the blocks
                        foreach ($blocks as $block) {
                            // Check if the block name is 'acf/cb-product-header-2024'
                            if ($block['blockName'] === 'acf/cb-product-header-2024' || $block['blockName'] === 'acf/cb-product-header') {
                                // Return the content of the 'intro' field
                                echo isset($block['attrs']['data']['intro']) ? $block['attrs']['data']['intro'] : null;
                                break;
                            }
                        }
                        ?>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            }
        ?>
        </div>
    </div>
</section>