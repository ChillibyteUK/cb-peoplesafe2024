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
<style>
    .footer .gf {
        margin-top: 1rem;
        z-index: 1;
        position: relative;
    }

    .footer .gf form::before {
        position: absolute;
        display: block;
        content: "";
        width: 265px;
        max-width: 100%;
        height: 50px;
        background-color: #ffb423;
        transform: translate(-5px, 5px);
        z-index: -1;
    }

    .footer form {
        display: flex;
        background-color: white;
        position: relative;
        height: 50px;
        width: 265px;
        max-width: 100%;
        z-index: 1;
    }

    .footer .gf input[type=email] {
        border: none;
        border-radius: 0;
        height: 50px;
    }

    .footer .gform_footer {
        padding: 0 !important;
        margin: 0 !important;
        flex: 1;
        background-color: white;
    }

    .footer .gform_footer input[type=submit] {
        margin: 5px auto !important;
        height: 40px;
        background-color: #ffb423;
        color: black;
        border: none;
    }
</style>
<div class="footer pb-3">
    <div class="container py-5">
        <div class="row px-4 px-md-0">
            <div class="col-md-6 col-lg-3 text-center text-md-start mb-4">
                <img
                    src="<?=get_stylesheet_directory_uri()?>/img/ps-logo-full.svg">
                <?php /*
                <div class="gf">
                    <p class="nav-title">Signup to our Newsletter:</p>
                    <?=do_shortcode('[gravityform id="1" title="false"]')?>
                </div>
*/ ?>
                <div class="py-4">The UK's leading provider of technology-enabled employee safety solutions.</div>
                <a href="/contact-us/" class="btn btn-primary">Get in touch</a>
                <div class="social mb-4">
                    <?=do_shortcode('[social_in_icon]')?>
                    <?=do_shortcode('[social_yt_icon]')?>
                    <?=do_shortcode('[social_tw_icon]')?>
                </div>
                <div class="">
                    <div class="nav-title">Newsletter Sign Up</div>
                    <form target="_blank" method="GET" action="https://peoplesafe.co.uk/newsletter-signup/"
                        style="height: auto; display: inline;">
                        <div class="mb-3">
                            <label for="NewsletterEmail" class="form-label visually-hidden d-none">Email address</label>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="input-group">
                            <input type="email" class="form-control required" id="email" name="email"
                                aria-describedby="emailHelp" placeholder="Email address" required>
                            <button type="submit" class="btn btn-primary" style="font-weight: 400;">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 text-center text-md-start mb-4">
                <div class="nav-title">Products</div>
                <?php wp_nav_menu(array('theme_location' => 'footer_menu1')); ?>
            </div>
            <div class="col-md-6 col-lg-3 text-center text-md-start mb-4">
                <div class="nav-title">Sectors</div>
                <ul class="menu">
                    <?php
                    // $terms = get_terms( array(
                    //     'taxonomy' => 'sectors',
                    //     'hide_empty' => true,
                    // ) );
            
                    // foreach ($terms as $c) {
                    //     echo '<li><a href="/sectors/' . $c->slug . '/">' . $c->name . '</a></li>';
                    // }
                    $parent = get_page_by_path('sectors');
$q = new WP_Query(array(
    'post_type' => 'page',
    'post_parent' => $parent->ID,
    'posts_per_page' => -1
));
while ($q->have_posts()) {
    $q->the_post();
    echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
}
wp_reset_postdata();
?>
                </ul>
            </div>
            <div class="col-md-6 col-lg-3 text-center text-md-start">
                <div class="nav-title">Resources</div>
                <?php wp_nav_menu(array('theme_location' => 'footer_menu2')); ?>
            </div>
        </div>
    </div>
    <div class="colophon">
        <div class="container d-flex justify-content-between flex-wrap py-2">
            <div>&copy; <?=date('Y')?> Skyguard
                Ltd T/A Peoplesafe. Company Registration Number: 04107459. All rights reserved. Peoplesafe is part of
                the Send for Help Group.</div>
            <a href="https://www.chillibyte.co.uk/" rel="nofollow noopener" target="_blank" class="cb"
                title="Digital Marketing by Chillibyte"></a>
        </div>
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
                <button type="button" class="btn-modal btn-close align-self-start" style="background:none;border:none"
                    data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div>To book a demo of any of our solutions or a consultation with one of our personal safety experts,
                    please fill in the form below.</div>
                <iframe loading="lazy" style="border: 0;" src="https://safe.peoplesafe.co.uk/l/830213/2022-06-22/rgxm4"
                    width="100%" height="1200" frameborder="0" scrolling="auto" id="myiframe"></iframe>
            </div>
        </div>
    </div>
