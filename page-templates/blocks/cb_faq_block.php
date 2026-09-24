<!-- faq -->
<section class="faq py-5">
    <div class="container-xl">
        <?php
            if (get_field('faq_title')) {
                echo '<h2 class="h2 mb-4">' . get_field('faq_title') . '</h2>';
            }
        // NOTE: FAQ schema is output as JSON-LD in Yoast's graph (see inc/cb-schema.php),
        // so the itemscope/itemprop microdata has been removed to avoid duplicate FAQ schema.
        echo '<div id="accordion">';
        $counter = 0;
        $show = 'show';
        $collapsed = '';
        $c = 0;
        while (have_rows('faq')) {
            the_row();
            $border = $counter == 0 ? 'border-top' : '';
            echo '<div data-aos="fade" data-aos-delay="' . $c . '" class="py-4 border-bottom ' . $border . '">';
            echo '  <h3 class="question ' . $collapsed . '" data-bs-toggle="collapse" id="heading_' . $counter . '" data-bs-target="#collapse_' . $counter . '" aria-expanded="true" aria-controls="collapse_' . $counter . '">' . get_sub_field('question') . '</h3>';
            echo '  <div class="answer collapse ' . $show . '" id="collapse_' . $counter . '" aria-labelledby="heading_' . $counter . '" data-bs-parent="#accordion"><div class="pt-2">' . apply_filters('the_content', get_sub_field('answer')) . '</div></div>';
            echo '</div>';
            $counter++;
            $show = '';
            $collapsed = 'collapsed';
            $c += 100;
        }
        echo '</div>';
        ?>
    </div>
</section>