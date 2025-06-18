<?php
$bg = null;
?>    
<!-- hero_2024 -->
<section class="hero_2024 d-flex">
    <div class="container-xl my-auto">
        <div class="row">
            <div class="col-lg-8 hero_2024__content d-flex justify-content-center flex-column order-2 order-lg-1">
                <div class="inner">
                    <h1>
                        <div class="text-dark">
                            <?=get_field('title')?>
                        </div>
                        <div class="hero_2024__text_anim_container">
                            <span>Wherever.</span>
                            <span>Whenever.</span>
                        </div>
                    </h1>
                    <div class="hero__content mb-4"><?=get_field('content')?></div>
                    <?php
                    if (get_field('cta_book_a_demo')) {
                        ?>
                    <button type="button" class="button button-yellow mb-2 me-2 text-center w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#demoModal"><span>Book a Demo</span></button>
                        <?php
                    }
                    else if (get_field('cta')) {
                        $cta = get_field('cta');
                        ?>
                    <a class="button button-yellow mb-2 me-2 text-center w-100 w-md-auto" href="<?=$cta['url']?>" target="<?=$cta['target']?>"><span><?=$cta['title']?></span></a>
                        <?php
                    }
                    if (get_field('cta2')) {
                        $cta2 = get_field('cta2');
                        ?>
                    <a class="button button-outline mb-2 me-2 text-center w-100 w-md-auto" href="<?=$cta2['url']?>" target="<?=$cta2['target']?>"><?=$cta2['title']?></a>
                        <?php
                    }
                    if (get_field('modal_cta') != '') {
                        $id = get_field('modal_cta');
                        ?>
                    <button type="button" class="button button-yellow mb-2 text-center w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#<?=$id?>"><span>Watch Video</span></button>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-4 order-1 order-lg-2 d-none d-sm-block">
                <div class="heroAnim">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/2024/heroAnim/circle.png" alt="" class="circle">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/2024/heroAnim/dots.png" alt="" class="dots">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/2024/heroAnim/gradient.png" alt="" class="gradient">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/2024/heroAnim/shakira.png" alt="" class="shakira">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/2024/heroAnim/laptop.png" alt="" class="laptop">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/2024/heroAnim/phone1.png" alt="" class="phone1">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/2024/heroAnim/phone2.png" alt="" class="phone2">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/2024/heroAnim/phone3.png" alt="" class="phone3">
                </div>
            </div>
            <div class="col-lg-4 order-1 order-lg-2 d-sm-none">
                <img src="/wp-content/uploads/2025/06/Peoplesafe-Hero-Image-Mobile-1.png" alt="Protect your people" class="img-fluid nolazy" width="548" height="524">
            </div>
        </div>
    </div>
</section>