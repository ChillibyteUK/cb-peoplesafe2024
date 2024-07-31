<?php



function cb_post_nav()
{
        ?>
        <div class="d-flex justify-content-between">
        <?php
        $prev_post_obj = get_adjacent_post( '', '', true );
        if ($prev_post_obj) {
            $prev_post_ID   = isset( $prev_post_obj->ID ) ? $prev_post_obj->ID : '';
            $prev_post_link     = get_permalink( $prev_post_ID );
            ?>
        <a href="<?php echo $prev_post_link; ?>" rel="next" class="btn btn-previous">Previous</a>
           <?php
        }

        $next_post_obj  = get_adjacent_post( '', '', false );
        if ($next_post_obj) {
            $next_post_ID   = isset( $next_post_obj->ID ) ? $next_post_obj->ID : '';
            $next_post_link     = get_permalink( $next_post_ID );
            ?>
        <a href="<?php echo $next_post_link; ?>" rel="next" class="btn btn-next">Next</a>
           <?php
        }
        ?>
        </div>
        <?php

}


function catch_that_image($post) {
    ob_start();
    ob_end_clean();
    preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = '';
    if (!empty($matches[1])) {
        $first_img = $matches[1][0];
    }
    if(empty($first_img)){ //Defines a default image
      $first_img = "/wp-content/themes/cb-peoplesafe2024/img/ps-logo-placeholder.png";
    }
    return $first_img;
  }

function numeric_posts_nav() {
 
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="navigation"><ul>' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );
 
    echo '</ul></div>' . "\n";
 
}



function recent_posts($post)
{
    ob_start();

    $q = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'post__not_in' => array( $post )
    ));

    if ($q->have_posts()) {
        ?>
        <div class="recent_news">
            <div class="row">
            <?php
            while ($q->have_posts()) {
                $q->the_post();
                $img = get_the_post_thumbnail_url( $q->ID, 'large' );
                if (!$img) {
                    $img = catch_that_image(get_post($q->ID));
                }
                ?>
                <div class="col-12 col-md-4 col-lg-12 mb-4">
                    <div class="news__item">
                        <a href="<?=get_the_permalink()?>">
                            <div class="news__image"><img src="<?=$img?>"></div>
                            <div class="news__inner">
                                <div class="news__date"><?=get_the_date()?></div>
                                <div class="news__title"><?=get_the_title()?></div>
                                <div class="news__link">Read More</div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
        </div>
        <?php
    }

    wp_reset_postdata();
    $ob_str = ob_get_contents();
    ob_end_clean();
    return $ob_str;
}


function related_posts() {

    ob_start();

    $post_id = get_the_ID();
    $cat_ids = array();
    $categories = get_the_category( $post_id );

    if(!empty($categories) && !is_wp_error($categories)):
        foreach ($categories as $category):
            array_push($cat_ids, $category->term_id);
        endforeach;
    endif;

    $current_post_type = get_post_type($post_id);

    $excluded = get_field('hidden_posts','options');

    $excluded[] = $post_id;

    $query_args = array( 
        'category__in'   => $cat_ids,
        'post_type'      => $current_post_type,
        'post__not_in'    => $excluded,
        'posts_per_page'  => '3',
    );
 

    $related_cats_post = new WP_Query( $query_args );

    if ($related_cats_post->have_posts()) {
        ?>
        <hr class="my-4">
        <div class="recent_news">
            <div class="h3 mb-4">Related Posts</div>
            <div class="row">
            <?php
            while ($related_cats_post->have_posts()){
                $related_cats_post->the_post();
                $img = get_the_post_thumbnail_url( $related_cats_post->ID, 'large' );
                if (!$img) {
                    $img = catch_that_image(get_post($related_cats_post->ID));
                }
                ?>
                <div class="col-md-4">
                    <div class="news__item">
                        <a href="<?=get_the_permalink()?>">
                            <div class="news__image"><img src="<?=$img?>"></div>
                            <div class="news__inner">
                                <div class="news__date"><?=get_the_date()?></div>
                                <div class="news__title"><?=get_the_title()?></div>
                                <div class="news__link">Read More</div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>
            </div>
        </div>
        <?php
    }

     wp_reset_postdata();
     $ob_str = ob_get_contents();
     ob_end_clean();
     return $ob_str;

}

function related_posts_by_cat($cat_id) {

    ob_start();

    $excluded = get_field('hidden_posts','options');

    $query_args = array( 
        'category__in'   => $cat_id,
        'post_type'      => 'post',
        'posts_per_page'  => '3',
        'post__not_in'    => $excluded,
     );

    $related_cats_post = new WP_Query( $query_args );

    if ($related_cats_post->have_posts()) {
        ?>
        <div class="recent_news">
            <div class="h2 mb-4">Related Posts</div>
            <div class="row">
            <?php
            while ($related_cats_post->have_posts()){
                $related_cats_post->the_post(); 
                ?>
                <div class="col-md-4 mb-4 mb-lg-0">
                    <div class="news__item">
                        <a href="<?=get_the_permalink()?>">
                            <div class="news__image" style="background-image:url('<?=get_the_post_thumbnail_url(get_the_ID(), 'medium')?>"></div>
                            <div class="news__inner">
                                <div class="news__date"><?=get_the_date()?></div>
                                <div class="news__title"><?=get_the_title()?></div>
                                <div class="news__link">Read More</div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>
            </div>
        </div>
        <?php
    }

     wp_reset_postdata();
     $ob_str = ob_get_contents();
     ob_end_clean();
     return $ob_str;

}

function latest_posts()
{
    ob_start();

    $excluded = get_field('hidden_posts','options');

    $q = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'post__not_in'    => $excluded,
    ));

    if ($q->have_posts()) {
        echo '<div class="h2 mb-4">Latest Posts</div>';
        echo '<div class="row">';
        while ($q->have_posts()) {
            $q->the_post(); ?>
            <div class="col-12 col-md-4 mb-4">
                <div class="recent">
                    <a href="<?=get_the_permalink(get_the_ID())?>">
                        <div class="recent__image" style="background-image:url('<?=get_the_post_thumbnail_url(get_the_ID(), 'medium')?>"></div>
                        <div class="recent__card">
                            <div class="recent__title"><?=get_the_title()?></div>
                            <div class="recent__date"><?=get_the_date()?></div>
                        </div>
                    </a>
                </div>
            </div>
            <?php
        }
        echo '</div>';
    }

    wp_reset_postdata();
    $ob_str = ob_get_contents();
    ob_end_clean();
    return $ob_str;
}


