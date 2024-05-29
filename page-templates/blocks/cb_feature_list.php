<section class="feature_list py-5">
    <div class="container bg--yellow p-4">
        <ul class="text-larger mb-0">
            <?php
            while(have_rows('list_items')) {
                the_row();
                echo '<li>' . get_sub_field('list_item') . '</li>';
            }
            ?>
        </ul>
    </div>
</section>