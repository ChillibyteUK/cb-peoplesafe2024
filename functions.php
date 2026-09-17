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

        // Tracking parameters to forward from the parent page URL into the Pardot iframes.
        var pardotTrackingParams = [
            'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term',
            'gclid', 'gclsrc'
        ];

        function passTrackingParamsToAllPardotIframes() {
            // Collect whichever tracking params are actually present in the parent URL.
            var paramsToPass = [];
            pardotTrackingParams.forEach(function(key) {
                var value = getParamFromParentURL(key);
                if (value) {
                    paramsToPass.push({ key: key, value: value });
                }
            });

            if (paramsToPass.length === 0) {
                console.log('No tracking parameters found in parent URL. Skipping iframe updates.');
                return; // Nothing to forward
            }

            // Get all iframe elements on the page
            var iframes = document.querySelectorAll('iframe');
            // Match Pardot form iframes by their account path, not the hostname, so this
            // works on live (safe.peoplesafe.co.uk) and on the rewritten staging domain,
            // and survives any future change of the Pardot tracker subdomain.
            var pardotFormPath = '/l/830213/'; // 830213 = Peoplesafe Pardot account ID

            iframes.forEach(function(iframe) {
                var iframeSrc = iframe.src;

                // Only touch Pardot form iframes for this account.
                if (iframeSrc.indexOf(pardotFormPath) === -1) {
                    return;
                }

                var newIframeSrc = iframeSrc;

                paramsToPass.forEach(function(param) {
                    // Only append if this param is not already present, to avoid duplicates
                    // (e.g. the #myiframe footer form is decorated separately).
                    if (newIframeSrc.indexOf(param.key + '=') === -1) {
                        var separator = newIframeSrc.indexOf('?') === -1 ? '?' : '&';
                        newIframeSrc += separator + param.key + '=' + encodeURIComponent(param.value);
                    }
                });

                if (newIframeSrc !== iframeSrc) { // Only update if it actually changed
                    iframe.src = newIframeSrc;
                    console.log('Pardot iframe src updated:', iframe.src);
                } else {
                    console.log('Pardot iframe already contains the tracking parameters.');
                }
            });
        }

        // Run this function when the parent page has loaded
        window.addEventListener('load', passTrackingParamsToAllPardotIframes);
        // You might also consider 'DOMContentLoaded' if the iframe is present early in the HTML
        // and you want to modify its src as early as possible before it fully loads.
        // document.addEventListener('DOMContentLoaded', passTrackingParamsToAllPardotIframes);
    </script>
    <?php
}
add_action('wp_head', 'pardot_head_script');

add_action('woocommerce_thankyou', 'custom_push_purchase_data_to_datalayer', 10, 1);
function custom_push_purchase_data_to_datalayer($order_id) {
    if (!$order_id) return;

    $order = wc_get_order($order_id);
    if (!$order) return;

    $items = [];
    foreach ($order->get_items() as $item) {
        $product = $item->get_product();
        if (!$product) continue;

        $items[] = [
            'item_id'     => $product->get_sku() ?: $product->get_id(),
            'item_name'   => $product->get_name(),
            'item_category' => $product->get_type(), // or use category logic if needed
            'quantity'    => $item->get_quantity(),
            'price'       => wc_format_decimal($order->get_item_total($item, false), 2),
        ];
    }

    $payment_method = $order->get_payment_method_title();

    ?>
    <script>
      window.dataLayer = window.dataLayer || [];
      window.dataLayer.push({
        event: "purchase",
        ecommerce: {
          transaction_id: "<?php echo esc_js($order->get_order_number()); ?>",
          affiliation: "Peoplesafe WooCommerce Store",
          value: <?php echo esc_js($order->get_total()); ?>,
          currency: "<?php echo esc_js($order->get_currency()); ?>",
          tax: <?php echo esc_js($order->get_total_tax()); ?>,
          shipping: <?php echo esc_js($order->get_shipping_total()); ?>,
          payment_type: "<?php echo esc_js($payment_method); ?>",
          items: <?php echo json_encode($items); ?>
        }
      });
    </script>
    <?php
}

