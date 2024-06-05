<?php
$appsLink = get_field('apps_link');
$sdLink =  get_field('safety_devices_link');
$nexusLink =  get_field('nexus_link');
$tsLink =  get_field('travelsafe_link');
$eaLink =  get_field('emergency_alert_link');
?>
<section class="product_types_2024 py-5">
    <div class="container-xl">
        <div class="product_types_2024__inner">
            <div class="pill active" aria-controls="apps">
                <img class="pill__icon" src="<?=get_stylesheet_directory_uri()?>/img/2024/icons/icon-apps.png">
                <div class="pill__title">Apps</div>
            </div>
            <div class="content active" id="apps">
                <img class="content__image" src="<?=get_stylesheet_directory_uri()?>/img/2024/apps.png" width=500 height=500>
                <div class="content__inner">
                    <div class="fs-300 fw-900 text-orange">Apps</div>
                    <h2><?=get_field('apps_title')?></h2>
                    <p><?=get_field('apps_content')?></p>
                    <a href="<?=$appsLink['url']?>" class="button button-outline"><?=$appsLink['title']?></a>
                </div>
            </div>

            <div class="pill" aria-controls="devices">
            <img class="pill__icon" src="<?=get_stylesheet_directory_uri()?>/img/2024/icons/icon-safety-devices.png">
                <div class="pill__title">Safety Devices</div>
            </div>
            <div class="content" id="devices">
                <img class="content__image" src="<?=get_stylesheet_directory_uri()?>/img/2024/safety-devices.png" width=500 height=500>
                <div class="content__inner">
                    <div class="fs-300 fw-900 text-orange">Safety Devices</div>
                    <h2><?=get_field('safety_devices_title')?></h2>
                    <p><?=get_field('safety_devices_content')?></p>
                    <a href="<?=$sdLink['url']?>" class="button button-outline"><?=$sdLink['title']?></a>
                </div>
            </div>

            <div class="pill" aria-controls="nexus">
                <img class="pill__icon" src="<?=get_stylesheet_directory_uri()?>/img/2024/icons/icon-nexus.png">
                <div class="pill__title">Nexus</div>
            </div>
            <div class="content" id="nexus">
                <img class="content__image" src="<?=get_stylesheet_directory_uri()?>/img/2024/nexus.png" width=500 height=500>
                <div class="content__inner">
                    <div class="fs-300 fw-900 text-orange">Nexus</div>
                    <h2><?=get_field('nexus_title')?></h2>
                    <p><?=get_field('nexus_content')?></p>
                    <a href="<?=$nexusLink['url']?>" class="button button-outline"><?=$nexusLink['title']?></a>
                </div>
            </div>

            <div class="pill" aria-controls="travelsafe">
                <img class="pill__icon" src="<?=get_stylesheet_directory_uri()?>/img/2024/icons/icon-travelsafe.png">
                <div class="pill__title">Travelsafe</div>
            </div>
            <div class="content" id="travelsafe">
                <img class="content__image" src="<?=get_stylesheet_directory_uri()?>/img/2024/travelsafe.png" width=500 height=500>
                <div class="content__inner">
                    <div class="fs-300 fw-900 text-orange">Travelsafe</div>
                    <h2><?=get_field('travelsafe_title')?></h2>
                    <p><?=get_field('travelsafe_content')?></p>
                    <a href="<?=$tsLink['url']?>" class="button button-outline"><?=$tsLink['title']?></a>
                </div>
            </div>

            <div class="pill" aria-controls="mass">
                <img class="pill__icon" src="<?=get_stylesheet_directory_uri()?>/img/2024/icons/icon-mass-communication.png">
                <div class="pill__title">Emergency Alert</div>
            </div>
            <div class="content" id="mass">
                <img class="content__image" src="<?=get_stylesheet_directory_uri()?>/img/2024/mass-communication.png" width=500 height=500>
                <div class="content__inner">
                    <div class="fs-300 fw-900 text-orange">Emergency Alert</div>
                    <h2><?=get_field('emergency_alert_title')?></h2>
                    <p><?=get_field('emergency_alert_content')?></p>
                    <a href="<?=$eaLink['url']?>" class="button button-outline"><?=$eaLink['title']?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all section elements
        const sections = document.querySelectorAll('section');

        // Iterate through each section
        sections.forEach(section => {
            // Select pill and content elements within the section
            const pills = section.querySelectorAll('.pill');
            const contents = section.querySelectorAll('.content');

            // Add click event listener to each pill
            pills.forEach(pill => {
                pill.addEventListener('click', function() {
                    // Remove 'active' class from all pills in the section
                    pills.forEach(p => p.classList.remove('active'));
                    // Add 'active' class to the clicked pill
                    pill.classList.add('active');

                    // Get the id of the content to show
                    const contentId = pill.getAttribute('aria-controls');

                    // Hide all content elements in the section
                    contents.forEach(content => content.classList.remove('active'));

                    // Show the related content element in the section
                    section.querySelector(`#${contentId}`).classList.add('active');
                });
            });
        });
    });
</script>