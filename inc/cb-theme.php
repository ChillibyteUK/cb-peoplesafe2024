<?php
defined('ABSPATH') || exit;

require_once get_theme_file_path('inc/class-bs-collapse-navwalker.php');

require_once CB_THEME_DIR . '/inc/cb-utility.php';
require_once CB_THEME_DIR . '/inc/cb-blocks.php';
require_once CB_THEME_DIR . '/inc/cb-blog.php';
require_once CB_THEME_DIR . '/inc/cb-woocommerce.php';
require_once CB_THEME_DIR . '/inc/cb-careers.php';


add_filter('use_block_editor_for_post', '__return_true');

add_filter('acf/settings/default_mode', function() {
    return 'edit';
});



// rename posts to blog
function change_post_label()
{
    global $menu;
    global $submenu;
    $menu[5][0] = 'Blog Posts';
    $submenu['edit.php'][5][0] = 'Blog Posts';
    $submenu['edit.php'][10][0] = 'Add Blog';
    $submenu['edit.php'][16][0] = 'Blog Tags';
}
function change_post_object()
{
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Blog Posts';
    $labels->singular_name = 'Blog Post';
    $labels->add_new = 'Add Blog';
    $labels->add_new_item = 'Add Blog';
    $labels->edit_item = 'Edit Blog';
    $labels->new_item = 'Blog';
    $labels->view_item = 'View Blog';
    $labels->search_items = 'Search Blog';
    $labels->not_found = 'No Blog found';
    $labels->not_found_in_trash = 'No Blog found in Trash';
    $labels->all_items = 'All Blog';
    $labels->menu_name = 'Blog';
    $labels->name_admin_bar = 'Blog';
}
 
add_action('admin_menu', 'change_post_label');
add_action('init', 'change_post_object');



if (function_exists('acf_add_options_page')) {
    acf_add_options_page(
        array(
            'page_title' 	=> 'Site-Wide Settings',
            'menu_title'	=> 'Site-Wide Settings',
            'menu_slug' 	=> 'theme-general-settings',
            'capability'	=> 'edit_posts',
        )
    );
}

function widgets_init()
{
  
    register_nav_menus(array(
        'primary_nav' => __('Primary Nav', 'cb-peoplesafe2024'),
        'footer_menu1' => __('Footer Products', 'cb-peoplesafe2024'),
        'footer_menu2' => __('Footer Resources', 'cb-peoplesafe2024'),
        'footer-1' => __('Footer Col 1', 'cb-peoplesafe2024'),
        'footer-2' => __('Footer Col 2', 'cb-peoplesafe2024'),
        'footer-3' => __('Footer Col 3', 'cb-peoplesafe2024'),
    ));
 
    unregister_sidebar('hero');
    unregister_sidebar('herocanvas');
    unregister_sidebar('statichero');
    unregister_sidebar('left-sidebar');
    unregister_sidebar('right-sidebar');
    unregister_sidebar('footerfull');
    unregister_nav_menu('primary');
 
    add_theme_support('disable-custom-colors');
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name'  => 'Black',
                'slug'  => 'black',
                'color' => '#0f0f0f',
            ),
            array(
                'name'  => 'White',
                'slug'  => 'white',
                'color' => '#ffffff',
            ),
            array(
                'name'  => 'Grey 200',
                'slug'  => 'grey-200',
                'color' => '#f4f7f7',
            ),
            array(
                'name'  => 'Grey 400',
                'slug'  => 'grey-400',
                'color' => '#e8eeee',
            ),
            array(
                'name'  => 'Green',
                'slug'  => 'green-400',
                'color' => '#003a42',
            ),
            array(
                'name'  => 'Orange',
                'slug'  => 'orange-400',
                'color' => '#ff6a42',
            ),
            array(
                'name' => 'Blue',
                'slug' => 'blue-400',
                'color' => '#0484A0',
            )
        )
    );
}
add_action('widgets_init', 'widgets_init', 11);


remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');


//Custom Dashboard Widget
add_action('wp_dashboard_setup', 'register_cb_dashboard_widget');
function register_cb_dashboard_widget()
{
    wp_add_dashboard_widget(
        'cb_dashboard_widget',
        'Chillibyte',
        'cb_dashboard_widget_display'
    );
}

