<?php
$theme = get_field('theme');
$padding = get_field('theme') == 'light' ? 'py-5' : 'px-4 py-5 my-4';
?>
<!-- big_quote -->
<section class="big_quote <?=$padding?> bg--<?=$theme?>">
    <div class="container">
        <div class="big_quote__quote"><?=get_field('quote')?></div>
        <div class="big_quote__attrib"><?=get_field('attribution')?></div>
    </div>
</section>