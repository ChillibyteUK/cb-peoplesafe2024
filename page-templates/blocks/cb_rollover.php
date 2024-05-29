<!-- rollover -->
<section class="rollover bg--navy">
    <div class="rollover">
        <div class="rollover__backgrounds">
            <div class="rollover__image">
                <img src="<?=wp_get_attachment_image_url( get_field('image_1'), 'full' )?>">
            </div>
            <div class="rollover__image">
                <img src="<?=wp_get_attachment_image_url( get_field('image_2'), 'full' )?>">
            </div>
            <div class="rollover__image">
                <img src="<?=wp_get_attachment_image_url( get_field('image_3'), 'full' )?>">
            </div>
        </div>
        <div class="rollover__list">
            <div class="rollover__item" onclick="javascript:location.href='<?=get_field('link_1')['url']?>'">
                <div class="rollover__itembg">
                    <img src="<?=wp_get_attachment_image_url( get_field('image_1'), 'full' )?>">
                </div>
                <div class="rollover__content"><?=get_field('link_1')['title']?></div>
            </div>
            <div class="rollover__item" onclick="javascript:location.href='<?=get_field('link_2')['url']?>'">
                <div class="rollover__itembg">
                    <img src="<?=wp_get_attachment_image_url( get_field('image_2'), 'full' )?>">
                </div>
                <div class="rollover__content"><?=get_field('link_2')['title']?></div>
            </div>
            <div class="rollover__item" onclick="javascript:location.href='<?=get_field('link_3')['url']?>'">
                <div class="rollover__itembg">
                    <img src="<?=wp_get_attachment_image_url( get_field('image_3'), 'full' )?>">
                </div>
                <div class="rollover__content"><?=get_field('link_3')['title']?></div>
            </div>
        </div>
    </div>
</section>
<?php
add_action('wp_footer',function(){
    ?>
<script>
(function($){
    var all = $(document).find('.rollover'),
        list = all.find('.rollover__list'),
        item = list.find('.rollover__item'),
        bgs = all.find('.rollover__backgrounds'),
        bg = bgs.find('.rollover__image');

    item.on('mouseenter',function(){
        var t = $(this),
            ix = t.index(),
            is = t.siblings('.rollover__item');
            add_opacity(is),
            current_background(ix, bg)
        }).on('mouseleave',function(){
            remove_opacity(item)
        }),
    list.on('mouseenter',function(){
        list.addClass('is-active');
        bgs.addClass('is-active')
        }).on('mouseleave',function(){
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
},1000);