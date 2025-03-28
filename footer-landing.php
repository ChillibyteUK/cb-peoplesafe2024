<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

?>
<div class="footer pb-3">
    <div class="container py-5">
        <div class="row px-4 px-md-0">
            <div class="col-md-6 col-lg-3 text-center text-md-end mb-4">
                <img src="<?=get_stylesheet_directory_uri()?>/img/ps-logo-full.svg">
                <div class="py-4">The UK's leading provider of technology-enabled employee safety solutions.</div>
                <div class="social mb-4">
                    <?=do_shortcode('[social_in_icon]')?>
                    <?=do_shortcode('[social_yt_icon]')?>
                    <?=do_shortcode('[social_tw_icon]')?>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 text-center text-md-end mb-4">
            </div>
            <div class="col-md-6 col-lg-3 text-center text-md-end mb-4">
            </div>
            <div class="col-md-6 col-lg-3 text-center text-md-end">
            </div>
        </div>
    </div>
</div>
<div class="colophon">
    <div class="container d-flex justify-content-between flex-wrap py-2">
        <div>&copy; <?=date('Y')?> Skyguard Ltd T/A Peoplesafe. Company Registration Number: 04107459. All rights reserved. Peoplesafe is part of the Send for Help Group.</div>
        <a href="https://www.chillibyte.co.uk/" rel="nofollow noopener" target="_blank" class="cb" title="Digital Marketing by Chillibyte"></a>
    </div>
</div>
<!-- modal_form -->
<div class="modal fade" id="demoModal" tabindex="-1" aria-labelledby="demoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title text-center mx-auto" id="demoLabel">
                    <div class="h3 text-black">Book a Demo</div>
                </div>
                <button type="button" class="btn-modal btn-close align-self-start" style="background:none;border:none" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div>To book a demo of any of our solutions or a consultation with one of our personal safety experts, please fill in the form below.</div>
                <iframe loading="lazy" style="border: 0;" src="https://safe.peoplesafe.co.uk/l/830213/2022-06-22/rgxm4" width="100%" height="1200" frameborder="0" scrolling="auto" id="myiframe"></iframe>
            </div>
        </div>
    </div>
</div>
</div><!-- #page -->
<!--div class="side-buttons side-buttons--left">
    <div class="side-button shop-button">E-Store</div>
</div-->
<!-- <div class="side-buttons side-buttons--right">
    <a href="/contact-us/">
        <div class="side-button enquire-button">Enquire</div>
    </a>
</div> -->

<!-- Start of nexusportal Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=a841da69-bcf5-4be4-b159-ffcbd20bcfe7"> </script>
<!-- End of nexusportal Zendesk Widget script -->

<?php wp_footer();
if (get_field('gtm_property', 'options')) {
    ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?=get_field('gtm_property', 'options')?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <?php
}
?>
</body>

</html>

