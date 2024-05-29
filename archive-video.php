<?php
/**
 * The main template file
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>
<style>
.guide__image {
    width: 100%;
    aspect-ratio: 16 / 9;
    background-size: cover;
    background-position: center;
    position: relative;
}

.guide__image .vid_duration {
    position: absolute;
    bottom: 0.5rem;
    right: 0.5rem;
    background-color: rgba(0,0,0,0.8);
    color: white;
    font-weight: bold;
    font-size: 0.889rem;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
}

.guide__image .play {
    position: absolute;
    z-index: 10;
    display: flex;
    justify-content: center;
    align-items: center;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
    font-size: 3rem;
    transition: all 0.3s ease;
}
.guide__image .play img {
    width:60px;
    height:60px;
    opacity: 0.8;
}

@media (min-width:768px) {
    .guide__image {
        min-height: 120px;
    }
}
@media (min-width:1240px) {
    .guide__image {
        min-height: 199px;
    }
}
</style>
<main id="main" class="pt-5">
    <div class="container py-3">
        <div class="page-meta">
            <h1>Videos</h1>
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>
        <div class="filters mb-4">
            <?php
            $cats = get_terms(array(
                'taxonomy' => 'video_category',
                'hide_empty' => true,
                'order' => 'DESC'
            ));
            ?>
            <select class="filters-select form-control">
                <option value="" disabled selected>Filter by category</option>
                <option value="*">Show all videos</option>
                <?php
                foreach ($cats as $cat) {
                    echo '<option value=".' . acf_slugify($cat->name) . '">' . $cat->name . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="row w-100 mb-4 mx-0" id="grid">
            <?php
            while (have_posts()) {
                the_post();
                
				if (get_field('hide_from_video_library')[0] == 'Yes') {
					continue;
				}
				echo '<!--';
				cbdump(get_field('hide_from_video_library'));
				echo '-->';
				
                $img = get_vimeo_data_from_id(get_field('vimeo_id'), 'thumbnail_url') ?: get_stylesheet_directory_uri() . '/img/ps-logo-placeholder.png';
                // if (!$img) {
                //     $img = catch_that_image($post);
                // }

                $duration = intval(get_vimeo_data_from_id(get_field('vimeo_id'),'duration'));

//                $duration = sprintf('%02d:%02d', ($duration/60%60), $duration%60);
                $hours = floor($duration / 3600);
                $minutes = floor(($duration / 60) % 60);
                $seconds = $duration % 60;
				if ($hours > 0) {
                	$duration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
				}
				else {
					$duration = sprintf('%02d:%02d', $minutes, $seconds);
				}
				
                $cats = get_the_terms(get_the_ID(), 'video_category');
                $category = wp_list_pluck($cats, 'slug');
                $catclass = implode(' ', $category );

                ?>
                <div class="grid_item col-md-6 col-lg-4 mb-4 pt-2 pb-2 <?=$catclass?>">
                    <div class="guide">
                        <a href="<?=get_the_permalink()?>">
                            <div class="guide__image" style="background-image:url(<?=$img?>)">
                                <div class="play">
                                    <img src="<?=get_stylesheet_directory_uri()?>/img/play-button.svg">
                                </div>
                                <div class="vid_duration"><?=$duration?></div>
                            </div>
                            <div class="guide__inner">
                                <div class="guide__title"><?=get_the_title()?></div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
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
</main>
<?php
add_action('wp_footer',function(){
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" integrity="sha512-Zq2BOxyhvnRFXu0+WE6ojpZLOU2jdnqbrM1hmVdGzyeCa1DgM3X5Q4A/Is9xA1IkbUeDd7755dNNI/PzSf2Pew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    (function($){

        var selectFilter;

        var $grid = $('#grid').isotope({
            itemSelector:'.grid_item',
            percentPosition: true,
            layoutMode: 'fitRows',
            filter: function(){
                var $this = $(this);
                var selectResult = selectFilter ? $this.is( selectFilter ) : true;
                return selectResult;
            }
        });

        $('.filters-select').on( 'change', function() {
            selectFilter = this.value;
            $grid.isotope();
        });
    
    
    })(jQuery);
    </script>
        <?php
    },9999);
get_footer();
