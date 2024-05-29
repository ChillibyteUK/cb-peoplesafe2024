<style>
    .drollover {
        height: 570px;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        outline: 0;
    }

    @media (min-width: 992px) {
        .drollover {
            height: 390px;
        }
    }

    .drollover__backgrounds,
    .drollover__image,
    .drollover__list {
        position: absolute;
        top: 0;
        left: 0;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 100%;
        height: 100%;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        z-index: 1;
    }

    @media (min-width: 992px) {

        .drollover__backgrounds,
        .drollover__image,
        .drollover__list {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }
    }

    .drollover__image {
        -webkit-transition: opacity 0.4s ease;
        transition: opacity 0.4s ease;
        opacity: 0;
        z-index: 0;
    }

    .drollover__image .doverlay {
        position: absolute;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: -1;
    }

    .drollover__image img {
        z-index: -2;
    }

    .drollover__image .words {
        height: 100%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        z-index: 999;
        font-size: 1rem;
        color: white;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        width: 600px;
    }

    .drollover__image .words--right {
        margin-left: auto;
    }

    .drollover__image img,
    .drollover__itembg img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100% !important;
        height: 100% !important;
        -o-object-fit: cover;
        object-fit: cover;
    }

    .drollover__list::before {
        left: calc(100% / 2);
    }

    .drollover__list::before,
    .drollover__list::after {
        position: absolute;
        z-index: 1;
        top: 0;
        width: 1px;
        height: 100%;
        content: '';
        -webkit-transition: background-color 0.4s ease;
        transition: background-color 0.4s ease;
    }

    .drollover__list::after {
        position: absolute;
        left: calc((100% / 2) * 2);
    }

    .drollover__item {
        position: relative;
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        overflow: hidden;
        width: 100%;
        height: 190px;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }

    @media (min-width: 992px) {
        .drollover__item {
            width: calc(100% / 2);
            height: 100%;
        }
    }

    .drollover__itembg {
        position: absolute;
        z-index: -1;
        top: 0;
        left: 0;
        width: 200%;
        height: 100%;
        -webkit-transition: opacity 0.4s ease;
        transition: opacity 0.4s ease;
        background-color: #010101;
    }

    .drollover__item:nth-of-type(2) .drollover__itembg {
        left: -100%;
    }

    .drollover__content {
        width: 100%;
        padding: 0 30px;
        -webkit-transition: opacity 0.4s ease;
        transition: opacity 0.4s ease;
        text-align: center;
        color: #fff;
        font-size: 3rem;
        letter-spacing: 0.2em;
        line-height: 1.2;
    }

    @media (min-width: 992px) {

        .drollover__list.is-active::after,
        .drollover__list.is-active::before {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .drollover__image.is-active {
            opacity: 1;
        }

        .is-opacity .drollover__itembg {
            opacity: 0;
        }

        .is-opacity .drollover__content {
            opacity: 0;
        }
    }

    .static {
        min-height: 400px;
        color: white;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        padding: 2rem 1rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        z-index: 0;
    }

    .static__title {
        text-align: center;
        font-size: 3rem;
        letter-spacing: 0.2em;
        line-height: 1.2;
        margin-bottom: 2rem;
    }

    .static .doverlay {
        position: absolute;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: -1;
    }

    .static__content {}
</style>

<!-- rollover -->
<div class="drollover d-none d-lg-block">
    <div class="drollover__backgrounds">
        <div class="drollover__image">
            <div class="doverlay"></div>
            <img
                src="<?=wp_get_attachment_image_url(get_field('image_1'), 'full')?>">
            <div class="row h-100">
                <div class="col-md-6 offset-md-6">
                    <div class="words">
                        <?=get_field('content_1')?>
                    </div>
                </div>
            </div>
        </div>
        <div class="drollover__image">
            <div class="doverlay"></div>
            <img
                src="<?=wp_get_attachment_image_url(get_field('image_2'), 'full')?>">
            <div class="row h-100">
                <div class="col-md-6">
                    <div class="words words--right">
                        <?=get_field('content_2')?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="drollover__list">
        <div class="drollover__item">
            <div class="drollover__itembg">
                <img
                    src="<?=wp_get_attachment_image_url(get_field('image_1'), 'full')?>">
            </div>
            <div class="drollover__content">
                <?=get_field('title_1')?>
            </div>
        </div>
        <div class="drollover__item">
            <div class="drollover__itembg">
                <img
                    src="<?=wp_get_attachment_image_url(get_field('image_2'), 'full')?>">
            </div>
            <div class="drollover__content">
                <?=get_field('title_2')?>
            </div>
        </div>
    </div>
</div>
<div class="d-lg-none">
    <div class="static"
        style="background-image:url(<?=wp_get_attachment_image_url(get_field('image_1'), 'full')?>)">
        <div class="doverlay"></div>
        <div class="static__title">
            <?=get_field('title_1')?>
        </div>
        <div class="static__content">
            <?=get_field('content_1')?>
        </div>
    </div>
    <div class="static"
        style="background-image:url(<?=wp_get_attachment_image_url(get_field('image_2'), 'full')?>)">
        <div class="doverlay"></div>
        <div class="static__title">
            <?=get_field('title_2')?>
        </div>
        <div class="static__content">
            <?=get_field('content_2')?>
        </div>
    </div>
</div>
<?php
add_action('wp_footer', function () {
    ?>
<script>
    (function($) {
        var all = $(document).find('.drollover'),
            list = all.find('.drollover__list'),
            item = list.find('.drollover__item'),
            bgs = all.find('.drollover__backgrounds'),
            bg = bgs.find('.drollover__image');

        item.on('mouseenter', function() {
                var t = $(this),
                    ix = t.index(),
                    is = t.siblings('.drollover__item');
                add_opacity(is),
                    current_background(ix, bg)
            }).on('mouseleave', function() {
                remove_opacity(item)
            }),
            list.on('mouseenter', function() {
                list.addClass('is-active');
                bgs.addClass('is-active')
            }).on('mouseleave', function() {
                list.removeClass('is-active'),
                    bg.removeClass('is-active'),
                    bgs.removeClass('is-active')
            });

        function add_opacity(t) {
            t.each(function() {
                $(this).addClass('is-opacity')
            })
        }

        function current_background(e, t) {
            t.removeClass('is-active'),
                t.eq(e).addClass('is-active')
        }

        function remove_opacity(e) {
            e.removeClass('is-opacity')
        }
    })(jQuery);
</script>
<?php
}, 1000);
                ?>