function video_facade_shortcode($atts) {
    $atts = shortcode_atts([
        'id' => '',
        'type' => 'youtube', // youtube or vimeo
        'aspect_ratio' => '16by9'
    ], $atts, 'video_facade');

    $id = sanitize_text_field($atts['id']);
    $type = sanitize_text_field(strtolower($atts['type']));
    $ratio_class = 'video-ratio video-ratio-' . esc_attr($atts['aspect_ratio']);

    if (!$id || !in_array($type, ['youtube', 'vimeo'])) return '';

    if ($type === 'youtube') {
        $thumb_url = "https://i.ytimg.com/vi/$id/hqdefault.jpg";
        $embed_url = "https://www.youtube.com/embed/$id?autoplay=1";
    } else {
        $thumb_url = "https://vumbnail.com/$id.jpg";
        $embed_url = "https://player.vimeo.com/video/$id?autoplay=1";
    }

    ob_start();
    ?>
    <div class="video-facade-wrapper <?php echo esc_attr($ratio_class); ?>"
         data-embed-url="<?php echo esc_url($embed_url); ?>"
         style="cursor:pointer;position:relative;background:#000;overflow:hidden;">
        <img src="<?php echo esc_url($thumb_url); ?>"
             alt="Video Thumbnail"
             style="width:100%;display:block;object-fit:cover;">
        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);color:white;font-size:3em;">▶</div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.video-facade-wrapper').forEach(wrapper => {
            wrapper.addEventListener('click', function () {
                const embedUrl = wrapper.getAttribute('data-embed-url');
                const iframe = document.createElement('iframe');
                iframe.setAttribute('src', embedUrl);
                iframe.setAttribute('frameborder', '0');
                iframe.setAttribute('allow', 'autoplay; fullscreen; picture-in-picture');
                iframe.setAttribute('allowfullscreen', '');
                iframe.style.width = '100%';
                iframe.style.height = '100%';
                wrapper.innerHTML = '';
                wrapper.appendChild(iframe);
            });
        });
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('video_facade', 'video_facade_shortcode');

add_shortcode('trustpilot_slider', function () {
    return '
    <section class="trustpilot-widget-holder py-0">
        <div class="container-xl">
            <div class="row g-4">
                <div class="col-12">
                    <div class="trustpilot-widget"
                        data-locale="en-GB"
                        data-template-id="54ad5defc6454f065c28af8b"
                        data-businessunit-id="60bf889cafe44a000151a439"
                        data-style-height="240px"
                        data-style-width="100%"
                        data-token="59d5c8ab-af42-4482-a081-2da101bfe5f8"
                        data-stars="5"
                        data-review-languages="en">
                        <a href="https://uk.trustpilot.com/review/peoplesafe.co.uk" target="_blank" rel="noopener">Trustpilot</a>
                    </div>
                </div>
            </div>
        </div>
    </section>';
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script(
        'trustpilot-widget',
        'https://widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js',
        [],
        null,
        true
    );
});

/**
 * Custom single XML sitemap
 * URL: /all-urls-sitemap.xml
 */
add_action('template_redirect', function () {
    $request_path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);

    if ($request_path !== '/all-urls-sitemap.xml') {
        return;
    }

    nocache_headers();
    status_header(200);
    header('Content-Type: application/xml; charset=UTF-8');

    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    $post_types = get_post_types([
        'public' => true,
    ], 'names');

    unset($post_types['attachment']);

    $q = new WP_Query([
        'post_type'              => array_values($post_types),
        'post_status'            => 'publish',
        'posts_per_page'         => -1,
        'orderby'                => 'modified',
        'order'                  => 'DESC',
        'fields'                 => 'ids',
        'no_found_rows'          => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
    ]);

    // Homepage
    echo "  <url>\n";
    echo '    <loc>' . esc_xml(home_url('/')) . "</loc>\n";
    echo "  </url>\n";

    foreach ($q->posts as $post_id) {
        $url = get_permalink($post_id);
        if (!$url) {
            continue;
        }

        $modified = get_post_modified_time('c', true, $post_id);

        echo "  <url>\n";
        echo '    <loc>' . esc_xml($url) . "</loc>\n";
        if ($modified) {
            echo '    <lastmod>' . esc_xml($modified) . "</lastmod>\n";
        }
        echo "  </url>\n";
    }

    echo '</urlset>';
    exit;
}, 0);