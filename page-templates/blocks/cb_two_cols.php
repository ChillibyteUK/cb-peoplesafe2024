<?php
$theme = get_field('theme');

$bg = $theme != 'white' ? 'bg--' . $theme : '';
?>
<!-- two_cols -->
<section class="two_cols py-5 <?=$bg?>">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?=apply_filters( 'the_content', get_field('left_content') )?>
            </div>
            <div class="col-md-6">
                <?=apply_filters( 'the_content', get_field('right_content') )?>
            </div>
        </div>
    </div>
</section>