<?php
$class = $block['className'] ?? 'my-4'
?>
<div class="container d-flex flex-wrap justify-content-center <?= $class ?>">
    <?php
    while ( have_rows( 'buttons' ) ) {
        the_row();
        $link = get_sub_field( 'link' );
        $style = get_sub_field( 'style' );

        switch ( $style ) {
            case 'outline':
                $style = 'button-outline';
                break;
            default:
                $style = 'button-yellow';
        }


        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';

        $link_class = 'button ' . $style . ' mb-2 me-2';

        echo '<a href="' . esc_url( $link_url ) . '" class="' . esc_attr( $link_class ) . '" target="' . esc_attr( $link_target ) . '">' . esc_html( $link_title ) . '</a>';
    }
    ?>
</div>