<?php
/**
 * The main template file
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
//global $wp_query;

get_header();
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
        <div class="catnav d-flex flex-wrap  mb-4">
            <select id="cat" class="form-control w-lg-50">
        <?php
        $cats = get_categories();
        $curr = get_category(get_query_var('cat'));

        echo '<option value="/blogs/">All</option>';

        foreach ($cats as $cat) {
            if ($cat->cat_name == 'Uncategorised') {
                continue;
            }
            $selected = $cat->cat_name == $curr->name ? 'selected' : '';
            echo '<option value="' . get_category_link($cat) . '" ' . $selected . '>' . $cat->cat_name . '</option>';

            $class = $cat->cat_name == $curr->name ? 'btn-primary' : 'btn-secondary';

        }
        ?>
            </select>
        </div>
        <div id="blogs" class="w-100">
            <?php
            // $default_posts_per_page = get_option( 'posts_per_page' );
            // $default_posts_per_page = 2;

            // $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            // $paged = get_query_var( 'paged' );
            // echo '<pre>paged: ' . $paged . '</pre>';

            $category     = $curr->name;

            // // $wp_query->query('showposts='.$default_posts_per_page.'&post_type=post&paged='.$paged.'&cat='.$cat_id);

            // $wp_query = new WP_Query(
            //     array(
            //         'post_type'=>'post',
            //         'posts_per_page'=>$default_posts_per_page,
            //         'orderby'=>'date',
            //         'paged'=>$paged,
            //         'category_name' => $category
            //     )
            // );
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
            }
            wp_reset_postdata();
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

        <!-- nav class="pagination">
            <div class="prev-posts-link alignright"><?php echo get_next_posts_link('Older Entries', $wp_query->max_num_pages); ?></div>
            <div class="next-posts-link alignleft"><?php echo get_previous_posts_link('Newer Entries'); ?></div>
        </nav -->
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