</div>
</div><!-- #page -->
<!--div class="side-buttons side-buttons--left">
    <div class="side-button shop-button">E-Store</div>
</div-->
<div class="side-buttons side-buttons--right">
    <a href="/contact-us/">
        <div class="side-button enquire-button">Enquire</div>
    </a>
</div>
<?php

if (is_front_page()) {
    ?>
<style>
    .countryModal {
        background-color: rgba(0, 0, 0, 0.4);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: table;
        z-index: 999;
    }

    .countryModal.hidden {
        display: none;
    }

    .countryModal .modalContainer {
        display: table-cell;
        text-align: center;
        vertical-align: middle;
        width: min(300px, 90vw);
    }

    .countryModal .body {
        display: inline-block;
        background-color: white;
        border: 1px solid black;
        padding: 1rem;
    }

    .countryModal .buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .countryModal .button {
        border: 2px solid black;
        padding: 0.5rem 1rem;
        text-decoration: none;
        color: black;
        font-weight: bold;
        width: 290px;
        cursor: pointer;
        transition: background-color 300ms ease-in;
    }

    .countryModal .button:hover {
        background-color: #ffa63a;
    }
</style>
<div id="countryModal" class="countryModal hidden">
    <div class="modalContainer">
        <div class="body">
            <div class="h4">It looks like you are visiting from North America</div>
            <p>Would you like to visit our North American solution, <strong>OK Alone</strong>?</p>
            <p class="buttons">
                <a href="https://www.okaloneworker.com/" class="button">
                    Visit our North America site
                </a>
                <span id="countryModalDismiss" class="button">
                    Continue to the UK site
                </span>
            </p>
        </div>
    </div>
</div>
<?php
    ?>
<script>
    var modal = document.querySelector("#countryModal");
    var container = modal.querySelector(".modalContainer");

    <?php
        $clientIP = $_SERVER['REMOTE_ADDR'];
    $country = file_get_contents('http://ip-api.com/json/' . $clientIP);
    $countryData = json_decode($country);
    echo "console.log('{$countryData->countryCode}');";
    if ($countryData->countryCode === 'US' || $countryData->countryCode === 'CA') {
        echo "modal.classList.remove('hidden');";
    }
    ?>
    document.querySelector("#countryModalDismiss").addEventListener("click", function(e) {
        modal.classList.add("hidden");
    });
    document.querySelector("#countryModal").addEventListener("click", function(e) {
        if (e.target !== modal && e.target !== container) {
            return;
        }
        modal.classList.add("hidden");
    });
</script>
<?php
}

// TODO: SORT THIS NONSENSE OUT.
?>
<script>
    // swiper equal height
    function setEqualHeight(slider) {
        let maxHeight = 0;
        const slides = document.querySelectorAll(slider);

        // Remove existing heights to recalculate
        slides.forEach(slide => {
            slide.style.height = 'auto';
        });

        // Find the maximum height
        slides.forEach(slide => {
            if (slide.offsetHeight > maxHeight) {
                maxHeight = slide.offsetHeight;
            }
        });

        // Set all slides to the maximum height
        slides.forEach(slide => {
            slide.style.height = `${maxHeight}px`;
        });
    }
</script>
<?php wp_footer();
if (get_field('gtm_property', 'options')) {
    ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
        src="https://www.googletagmanager.com/ns.html?id=<?=get_field('gtm_property', 'options')?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php
}
?>
<!-- Accessibility Code for "peoplesafe.co.uk" -->
<!-- <script> window.interdeal = { "sitekey": "1f0e18083807187773763e08407492ab", "Position": "Left", "Menulang": "EN-GB", "domains": { "js": "https://cdn.equalweb.com/", "acc": "https://access.equalweb.com/" }, "btnStyle": { "vPosition": [ "80%", null ], "scale": [ "0.8", "0.8" ], "color": { "main": "#1876c9" }, "icon": { "type": 7, "shape": "semicircle", "outline": false } } }; (function(doc, head, body){ var coreCall = doc.createElement('script'); coreCall.src = 'https://cdn.equalweb.com/core/4.3.7/accessibility.js'; coreCall.defer = true; coreCall.integrity = 'sha512-hGa5HZtFkT1M7+tUDtU/cbw6AG0ORz3oblztCoTZ/z2qPyr7dgwH3zoT8qpgj21MgcRsMFLD6NNKePGvVks3Ig=='; coreCall.crossOrigin = 'anonymous'; coreCall.setAttribute('data-cfasync', true ); body? body.appendChild(coreCall) : head.appendChild(coreCall); })(document, document.head, document.body); </script> -->
</body>

</html>