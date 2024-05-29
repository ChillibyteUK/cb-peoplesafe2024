<?php
$file = get_field('file');
?>
<section class="file_download py-5">
    <div class="container">
        <a href="<?=$file['url']?>" target="_blank" class="btn btn-primary"><i class="fas fa-file-pdf"></i> <?=get_field('button_title')?></a>
    </div>
</section>