<?php
$bg = get_field('background');
$bo = get_field('breakout')[0] == 'Yes' ? 'break-out my-4 py-4' : '';
?>
<!-- breakout -->
<section class="<?=$bo?> <?=$bg?>">
    <div class="container-xl">
        <?=apply_filters('the_content',get_field('content'))?>
    </div>
</section>