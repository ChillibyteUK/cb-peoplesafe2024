<section class="top_tab_group_2024 py-5">
    <div class="container-xl">
        <div class="top_tab_group_2024__inner">
            <?php
            $active = 'active';
            $c = 1;
            while (have_rows('tabs')) {
                the_row();

                $icon = wp_get_attachment_image_url(get_sub_field('tab_icon'), 'medium', false);
                $tab_title = get_sub_field('tab_title');
                $pre_title = get_sub_field('pre_title');
                $link = get_sub_field('link');
                $image = wp_get_attachment_image(get_sub_field('image'), 'large', false, array('class' => 'content__image', 'width' => 500, 'height' => 500, 'alt' => $tab_title));
                ?>
            <div class="pill <?=$active?>" aria-controls="tab_<?=$c?>">
                <img class="pill__icon" src="<?=$icon?>">
                <div class="pill__title"><?=$tab_title?></div>
            </div>
            <div class="content <?=$active?>" id="tab_<?=$c?>">
                <?=$image?>
                <div class="content__inner">
                    <div class="fs-300 fw-900 text-orange"><?=$pre_title?></div>
                    <h2><?=get_sub_field('title')?></h2>
                    <p><?=get_sub_field('content')?></p>
                    <a href="<?=$link['url']?>" class="button button-outline"><?=$link['title']?></a>
                </div>
            </div>
                <?php
                $c++;
                $active = '';
            }
            ?>
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