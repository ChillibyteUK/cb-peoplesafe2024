<!-- faq -->
<section class="faq py-5">
    <div class="container position-relative">
        <?php
            if (get_field('faq_title')) {
                echo '<h2 class="h2 mb-4">' . get_field('faq_title') . '</h2>';
            }
            echo '<div itemscope="" itemtype="https://schema.org/FAQPage" id="accordion' .  $accordion . '" class="accordion accordion-flush">';
            $counter = 0;
            $show = '';
            $collapsed = 'collapsed';
            while (have_rows('faqs')) {
                the_row();
                $ac = $accordion . '_' . $counter;
                ?>
                <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question" class="accordion-item">
                    <div class="accordion-head accordion-collapse <?=$collapsed?>" itemprop="name" data-bs-toggle="collapse" id="heading_<?=$ac?>" data-bs-target="#c<?=$ac?>" role="button" aria-expanded="true" aria-controls="c<?=$ac?>">
                        <div class="pb-1"><?=get_sub_field('question')?></div>
                    </div>
                    <div class="collapse <?=$show?>" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" id="c<?=$ac?>" aria-labelledby="heading_<?=$ac?>" data-bs-parent="#accordion<?=$accordion?>">
                        <div itemprop="text" class="faq__answer mb-4">
                            <p><?=get_sub_field('answer')?></p>
                        </div>
                    </div>
                </div>
                <?php
                $counter++;
                $show = '';
                $collapsed = 'collapsed';
            }
            echo '</div>';
        ?>
    </div>
</section>