function cb_dashboard_widget_display()
{
    ?>
<div style="display: flex; align-items: center; justify-content: space-around;">
    <img style="width: 50%;"
        src="<?= get_stylesheet_directory_uri().'/img/cb-full.jpg'; ?>">
    <a class="button button-primary" target="_blank" rel="noopener nofollow noreferrer"
        href="mailto:hello@www.chillibyte.co.uk/">Contact</a>
</div>
<div>
    <p><strong>Thanks for choosing Chillibyte!</strong></p>
    <hr>
    <p>Got a problem with your site, or want to make some changes & need us to take a look for you?</p>
    <p>Use the link above to get in touch and we'll get back to you ASAP.</p>
</div>
<?php
}



function archive_limit($query)
{
    if ($query->is_archive() && $query->is_main_query() && !is_admin()) {
        $query->set('posts_per_page', 100);
    }
}
add_action('pre_get_posts', 'archive_limit');

add_filter('wpseo_breadcrumb_links', 'override_yoast_breadcrumb_trail_stories');

function override_yoast_breadcrumb_trail_stories($links)
{
    global $post;

    if (is_tax('incidents')) {
        $breadcrumb[] = array(
            'url' => '/stories/',
            'text' => 'Stories',
        );
        array_splice($links, 1, -2, $breadcrumb);
    }

    if (is_singular('careers')) {
        $breadcrumb[] = array(
            'url' => '/careers/',
            'text' => 'Careers',
        );
        array_splice($links, 1, -2, $breadcrumb);
    }

    if (is_singular(array('news','guides', 'post', 'whitepapers', 'legislation'))) {
        $breadcrumb[] = array(
            'url' => '/resources/',
            'text' => 'Knowledge Hub',
        );
        array_splice($links, 1, -2, $breadcrumb);
    }

    if (is_archive(array('news','guides', 'post', 'whitepapers', 'legislation'))) {
        $breadcrumb[] = array(
            'url' => '/resources/',
            'text' => 'Knowledge Hub',
        );
        array_splice($links, 1, -2, $breadcrumb);
    }

    return $links;
}


// exclude stories from search

function search_filter($query)
{
    if (! is_admin() && $query->is_main_query()) {
        if ($query->is_search) {
            $post_types = get_post_types(array(), 'names');
            $exclude = array(
                'attachment',
                'revision',
                'nav_menu_item',
                'acf-field',
                'acf-field-group',
                'stories',
                'brochures',
                'wp_block',
                'wp_global_styles',
                'cookielawinfo'
            );
            $include = array_diff($post_types, $exclude);
            $query->set('post_type', $include);
        }
    }
}
add_action('pre_get_posts', 'search_filter');

// demo button on mobile menu
add_filter('wp_nav_menu_items', 'add_demo_button', 10, 2);
function add_demo_button($items, $args)
{
    if ($args->theme_location == 'primary_nav') {
        $items .= '<a href="/shop/" class="d-lg-none btn btn-primary mt-2 mx-3"><strong>Buy Now</strong></a>';
        // $items .= '<button type="button" class="d-lg-none btn btn-primary mt-2 mx-3" data-bs-toggle="modal" data-bs-target="#demoModal">Book a Demo</button>';
    }
    return $items;
}


// function wpse_modify_category_query( $query ) {
//     if ( ! is_admin() && $query->is_main_query() ) {
//         if ( $query->is_category() ) {
//             $query->set( 'posts_per_page', 2 );
//         }
//     }
// }
// add_action( 'pre_get_posts', 'wpse_modify_category_query' );

add_action('pre_get_posts', function ($q) {
    if (!is_admin() // Only target the front end queries
         && $q->is_main_query() // Targets the main query only
         && $q->is_category() // Only target category pages
    ) {
        $q->set('posts_per_page', 10);
        $q->set('ignore_sticky_posts', 1);
    }
});