// exclude recent projects from tips-trends (index.php) view
// function exclude_category( $query ) {
//     if ( $query->is_home() && $query->is_main_query() ) {
//        $query->set( 'cat', '-5' );
//     }
// }
// add_action( 'pre_get_posts', 'exclude_category' );


function recent_projects() {
    ob_start();

    $excluded = get_field('hidden_posts','options');

    $p = new WP_Query(array(
        'post_type' => 'projects',
        'post_status' => 'publish',
        'post__not_in'    => $excluded,
    ));
    ?>
            <div id="blogs" class="w-100">
                <?php
                while ($p->have_posts()) {
                    $p->the_post();
                    $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                    if (!$img) {
                        $img = catch_that_image($p);
                    }
                    // $cats = get_the_category();
                    // $category = $cats[0]->name;
                    ?>
                    <div class="blog-item mb-4 pt-2 pb-4">
                        <div class="row">
                            <div class="col-md-2 news__image"><img src="<?=$img?>" class="img-fluid"></div>
                            <div class="col-md-10 news__inner">
                                <div class="news__title"><a href="<?=get_the_permalink()?>"><?=get_the_title()?></a></div>
                                <div class="news__date"><?=get_the_date('j M, Y')?></div>
                                <div class="news__intro"><?=wp_trim_words(get_the_content(),30)?></div>
                                <div class="news__link"><a href="<?=get_the_permalink()?>">Read More</a></div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?=numeric_posts_nav()?>
            </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('recent-projects','recent_projects');


// 3 latest projects, displayed on inspiration hub
function latest_projects() {
    ob_start();

    $excluded = get_field('hidden_posts','options');

    $p = new WP_Query(array(
        'post_type' => 'projects',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'post__not_in'    => $excluded,
    ));
    ?>
            <div class="row mb-4">
                <?php
                while ($p->have_posts()) {
                    $p->the_post();
                    $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                    if (!$img) {
                        $img = catch_that_image($p);
                    }
                    // $cats = get_the_category();
                    // $category = $cats[0]->name;
                    ?>
                    <div class="col-md-4 recent_project">
                        <a href="<?=get_the_permalink()?>">
                            <img src="<?=$img?>" class="img-fluid">
                            <div class="project__title"><?=get_the_title()?></div>
                            <div class="project__link">Read More +</div>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="text-center">
                <a href="/inspiration/recent-projects" class="btn btn-primary">See More Projects</a>
            </div>
            <hr>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('latest-projects','latest_projects');


// 3 latest posts, displayed on inspiration hub
function latest_tips() {
    ob_start();

    $excluded = get_field('hidden_posts','options');

    $p = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'post__not_in'    => $excluded,
    ));
    ?>
            <div class="row mb-4">
                <?php
                while ($p->have_posts()) {
                    $p->the_post();
                    $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                    if (!$img) {
                        $img = catch_that_image($p);
                    }
                    // $cats = get_the_category();
                    // $category = $cats[0]->name;
                    ?>
                    <div class="col-md-4 recent_project">
                        <a href="<?=get_the_permalink()?>">
                            <img src="<?=$img?>" class="img-fluid">
                            <div class="project__title"><?=get_the_title()?></div>
                            <div class="project__link">Read More +</div>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="text-center">
                <a href="/blog" class="btn btn-primary">Get Inspired</a>
            </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('latest-tips','latest_tips');


// hide hidden posts from main query
function cb_search_filter( $query ) {
    if ( $query->is_main_query() && !is_admin() && !is_single() && !is_post_type_archive() ) {
        $query->set( 'post__not_in', get_field('hidden_posts','options') );
    }
    return $query;
}
add_filter( 'pre_get_posts', 'cb_search_filter' );

// hide hidden posts from prev/next buttons
add_filter( 'get_previous_post_where', 'cb_mod_adjacent' );
add_filter( 'get_next_post_where', 'cb_mod_adjacent' );
function cb_mod_adjacent( $where ) {
    return $where . ' AND p.ID NOT IN (' . implode( ',', get_field('hidden_posts','options') ) . ' )';
}

// no-index hidden posts
add_filter( 'wpseo_robots', 'yoast_seo_robots_remove_by_id' );
function yoast_seo_robots_remove_by_id( $robots ) {
    $pages = get_field('hidden_posts','options');
	if ( is_page( $pages ) || is_single( $pages )) { 
		return 'noindex,nofollow'; 
	}
	return $robots; 
}

// Remove tags support from posts
function cb_unregister_tags() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'cb_unregister_tags');

// remove comments column from posts index
function cb_remove_posts_columns( $columns ) {
    unset( $columns['comments'] );
    return $columns;
}
add_filter( 'manage_posts_columns',  'cb_remove_posts_columns', 10, 2 );
