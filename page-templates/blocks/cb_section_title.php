<?php
$bg = get_field('theme') == 'Dark' ? 'bg--navy' : '';
?>
<!-- section_title -->
<section class="section_title py-5 <?=$bg?>">
    <div class="container text-center">
        <h2 class="mb-0 d-flex flex-wrap justify-content-center"><?=get_field('title')?></h2>
    </div>
</section>