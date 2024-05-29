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
                    <h2>Keep your people safe when they travel</h2>
                    <p>Protect your employees with our specialised service, whether they're travelling for business, commuting or meeting friends after work. We can get emergency help faster than calling 999.</p>
                    <a href="#" class="button button-outline">Read More</a>
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
                    <h2>Proactively manage people risk effectively</h2>
                    <p>Proactively manage people risk across your business with our award-winning platform that seamlessly connects your staff, managers and our <a href="#">Alarm Receiving Centre (ARC)</a> in one place.</p>
                    <a href="#" class="button button-outline">View Products</a>
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
                    <h2>Keep your people safe when they travel</h2>
                    <p>Protect your employees with our specialised service, whether they're travelling for business, commuting or meeting friends after work. We can get emergency help faster than calling 999.</p>
                    <a href="#" class="button button-outline">Read More</a>
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
                    <h2>Keep your people safe when they travel</h2>
                    <p>Protect your employees with our specialised service, whether they're travelling for business, commuting or meeting friends after work. We can get emergency help faster than calling 999.</p>
                    <a href="#" class="button button-outline">Read More</a>
                </div>
            </div>

            <div class="pill" aria-controls="mass">
                <img class="pill__icon" src="<?=get_stylesheet_directory_uri()?>/img/2024/icons/icon-mass-communication.png">
                <div class="pill__title">Mass Communication</div>
            </div>
            <div class="content" id="mass">
                <img class="content__image" src="<?=get_stylesheet_directory_uri()?>/img/2024/mass-communication.png" width=500 height=500>
                <div class="content__inner">
                    <div class="fs-300 fw-900 text-orange">Mass Communication</div>
                    <h2>Keep your people safe when they travel</h2>
                    <p>Protect your employees with our specialised service, whether they're travelling for business, commuting or meeting friends after work. We can get emergency help faster than calling 999.</p>
                    <a href="#" class="button button-outline">Read More</a>
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