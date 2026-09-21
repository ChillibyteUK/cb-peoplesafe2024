<?php
/**
 * Template Name: PPC Landing – Standalone HTML
 *
 * Renders a fully self-contained HTML landing page (its own CSS + JS) with no
 * theme chrome — no header logo bar and no theme footer — so a client-approved
 * standalone design renders exactly as authored, without the theme's Bootstrap
 * styles bleeding onto its buttons, headings and inputs.
 *
 * Campaign tracking is preserved: GTM + GA (same ACF-gated snippet the standard
 * landing header uses) plus wp_head()/wp_footer() so the Pardot UTM forwarding,
 * consent manager, NitroPack, etc. all still run.
 *
 * The page's markup lives in a partial and is streamed out verbatim with
 * readfile() — readfile does NOT parse PHP, so the inline SVG "<?xml?>" prologs
 * are left untouched. The matching template also dequeues the theme's front-end
 * CSS/JS (see theme_dequeue_for_standalone_landing() in functions.php).
 */

defined('ABSPATH') || exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>html,body{margin:0;padding:0;}</style>
    <?php
    // Google Tag Manager (matches header-landing.php, ACF-gated).
    if (get_field('gtm_property', 'options')) {
        ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?=get_field('gtm_property','options')?>');</script>
<!-- End Google Tag Manager -->
        <?php
    }
    // Google Analytics (gtag).
    if (get_field('ga_property', 'options')) {
        ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?=get_field('ga_property','options')?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?=get_field('ga_property','options')?>');
</script>
        <?php
    }

    // Fires the Pardot UTM-forwarding script, consent manager, NitroPack, etc.
    wp_head();
    ?>
</head>

<body <?php body_class('ppc-landing-standalone'); ?>>
<?php
do_action('wp_body_open');

// Google Tag Manager (noscript).
if (get_field('gtm_property', 'options')) {
    ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?=get_field('gtm_property','options')?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <?php
}

// Stream the self-contained landing markup verbatim (no PHP parsing).
readfile( get_theme_file_path('page-templates/landing-html/reasonable-steps-check.html') );

wp_footer();
?>
</body>
</html>
