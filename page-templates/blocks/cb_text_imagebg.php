<?php
$offset = (get_field('order') == 'text_left') ? '' : 'offset-lg-6';
$bg = wp_get_attachment_image_url(get_field('background'), 'full');
?>    
<!-- text_imagebg -->
<section class="text_imagebg py-5" style="background-image:url(<?=$bg?>)">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text_image__content <?=$offset?>">
                <?=get_field('content')?>
            </div>
        </div>
    </div>
</section>