<!-- turtl_link -->
<section class="turtl_link py-5">
    <div class="container">
        <?=get_field('embed_code')?>
    </div>
</section>
<?php
add_action('wp_footer',function(){
    ?>
<script async type="text/javascript" data-turtl-script="embed" data-turtl-assets-hostname="https://assets.turtl.co" src="https://app-static.turtl.co/embed/turtl.embed.v1.js"></script>
    <?php
});