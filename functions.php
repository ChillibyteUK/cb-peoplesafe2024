<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('CB_THEME_DIR', WP_CONTENT_DIR . '/themes/cb-peoplesafe2024');

require_once CB_THEME_DIR . '/inc/cb-theme.php';


function understrap_remove_scripts()
{
    wp_dequeue_style('understrap-styles');
    wp_deregister_style('understrap-styles');

    wp_dequeue_script('understrap-scripts');
    wp_deregister_script('understrap-scripts');

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action('wp_enqueue_scripts', 'understrap_remove_scripts', 20);

/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles()
{

    // Get the theme data.
    $the_theme     = wp_get_theme();
    $theme_version = $the_theme->get('Version');

    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    // Grab asset urls.
    $theme_styles  = "/css/child-theme{$suffix}.css";
    $theme_scripts = "/js/child-theme{$suffix}.js";
    
    $css_version = $theme_version . '.' . filemtime(get_stylesheet_directory() . $theme_styles);

    wp_enqueue_style('child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), time()); //$css_version );
    wp_enqueue_style('woocommerce-styles', get_stylesheet_directory_uri() . '/css/woocommerce.css', array(), time());
    wp_enqueue_script('jquery');
    
    $js_version = $theme_version . '.' . filemtime(get_stylesheet_directory() . $theme_scripts);
    
    wp_enqueue_script('child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $js_version, true);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');


function add_child_theme_textdomain()
{
    load_child_theme_textdomain('cb-peoplesafe2024', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'add_child_theme_textdomain');

function kill_theme($themes)
{
    unset($themes['understrap']);
    return $themes;
}
add_filter('wp_prepare_themes_for_js', 'kill_theme');



add_action('wp_dashboard_setup', 'remove_draft_widget', 999);
function remove_draft_widget()
{
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
}

//Remove from +New Post in Admin Bar
// add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );

// function remove_default_post_type_menu_bar( $wp_admin_bar ) {
//     $wp_admin_bar->remove_node( 'new-post' );
// }

//Remove from the Side Menu
// add_action( 'admin_menu', 'remove_default_post_type' );

// function remove_default_post_type() {
//     remove_menu_page( 'edit.php' );
// }

function pardot_head_script() {
    ?>
    <script>
        function getParamFromParentURL(p) {
            var match = RegExp('[?&]' + p + '=([^&]*)').exec(window.location.search);
            return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
        }

        function passGclidToAllPardotIframes() {
            var gclidParam = getParamFromParentURL('gclid');
            var gclsrcParam = getParamFromParentURL('gclsrc');

            if (!gclidParam) {
                console.log('No GCLID parameter found in parent URL. Skipping iframe updates.');
                return; // Exit if no GCLID to pass
            }

            // Get all iframe elements on the page
            var iframes = document.querySelectorAll('iframe');
            var pardotDomainPrefix = 'https://safe.peoplesafe.co.uk/l/'; // Adjust if you use go.pardot.com or other subdomains

            iframes.forEach(function(iframe) {
                var iframeSrc = iframe.src;

                // Check if the iframe's src starts with the Pardot form URL prefix
                if (iframeSrc.startsWith(pardotDomainPrefix)) {
                    var separator = iframeSrc.indexOf('?') === -1 ? '?' : '&';
                    var newIframeSrc = iframeSrc;

                    // Only append if GCLID is not already present to avoid duplicates
                    if (iframeSrc.indexOf('gclid=') === -1) {
                        newIframeSrc += separator + 'gclid=' + encodeURIComponent(gclidParam);
                        separator = '&'; // For subsequent parameters
                    }
                    
                    // Only append gclsrc if not already present
                    if (gclsrcParam && iframeSrc.indexOf('gclsrc=') === -1) {
                        newIframeSrc += separator + 'gclsrc=' + encodeURIComponent(gclsrcParam);
                    }

                    if (newIframeSrc !== iframeSrc) { // Only update if it actually changed
                        iframe.src = newIframeSrc;
                        console.log('Pardot iframe src updated:', iframe.src);
                    } else {
                        console.log('Pardot iframe already contains GCLID or no GCLID to update.');
                    }
                }
            });
        }

        // Run this function when the parent page has loaded
        window.addEventListener('load', passGclidToAllPardotIframes);
        // You might also consider 'DOMContentLoaded' if the iframe is present early in the HTML
        // and you want to modify its src as early as possible before it fully loads.
        // document.addEventListener('DOMContentLoaded', passGclidToAllPardotIframes);
    </script>
    <?php
}
add_action('wp_head', 'pardot_head_script');