function cb_theme_enqueue()
{
    $the_theme = wp_get_theme();
    // wp_enqueue_style('lightbox-stylesheet', get_stylesheet_directory_uri() . '/css/lightbox.min.css', array(), $the_theme->get('Version'));
    // wp_enqueue_script('lightbox-scripts', get_stylesheet_directory_uri() . '/js/lightbox-plus-jquery.min.js', array(), $the_theme->get('Version'), true);
    // wp_enqueue_script('lightbox-scripts', get_stylesheet_directory_uri() . '/js/lightbox.min.js', array(), $the_theme->get('Version'), true);
    // wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js', array(), null, true);
 
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js', array(), null, true);
    wp_enqueue_style('slick-styles', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css', array(), true);
    wp_enqueue_style('slick-theme-styles', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css', array(), true);
    wp_enqueue_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array(), null, true);
    wp_enqueue_style('aos-style', "https://unpkg.com/aos@2.3.1/dist/aos.css", array());
    wp_enqueue_script('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), null, true);

    wp_enqueue_style('swiper-style', "https://unpkg.com/swiper/swiper-bundle.min.css", array());
    wp_enqueue_script('swiper', "https://unpkg.com/swiper/swiper-bundle.min.js", array(), null, true);


    //  wp_enqueue_style('glightbox-stylesheet', get_stylesheet_directory_uri() . '/css/glightbox.min.css', array(), $the_theme->get('Version'));
    //  wp_enqueue_script('glightbox-scripts', get_stylesheet_directory_uri() . '/js/glightbox.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'cb_theme_enqueue');



function other_videos($id)
{

    ob_start();

    $q = new WP_Query(array(
        'post_type' => 'video',
        'posts_per_page' => 3,
        'post__not_in' => array($id)
    ));

    ?>
<style>
    .h2__container::before {
        content: '';
        position: absolute;
        height: 1px;
        background: #ffa823;
        left: 16px;
        right: 0;
        top: 24px;
    }

    .h2__container {
        position: relative;
        display: flex;
        justify-content: space-between;
    }

    .h2__link {
        font-size: 0.8rem;
        margin-top: 0.9rem;
        background-color: white;
        z-index: 99;
        padding-left: 0.5rem;
    }

    .h2__link::after {
        content: " >";
    }

    .h2__link a {
        color: #0a0f1c;
        font-weight: 600;
    }

    .h2__container h2 {
        position: relative;
        background-color: #fff;
        display: inline-block;
        padding-right: 0.5rem;
    }
</style>
<div class="recent_news">
    <div class="h2__container mb-2">
        <h2>Other videos</h2>
        <div class="h2__link"><a href="/video/" class="noline">View all</a></div>
    </div>
    <div class="row">
        <?php
    while ($q->have_posts()) {
        $q->the_post();
        $img = get_vimeo_data_from_id(get_field('vimeo_id'), 'thumbnail_url') ?: get_stylesheet_directory_uri() . '/img/ps-logo-placeholder.png';
        ?>
        <div class="col-md-4 mb-4 mb-lg-0">
            <div class="guide">
                <a href="<?=get_the_permalink(get_the_ID())?>">
                    <div class="guide__image">
                        <img src="<?=$img?>">
                    </div>
                    <div class="guide__inner">
                        <div class="guide__title">
                            <?=get_the_title(get_the_ID())?></div>
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

    return ob_get_clean();

}


// Remove unwanted SVG filter injection WP
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');


// Remove comment-reply.min.js from footer
function remove_comment_reply_header_hook()
{
    wp_deregister_script('comment-reply');
}
add_action('init', 'remove_comment_reply_header_hook');

add_action('admin_menu', 'remove_comments_menu');
function remove_comments_menu()
{
    remove_menu_page('edit-comments.php');
}

add_filter('theme_page_templates', 'child_theme_remove_page_template');
function child_theme_remove_page_template($page_templates)
{
    // unset($page_templates['page-templates/blank.php'],$page_templates['page-templates/empty.php'], $page_templates['page-templates/fullwidthpage.php'], $page_templates['page-templates/left-sidebarpage.php'], $page_templates['page-templates/right-sidebarpage.php'], $page_templates['page-templates/both-sidebarspage.php']);
    unset($page_templates['page-templates/blank.php'],$page_templates['page-templates/empty.php'], $page_templates['page-templates/left-sidebarpage.php'], $page_templates['page-templates/right-sidebarpage.php'], $page_templates['page-templates/both-sidebarspage.php']);
    return $page_templates;
}
add_action('after_setup_theme', 'remove_understrap_post_formats', 11);
function remove_understrap_post_formats()
{
    remove_theme_support('post-formats', array( 'aside', 'image', 'video' , 'quote' , 'link' ));
}
?>