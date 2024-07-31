<?php
/**
 * The main template file
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$menu = get_field('projects_sidebar_menu','options');
$delay = 1;
?>
<main id="main" class="pt-5">
    <div class="container py-3">
        <div class="page-meta">
            <h1>Blogs</h1>
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>

        <div class="catnav d-flex flex-wrap mb-4">
            <select id="cat" class="form-control w-lg-50">
        <?php
        $cats = get_categories();
        echo '<option value="/blogs/">All</option>';
        foreach ($cats as $cat) {
            if ($cat->cat_name == 'Uncategorised') {
                continue;
            }
            echo '<option value="' . get_category_link($cat) . '">' . $cat->cat_name . '</option>';
        }
        ?>
            </select>
        </div>

        <div id="blogs" class="w-100">
            <?php
            $counter = 1;
            while (have_posts()) {
                the_post();
                $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                if (!$img) {
                    $img = catch_that_image($post);
                }
                $cats = get_the_category();
                $category = wp_list_pluck($cats, 'name');
                $category = implode(', ',$category);
                ?>
                <div class="blog-item mb-4 pt-2 pb-4">
                    <div class="row">
                        <div class="col-md-2 news__image"><img src="<?=$img?>" class="img-fluid"></div>
                        <div class="col-md-10 news__inner">
                            <div class="news__title"><a href="<?=get_the_permalink()?>"><?=get_the_title()?></a></div>
                            <div class="news__date"><?=get_the_date('j M, Y')?> | <?=$category?></div>
                            <div class="news__intro"><?=wp_trim_words(get_the_content(),30)?></div>
                            <div class="news__link"><a href="<?=get_the_permalink()?>">Read More</a></div>
                        </div>
                    </div>
                </div>
                <?php
if ( $counter == 3 ) {
    echo do_shortcode("[subscribe_banner]");
}

            $counter++;
            }
            ?>
        </div>
        <!-- <div class="scroller-status">
            <div class="loader-ellips infinite-scroll-request">
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
            </div>
        </div> -->
        <?=numeric_posts_nav()?>

        <!-- <nav class="pagination">
            <div class="prev-posts-link alignright"><?php echo get_next_posts_link('Older Entries', $posts->max_num_pages); ?></div>
            <div class="next-posts-link alignleft"><?php echo get_previous_posts_link('Newer Entries'); ?></div>
        </nav> -->
    </div>
</section>
<!-- text_imagebg -->
<section class="gradient_cta py-5 bg_grad--orange">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img src="https://peoplesafe.co.uk/wp-content/uploads/2020/08/Lone-worker-policy-template.png" class="img-fluid">
            </div>
            <div class="col-lg-6">
                <h2 class="mb-4">Download our Lone Worker Policy template</h2>
                <a href="/guides/lone-working-policy-template/" class="btn">Find out more</a>
            </div>
        </div>
    </div>
</section>
</main>
<?php

add_action('wp_footer',function(){
    ?>
<script>
(function($){
    $('#cat').on('change',function(){
        var page = $(this).val();
        if (page) {
            console.log(page);
            window.location = page;
        }
        return false;
    })
})(jQuery);
</script>
    <?php
},9999);

get_footer();
