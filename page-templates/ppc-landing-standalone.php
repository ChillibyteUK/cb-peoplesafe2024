<?php
/**
 * Template Name: PPC Landing – HTML Content
 *
 * Renders a self-contained HTML landing page (its own CSS + JS) INSIDE the
 * standard PPC landing chrome (branded header + footer). The embedded page's own
 * logo bar is hidden, because the PPC header already carries the Peoplesafe
 * branding (the "part at the top" the client asked to remove).
 *
 * The markup lives in a partial and is streamed out with readfile() so the inline
 * SVG "<?xml?>" prologs are not parsed as PHP. The page's CSS is fully scoped to
 * #rsc-app, so it overrides the theme's styles by specificity and renders as authored.
 */

defined('ABSPATH') || exit;

get_header('landing');
// $mt = is_front_page() ? '' : 'margin-top';
$modal = 0;
?>
<style>
    /* The PPC header already shows Peoplesafe branding, so hide the embedded
       page's own logo bar (the "part at the top" the client wanted removed). */
    #rsc-app .topbar { display: none !important; }
</style>
<main id="main" class="padding-top">
    <?php
    // Stream the self-contained landing markup verbatim (readfile does not parse PHP).
    readfile( get_theme_file_path('page-templates/landing-html/reasonable-steps-check.html') );
    ?>
</main>
<?php
get_footer('landing');
