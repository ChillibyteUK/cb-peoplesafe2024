<?php
$sectors = [
    'charity' => 'public,private',
    'construction' => 'public',
    'haulage-distribution' => 'public',
    'hospitality' => 'public',
    'manufacturing' => 'public',
    'professional-services-government' => 'public,private',
    'retail' => 'public',
    'transport' => 'public',
    'utilities-telecoms' => 'public',
    'councils' => 'public',
    'housing' => 'public',
    'nhs' => 'public',
    'police' => 'public',
    'education' => 'private,public',
    'estate-agents' => 'private',
];

$roles = [
    'All Employees' => '/personal-safety/',
    'Home & Hybrid Workers' => '/home-workers/',
    'Lone Workers' => '/lone-workers/',
    'International Workers' => '/international-workers/',
];

?>
<style>
    .filter-button {
        background-color: #bdccd3;
        padding: 1rem 0.75rem;
        border: none;
        border-radius: 0.5rem;
        color: #000;
        min-width: 145px;
    }

    .filter-button.active {
        background-color: #ffb423;
    }
</style>
<!-- solutions_nav -->
<section class="solutions_nav pt-4 pb-5">
    <div class="container">
        <div class="filter-buttons mb-4 text-center">
            <button id="show-role" class="filter-button active">By Role</button>
            <button id="show-sector" class="filter-button">By Sector</button>
        </div>

        <div class="solutions_nav" id="byRoleDiv">

            <div class="solutions_nav__grid">
                <?php
                foreach ($roles as $role => $link) {
                    $full_permalink = home_url($link);
                    $post_id = url_to_postid($full_permalink);

                ?>
                    <a href="<?= $link ?>" class="solutions_nav__card">
                        <div class="solutions_nav__image">
                            <?= wp_get_attachment_image(get_field('card_image', $post_id), 'large') ?>
                        </div>
                        <div class="solutions_nav__container">
                            <?= $role ?>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div> <!-- end roles -->

        <div class="solutions_nav d-none" id="bySectorDiv">

            <div class="filter-buttons mb-4 d-flex flex-wrap gap-2 justify-content-center">
                <button id="filter-all" class="filter-button active" data-filter="all">All</button>
                <button id="filter-private" class="filter-button" data-filter="private">Private Sector</button>
                <button id="filter-public" class="filter-button" data-filter="public">Public Sector</button>
            </div>
            <div class="solutions_nav__grid">
                <?php
                $parent = get_page_by_path('sectors');
                $q = new WP_Query(array(
                    'post_type' => 'page',
                    'post_parent' => $parent->ID,
                    'posts_per_page' => -1
                ));
                while ($q->have_posts()) {
                    $q->the_post();
                    $post_slug = get_post_field('post_name', get_the_ID());
                    if (array_key_exists($post_slug, $sectors)) {
                        $sector_value = $sectors[$post_slug];
                    } else {
                        $sector_value = null;
                    }
                ?>
                    <a href="<?= get_the_permalink() ?>" class="sector_nav__card" data-filter="<?= $sector_value ?>">
                        <div class="sector_nav__image">
                            <?= wp_get_attachment_image(get_field('card_image', get_the_ID()), 'large') ?>
                        </div>
                        <div class="sector_nav__container">
                            <?= get_the_title() ?>
                        </div>
                    </a>
                <?php
                }
                wp_reset_postdata();
                ?>
            </div>
        </div> <!-- end sectors -->
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all the filter buttons (for card filtering)
        const filterButtons = document.querySelectorAll(".filter-button[data-filter]");

        // Get all the cards
        const cards = document.querySelectorAll(".sector_nav__card");

        // Helper function to show/hide cards based on filter value
        function filterCards(filterValue) {
            cards.forEach((card) => {
                const cardFilters = card.getAttribute("data-filter").split(","); // Split categories by comma
                if (filterValue === "all") {
                    card.style.display = "grid"; // Show all cards
                } else if (cardFilters.includes(filterValue)) {
                    card.style.display = "grid"; // Show matching cards
                } else {
                    card.style.display = "none"; // Hide non-matching cards
                }
            });
        }

        // Helper function to manage active class on filter buttons
        function setActiveFilterButton(clickedButton) {
            // Remove active class from all filter buttons
            filterButtons.forEach((button) => {
                button.classList.remove("active");
            });

            // Add active class to the clicked filter button
            clickedButton.classList.add("active");
        }

        // Add event listeners for each filter button (for cards)
        filterButtons.forEach((button) => {
            button.addEventListener("click", function() {
                const filterValue = this.getAttribute("data-filter");

                // Call filter function with the appropriate filter value
                filterCards(filterValue);

                // Set the clicked filter button as active
                setActiveFilterButton(this);
            });
        });

        // Toggle visibility for bySector and byRole divs
        const showSectorButton = document.getElementById("show-sector");
        const showRoleButton = document.getElementById("show-role");
        const bySectorDiv = document.getElementById("bySectorDiv");
        const byRoleDiv = document.getElementById("byRoleDiv");

        // Event listeners for Sector and Role buttons
        showSectorButton.addEventListener("click", function() {
            console.log('sector button clicked');
            // Show the bySector div, hide the byRole div
            showSectorButton.classList.add('active');
            showRoleButton.classList.remove('active');
            bySectorDiv.classList.remove("d-none");
            byRoleDiv.classList.add("d-none");
        });

        showRoleButton.addEventListener("click", function() {
            console.log('role button clicked');
            // Show the byRole div, hide the bySector div
            showRoleButton.classList.add('active');
            showSectorButton.classList.remove('active');
            byRoleDiv.classList.remove("d-none");
            bySectorDiv.classList.add("d-none");
        });
    });
</script>