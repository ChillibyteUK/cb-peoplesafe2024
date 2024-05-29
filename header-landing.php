<?php
/**
 * The header for the theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel='stylesheet' id='font-awesome-css' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css' media='all' />
    <link rel="preload" href="<?=get_stylesheet_directory_uri()?>/fonts/BasisGrotesquePro-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?=get_stylesheet_directory_uri()?>/fonts/BasisGrotesquePro-Bold.woff" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="<?=get_stylesheet_directory_uri()?>/fonts/BasisGrotesquePro-Bold.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="<?=get_stylesheet_directory_uri()?>/fonts/BasisGrotesquePro-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?=get_stylesheet_directory_uri()?>/fonts/BasisGrotesquePro-Regular.woff" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="<?=get_stylesheet_directory_uri()?>/fonts/BasisGrotesquePro-Regular.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="<?=get_stylesheet_directory_uri()?>/fonts/BasisGrotesquePro-Light.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?=get_stylesheet_directory_uri()?>/fonts/BasisGrotesquePro-Light.woff" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="<?=get_stylesheet_directory_uri()?>/fonts/BasisGrotesquePro-Light.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <?php
    if (get_field('gtm_property','options')) {
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
    if (get_field('ga_property', 'options')) { 
        ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?=get_field('ga_property','options')?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?=get_field('ga_property','options')?>');
</script>
        <?php
    }
    if (get_field('bing_site_verification','options')) {
        echo '<meta name="msvalidate.01" content="' . get_field('bing_site_verification','options') . '" />';
    }
    if (is_front_page() || is_page('contact-us')) {
        ?>
 <script type="application/ld+json">
 {
 "@context": "http://schema.org",
 "@type": "Organization",
 "url": "https://peoplesafe.co.uk/",
 "name": "Peoplesafe",
 "legalName": "Skyguard Ltd",
 "description": "Formerly Skyguard and Guardian24, Peoplesafe is an industry leading UK-based technology business centred around the safety of lone and at-risk workers",
 "logo": "https://peoplesafe.co.uk/wp-content/themes/cb-peoplesafe/img/ps-logo-full--dark.svg",
 "sameAs": [
 "https://twitter.com/peoplesafe",
 "https://www.youtube.com/channel/UCRT8D1BWOHpR9Gt8jZukZSQ",
 "https://www.linkedin.com/company/peoplesafe-ltd/"
 ],
 "contactPoint": {
 "@type": "ContactPoint",
 "telephone": "+44-330-333-6556",
 "contactType": "Customer service"
 }
 }
 </script>
        <?php
    }
    ?>
	<?php wp_head(); ?>
<style>
#launcher { display: none; }
</style>
</head>

<body <?php body_class(); ?>>
<?php
do_action('wp_body_open'); 

if (get_field('gtm_property','options')) {
    ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?=get_field('ga_property', 'options')?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <?php
}
?>
<div class="site" id="page">
    <div id="header">
        <div class="py-2 d-none d-lg-flex justify-content-between container-xl px-4 px-xl-2">
            <a class="navbar-brand" rel="home" href="/"></a>
            <div class="d-flex justify-content-end my-2 w-100 align-items-center">
            </div>
        </div>
        <div class="d-flex d-lg-none justify-content-between align-items-center w-100 px-4">
            <div class="navbar-brand mt-2" rel="home"></div>
        </div>
    </div>