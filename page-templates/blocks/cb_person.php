<section class="person">
    <div class="container border-bottom pt-5 pb-4">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="<?=wp_get_attachment_image_url(get_field('image'), 'large')?>" class="img-fluid mb-4 mb-md-0">
            </div>
            <div class="col-md-8">
                <h2 class="mb-0"><?=get_field('name')?></h2>
                <h3 class="h4"><?=get_field('title')?></h3>
                <div><?=get_field('bio')?></div>
                <?php
                if (get_field('contact')) {
                    $c = get_field('contact');
                    if ($c['phone']) {
                        echo '<i class="fas fa-phone-alt"></i> <a href="tel:' . parse_phone($c['phone']) . '">' . $c['phone'] . '</a><br/>';
                    }
                    if ($c['email']) {
                        echo '<i class="fas fa-envelope"></i> <a href="mailto:' . $c['email'] . '">' . $c['email'] . '</a><br/>';
                    }
                    if ($c['linkedin']) {
                        echo '<i class="fab fa-linkedin-in"></i> <a href="' . $c['linkedin'] . '" target="_blank"> LinkedIn</a><br/>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>