<?php
?>
<style>
.cb_team_details {
    background-color: rgba(7, 191, 169, 0.8);
    top: auto;
    bottom: 0;
    left: 15px;
    right: 15px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.cb_team_name,
.cb_team_role {
    font-size: 1.4rem;
    font-family: 'Basis Grotesque Pro', sans-serif;
    font-weight: 700;
}

.cb_team_role {
    font-size: 1.2rem;
}

@media (min-width: 992px) {
    .cb_team_details {
        display: none;
    }

    .cb_team .col:hover > .cb_team_details {
        display: flex; 
    }

    .cb_team_details {
        top: 0;
    }
}
</style>
<section class="cb_team">
    <div class="container">
        <div class="row g-5">
<?php
if( have_rows('person') ):
    while( have_rows('person') ) : the_row();
        $image = get_sub_field('photo');
        if( !empty( $image ) ): ?>
            <div class="col col-12 col-md-4 position-relative mb-3 mb-lg-0">
                <div class="photo"><img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="img-fluid w-100" /></div>
                <div class="cb_team_details position-absolute">
                    <div class="cb_team_name text-center text-white mt-2 mt-lg-0"><?=get_sub_field('name')?></div>
                    <div class="cb_team_role text-center text-white mb-3 mb-lg-0"><?=get_sub_field('role')?></div>
                </div>
            </div>
<?php
        endif;
    endwhile;
endif;
?>
        </div>
    </div>

</section>