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
    <!-- <link rel='stylesheet' id='font-awesome-css' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css' media='all' /> -->
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Bold.woff" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Bold.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Regular.woff" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Regular.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Light.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Light.woff" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="<?= get_stylesheet_directory_uri() ?>/fonts/BasisGrotesquePro-Light.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <?php
    if (get_field('gtm_property', 'options')) {
    ?>
        <!-- Google Tag Manager -->
        <script>
            <?php
            if (is_singular('guides') || is_post_type_archive('guides')) {
            ?>
                window.dataLayer = window.dataLayer || [];
                dataLayer.push({
                    'event': 'userdata',
                    'guide_viewed': 'true',
                });
            <?php
            }
            if (is_singular('news') || is_post_type_archive('news')) {
            ?>
                window.dataLayer = window.dataLayer || [];
                dataLayer.push({
                    'event': 'userdata',
                    'news_viewed': 'true',
                });
            <?php
            }
            if (is_singular('post') || is_home()) {
            ?>
                window.dataLayer = window.dataLayer || [];
                dataLayer.push({
                    'event': 'userdata',
                    'blog_viewed': 'true',
                });
            <?php
            }
            ?>
                (function(w, d, s, l, i) {
                    w[l] = w[l] || [];
                    w[l].push({
                        'gtm.start': new Date().getTime(),
                        event: 'gtm.js'
                    });
                    var f = d.getElementsByTagName(s)[0],
                        j = d.createElement(s),
                        dl = l != 'dataLayer' ? '&l=' + l : '';
                    j.async = true;
                    j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                    f.parentNode.insertBefore(j, f);
                })(window, document, 'script', 'dataLayer', '<?= get_field('gtm_property', 'options') ?>');
        </script>
        <!-- End Google Tag Manager -->
    <?php
    }
    if (get_field('ga_property', 'options')) {
    ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= get_field('ga_property', 'options') ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '<?= get_field('ga_property', 'options') ?>');
        </script>
    <?php
    }
    if (get_field('google_site_verification', 'options')) {
        echo '<meta name="google-site-verification" content="' . get_field('google_site_verification', 'options') . '" />';
    }
    if (get_field('bing_site_verification', 'options')) {
        echo '<meta name="msvalidate.01" content="' . get_field('bing_site_verification', 'options') . '" />';
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
                "logo": "https://peoplesafe.co.uk/wp-content/themes/cb-peoplesafe<?= get_stylesheet_directory_uri() ?>/img/2024/ps-logo-full--dark.svg",
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
    <script type="text/javascript" async src="//l.getsitecontrol.com/d7ol6g67.js"></script>
</head>

<body <?php body_class(); ?>>
    <?php
    do_action('wp_body_open');

    if (get_field('gtm_property', 'options')) {
        if (!is_user_logged_in()) {
    ?>
            <!-- Google Tag Manager (noscript) -->
            <noscript><iframe
                    src="https://www.googletagmanager.com/ns.html?id=<?= get_field('gtm_property', 'options') ?>"
                    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
    <?php
        }
    }
    ?>
    <div class="site" id="page">
        <header>
            <nav>
                <div class="container-xl">
                    <div class="navbar">
                        <div class="burger-menu" id="burger-menu">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <a href="/" class="logo"><img src="<?= get_stylesheet_directory_uri() ?>/img/ps-logo-full--dark.svg"></a>
                        <div class="navItems" id="navItems">
                            <a class="toggle" aria-controls="dropdownProducts" data-href="/products/">Products</a>
                            <a class="toggle" aria-controls="dropdownSolutions" data-href="/solutions/">Solutions</a>
                            <a class="toggle" aria-controls="dropdownPlatform" data-href="/about-menu/">About</a>
                            <a class="toggle" aria-controls="dropdownKnowledge" data-href="/resources/">Knowledge Hub</a>
                            <div class="navbar__extras me-xl-2">
                                <a class="toggle" aria-controls="dropdownSupport" data-href="/support/">Support</a>
                                <a href="/portal-login/">Login</a>
                                <span role="button" data-bs-toggle="modal" data-bs-target="#demoModal" class="button button-yellow mb-2"><span>Book a Demo</span></span>
                                <?php
                                if (WC()->cart->get_cart_contents_count() > 0) {
                                ?>
                                    <a href="/cart/" title="Basket"><i class="fas fa-shopping-basket"></i></a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="navMenus" id="navMenus">
                        <div id="dropdownProducts" class="dropdownMenu">
                            <ul class="left">
                                <li class="active" aria-controls="safetyDevices">Safety Devices</li>
                                <li class="" aria-controls="safetyApps">Safety Apps</li>
                                <li class="" aria-controls="api">API</li>
                                <li class="" aria-controls="emergencyNotification">Emergency Notification System</li>
                                <li class="" aria-controls="safetyCameras">Safety Cameras</li>
                            </ul>
                            <div class="right right--products active" id="safetyDevices">
                                <div class="h3">Safety Devices</div>
                                <div>We provide a range of safety products including devices and apps to ensure the most appropriate solution for your organisation.</div>
                                <div class="items">
                                    <a class="item" href="/products/mysos/">
                                        <img class="item__image" src="<?= get_stylesheet_directory_uri() ?>/img/2024/products/MySOS.png">
                                        <div class="item__inner">
                                            <div class="item__title">MySOS</div>
                                            <div class="item__desc">Compact personal safety alarm</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/products/mysos-id-badge-4g/">
                                        <img class="item__image" src="<?= get_stylesheet_directory_uri() ?>/img/2024/products/MySOS-ID-Badge.png">
                                        <div class="item__inner">
                                            <div class="item__title">MySOS ID Badge 4G</div>
                                            <div class="item__desc">Discreet personal safety ID badge</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/products/spot-gen4/">
                                        <img class="item__image" src="<?= get_stylesheet_directory_uri() ?>/img/2024/products/SpotGen4.png">
                                        <div class="item__inner">
                                            <div class="item__title">SPOT Gen4</div>
                                            <div class="item__desc">Pocket-sized satellite SOS alarm</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/products/spot-x/">
                                        <img class="item__image" src="<?= get_stylesheet_directory_uri() ?>/img/2024/products/SpotX.png">
                                        <div class="item__inner">
                                            <div class="item__title">SPOT X</div>
                                            <div class="item__desc">Robust compact satellite SOS alarm</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/products/twig-ex-atex/">
                                        <img class="item__image" src="<?= get_stylesheet_directory_uri() ?>/img/2024/products/TwigEx.png">
                                        <div class="item__inner">
                                            <div class="item__title">TWIG Ex (ATEX)</div>
                                            <div class="item__desc">ATEX/IECEX approved SOS alarm</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/products/standard-mobile/">
                                        <img class="item__image" src="<?= get_stylesheet_directory_uri() ?>/img/2024/products/StandardMobile.png">
                                        <div class="item__inner">
                                            <div class="item__title">Standard Mobile</div>
                                            <div class="item__desc">Entry level solution for low-risk workers</div>
                                        </div>
                                    </a>
                                    <?php
                                    /* LEFT AS AN EXAMPLE
                        <a class="item" href="/products/cat-phones/">
                            <img class="item__image" src="<?=get_stylesheet_directory_uri()?>/img/2024/products/CatPhone.png">
                            <div class="item__inner">
                                <div class="item__title">Cat Phones</div>
                                <div class="item__desc">Protect workers even in the harshest environments</div>
                            </div>
                        </a>
                        */
                                    ?>
                                </div>
                                <div class="w-50 ms-auto">
                                    <a href="/products/" class="products-link"><span>View all products</span><i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="right right--products" id="safetyApps">
                                <div class="h3">Safety Apps</div>
                                <div>We provide a range of safety apps to ensure the most appropriate solution for your organisation.</div>
                                <div class="items">
                                    <a class="item" href="/products/lone-worker-app/">
                                        <img class="item__image" src="/wp-content/uploads/2024/07/Lone-Worker-App.png">
                                        <div class="item__inner">
                                            <div class="item__title">Lone Worker App</div>
                                            <div class="item__desc">Accredited app for lone workers</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/products/sos-app/">
                                        <img class="item__image" src="/wp-content/uploads/2024/07/Personal-Safety-App.png">
                                        <div class="item__inner">
                                            <div class="item__title">Personal Safety App</div>
                                            <div class="item__desc">Safety app for all employees</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/products/travelsafe/">
                                        <img class="item__image" src="/wp-content/uploads/2024/07/Travelsafe.png">
                                        <div class="item__inner">
                                            <div class="item__title">Travelsafe</div>
                                            <div class="item__desc">Get safely from A to B</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/products/apple-watch/">
                                        <img class="item__image" src="/wp-content/uploads/2024/07/Apple-Watch-Personal-App.png">
                                        <div class="item__inner">
                                            <div class="item__title">Apple Watch App</div>
                                            <div class="item__desc">Response direct from your Apple Watch</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/products/international-traveller/">
                                        <img class="item__image" src="/wp-content/uploads/2024/07/International-Traveller-1.png">
                                        <div class="item__inner">
                                            <div class="item__title">International Traveller</div>
                                            <div class="item__desc">Keep your international travellers safe</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/products/roamsafe/">
                                        <img class="item__image" src="/wp-content/uploads/2024/12/roamsafe-menu.png">
                                        <div class="item__inner">
                                            <div class="item__title">Roamsafe</div>
                                            <div class="item__desc">Get a signal anywhere to call for help</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="w-50 ms-auto">
                                    <a href="/products/" class="products-link"><span>View all products</span><i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="right right--products" id="api">
                                <div class="h3">API</div>
                                <div>Streamline operations and reduce admin time</div>
                                <div class="items">
                                    <a class="item" href="/products/services-api/">
                                        <img class="item__image" src="/wp-content/uploads/2025/01/Nexus-API-hero.png">
                                        <div class="item__inner">
                                            <div class="item__title">Service API</div>
                                            <div class="item__desc">For workforce management systems</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/products/user-management-api/">
                                        <img class="item__image" src="/wp-content/uploads/2025/01/Nexus-API-hero.png">
                                        <div class="item__inner">
                                            <div class="item__title">User Management API</div>
                                            <div class="item__desc">For HR systems</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="right right--products" id="emergencyNotification">
                                <div class="h3">Emergency Notification System</div>
                                <div>Simple and dedicated emergency communication platform.</div>
                                <div class="items">
                                    <a class="item" href="/products/peoplesafe-alert/">
                                        <img class="item__image" src="/wp-content/uploads/2024/07/Peoplesafe-Alert.png">
                                        <div class="item__inner">
                                            <div class="item__title">Emergency Alert System</div>
                                            <div class="item__desc">Send multichannel notifications to keep your people safe and connected</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="w-50 ms-auto">
                                    <a href="/products/" class="products-link"><span>View all products</span><i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="right right--products" id="safetyCameras">
                                <div class="h3">Safety Cameras</div>
                                <div>Overt protection for frontline workers.</div>
                                <div class="items">
                                    <a class="item" href="/products/body-worn-camera/">
                                        <img class="item__image" src="/wp-content/uploads/2024/07/Body-Worn-Camera.png">
                                        <div class="item__inner">
                                            <div class="item__title">Body Worn Camera</div>
                                            <div class="item__desc">Deterrent for verbal and physical abuse</div>
                                        </div>
                                    </a>
                                    <a class="item" href="/products/surecam/">
                                        <img class="item__image" src="/wp-content/uploads/2024/07/Surecam.png">
                                        <div class="item__inner">
                                            <div class="item__title">SureCam</div>
                                            <div class="item__desc">Providing drivers inside and outside the vehicle</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="w-50 ms-auto">
                                    <a href="/products/" class="products-link"><span>View all products</span><i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div id="dropdownSolutions" class="dropdownMenu">
                            <ul class="left">
                                <li class="active" aria-controls="byRole">By Role</li>
                                <li class="" aria-controls="bySector">By Sector</li>
                            </ul>
                            <div class="right right--cards active" id="byRole">
                                <a class="item" href="/lone-workers/">
                                    <div class="item__image">
                                        <img src="<?= get_stylesheet_directory_uri() ?>/img/2024/lone-workers.png" alt="Lone Workers">
                                    </div>
                                    <div class="item__title">Lone Workers</div>
                                    <div class="item__desc">
                                        Keep your lone workers safe 24/7, wherever they are, with the Peoplesafe Lone Worker Alarms.
                                    </div>
                                </a>
                                <a class="item" href="/home-workers/">
                                    <div class="item__image">
                                        <img src="<?= get_stylesheet_directory_uri() ?>/img/2024/home-hybrid.png" alt="Home & Hybrid Workers">
                                    </div>
                                    <div class="item__title">Home & Hybrid Workers</div>
                                    <div class="item__desc">
                                        Our market-leading technology empowers home and hybrid workers to stay safe.
                                    </div>
                                </a>
                                <a class="item" href="/personal-safety/">
                                    <div class="item__image">
                                        <img src="<?= get_stylesheet_directory_uri() ?>/img/2024/all-employees.png" alt="All Employees">
                                    </div>
                                    <div class="item__title">All Employees</div>
                                    <div class="item__desc">
                                        Protect every employee with our dedicated solutions.
                                    </div>
                                </a>
                                <a class="item" href="/international-workers/">
                                    <div class="item__image">
                                        <img src="<?= get_stylesheet_directory_uri() ?>/img/2024/international-workers.png" alt="International Workers">
                                    </div>
                                    <div class="item__title">International Workers</div>
                                    <div class="item__desc">
                                        Ensure the safety of your staff even when they are not in the UK.
                                    </div>
                                </a>
                            </div>
                            <div class="right right--cols" id="bySector">
                                <div class="h3">By Sector</div>
                                <div>Whatever the risks your staff face at work, our fully accredited service will support them in an emergency.</div>
                                <ul>
                                    <li><a href="/sectors/nhs/">NHS</a></li>
                                    <li><a href="/sectors/housing/">Housing</a></li>
                                    <li><a href="/sectors/retail/">Retail</a></li>
                                    <li><a href="/sectors/transport/">Transport</a></li>
                                    <li><a href="/sectors/education/">Education</a></li>
                                    <li><a href="/sectors/estate-agents/">Estate Agents</a></li>
                                    <li><a href="/sectors/manufacturing/">Manufacturing</a></li>
                                    <li><a href="/sectors/professional-services-government/">Professional Services &amp; Government</a></li>
                                    <li><a href="/sectors/councils/">Councils</a></li>
                                    <li><a href="/sectors/utilities-telecoms/">Utilities</a></li>
                                    <li><a href="/sectors/haulage-distribution/">Haulage &amp; Distribution</a></li>
                                    <li><a href="/sectors/charity/">Charity</a></li>
                                    <li><a href="/sectors/hospitality/">Hospitality</a></li>
                                    <li><a href="/sectors/construction/">Construction</a></li>
                                    <li><a href="/sectors/police/">Police</a></li>
                                    <li><a href="/sectors/">All Sectors</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="dropdownPlatform" class="dropdownMenu">
                            <ul>
                                <li><a href="/about/">About Us</a></li>
                                <li><a href="/about/senior-management/">Our Team</a></li>
                                <li><a href="/nexus/">Nexus</a></li>
                                <li><a href="/alarm-receiving-centre/">ARC</a></li>
                                <li><a href="/accreditations/">Accreditations</a></li>
                                <li><a href="/contact-us/">Contact us</a></li>
                            </ul>
                        </div>

                        <div id="dropdownKnowledge" class="dropdownMenu">
                            <div class="items mb-3">
                                <a class="item" href="/blogs/">
                                    <img class="item__icon" src="<?= get_stylesheet_directory_uri() ?>/img/2024/icons/blog.png">
                                    <div class="item__inner">
                                        <div class="item__title">Blogs</div>
                                        <div class="item__desc">Tips &amp; content for safety at work</div>
                                    </div>
                                </a>
                                <a class="item" href="/news/">
                                    <img class="item__icon" src="<?= get_stylesheet_directory_uri() ?>/img/2024/icons/news.png">
                                    <div class="item__inner">
                                        <div class="item__title">News</div>
                                        <div class="item__desc">The very latest developments</div>
                                    </div>
                                </a>
                                <a class="item" href="/guides/">
                                    <img class="item__icon" src="<?= get_stylesheet_directory_uri() ?>/img/2024/icons/guides.png">
                                    <div class="item__inner">
                                        <div class="item__title">Guides</div>
                                        <div class="item__desc">Help &amp; guidance for employee safety</div>
                                    </div>
                                </a>
                                <a class="item" href="/whitepapers/">
                                    <img class="item__icon" src="<?= get_stylesheet_directory_uri() ?>/img/2024/icons/whitepapers.png">
                                    <div class="item__inner">
                                        <div class="item__title">Whitepapers</div>
                                        <div class="item__desc">Thought leadership research</div>
                                    </div>
                                </a>
                                <a class="item" href="/video/">
                                    <img class="item__icon" src="<?= get_stylesheet_directory_uri() ?>/img/2024/icons/videos.png">
                                    <div class="item__inner">
                                        <div class="item__title">Video</div>
                                        <div class="item__desc">Watch our latest content</div>
                                    </div>
                                </a>
                                <a class="item" href="/brochures/">
                                    <img class="item__icon" src="<?= get_stylesheet_directory_uri() ?>/img/2024/icons/brochures.png">
                                    <div class="item__inner">
                                        <div class="item__title">Brochures</div>
                                        <div class="item__desc">Peoplesafe product offerings</div>
                                    </div>
                                </a>
                                <a class="item" href="/stories/">
                                    <img class="item__icon" src="<?= get_stylesheet_directory_uri() ?>/img/2024/icons/stories.png">
                                    <div class="item__inner">
                                        <div class="item__title">Real Life Stories</div>
                                        <div class="item__desc">How we helped each person</div>
                                    </div>
                                </a>
                                <a class="item" href="/case-studies/">
                                    <img class="item__icon" src="<?= get_stylesheet_directory_uri() ?>/img/2024/icons/case-studies.png">
                                    <div class="item__inner">
                                        <div class="item__title">Case Studies</div>
                                        <div class="item__desc">Hear direct from our customers</div>
                                    </div>
                                </a>
                            </div>
                            <div class="w-50 ms-auto">
                                <a href="/resources/" class="knowledge-link"><span>View all Knowledge Hub</span><i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div id="dropdownSupport" class="dropdownMenu">
                            <ul>
                                <li><a href="https://nexussupport.peoplesafe.co.uk/hc/en-gb" target="_blank">Helpcentre</a></li>
                                <li><a href="/service-status/">Service Status</a></li>
                                <li><a href="/contact-us/">Contact Us</a></li>
                                <li><a href="/portal-login/">Portal Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
