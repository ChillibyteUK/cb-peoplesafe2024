<?php
$bg = get_field('background');
?>
<!-- breakout -->
<div class="break-out <?=$bg?>">
    <div class="container-xl">
        <?=apply_filters('the_content',get_field('content'))?>
    </div>
</div>