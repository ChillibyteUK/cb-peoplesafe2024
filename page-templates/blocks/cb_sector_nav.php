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
<!-- sector_nav -->
<section class="sector_nav py-5">
    <div class="container">
        <div class="filter-buttons mb-4 text-center">
            <button id="filter-all" class="filter-button active" data-filter="all">All</button>
            <button id="filter-private" class="filter-button" data-filter="private">Private Sector</button>
            <button id="filter-public" class="filter-button" data-filter="public">Public Sector</button>
        </div>
        <div class="sector_nav__grid">
            <?php
            // $terms = get_terms( array(
            //     'taxonomy' => 'sectors',
            //     'hide_empty' => true,
            // ) );
            // foreach ($terms as $c) {
            //     echo '<div class="col-md-4"><a href="/sectors/' . $c->slug . '/">' . $c->name . '</a></div>';
            // }
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
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all the filter buttons
        const filterButtons = document.querySelectorAll(".filter-button");

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

        // Helper function to manage active class on buttons
        function setActiveButton(clickedButton) {
            // Remove active class from all buttons
            filterButtons.forEach((button) => {
                button.classList.remove("active");
            });

            // Add active class to the clicked button
            clickedButton.classList.add("active");
        }

        // Add event listeners for each button
        filterButtons.forEach((button) => {
            button.addEventListener("click", function() {
                const filterValue = this.getAttribute("data-filter");

                // Call filter function with the appropriate filter value
                filterCards(filterValue);

                // Set the clicked button as active
                setActiveButton(this);
            });
        });
    });
</script>