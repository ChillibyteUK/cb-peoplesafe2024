<!-- tech_nav -->
<section class="tech_nav py-5 py-md-0">
    <div class="container">
        <div class="row">
            <div class="col-md-3 d-flex justify-content-center align-items-center">
                <h2>Choose your solution</h2>
            </div>
            <div class="col-md-3">
                <a href="/safety-devices/" class="tech_nav__col">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/safety-devices.png" class="img-fluid tech_nav__image">
                    <div class="tech_nav__title">
                        Safety devices
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="<?=esc_url( add_query_arg('q', 'safety-apps', site_url('/products/') ) )?>" class="tech_nav__col">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/safety-apps.png" class="img-fluid tech_nav__image">
                    <div class="tech_nav__title">
                        Safety apps
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="/products/peoplesafe-alert/" class="tech_nav__col">
                    <img src="<?=get_stylesheet_directory_uri()?>/img/ps-alert3.png" class="img-fluid tech_nav__image">
                    <div class="tech_nav__title">
                        Safety notifications
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>