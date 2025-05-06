<?php
function acf_blocks()
{
    if (function_exists('acf_register_block')) {
        acf_register_block(array(
            'name'                => 'cb_hero',
            'title'                => __('CB Hero'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_image_hero.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'keywords'            => array('image', 'hero'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'             => 'CB Latest Posts Author',
            'title'                => __('CB Latest Posts Author'),
            'description'      => __(''),
            'render_template'  => 'page-templates/blocks/cb_latest_posts_author.php',
            'category'         => 'layout',
            'icon'             => 'excerpt-view',
            'keywords'         => array('latest', 'posts'),
            'mode' => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_infographics',
            'title'                => __('CB Infographics'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_infographics.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'keywords'            => array('infographics'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_text_image',
            'title'                => __('CB Text/Image'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_text_image.php',
            'category'            => 'layout',
            'icon'                => 'align-pull-right',
            'keywords'            => array('text', 'image'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_text_video',
            'title'                => __('CB Text/Video'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_text_video.php',
            'category'            => 'layout',
            'icon'                => 'embed-video',
            'keywords'            => array('text', 'video'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Text w Image Background',
            'title'                => __('CB Text w Image Background'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_text_imagebg.php',
            'category'            => 'layout',
            'icon'                => 'embed-photo',
            'keywords'            => array('text', 'image', 'background'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_faq_block',
            'title'                => __('CB FAQ'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_faq_block.php',
            'category'            => 'layout',
            'icon'                => 'list-view',
            'keywords'            => array('faq', 'block'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_gradient_cta',
            'title'                => __('CB Gradient CTA'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_gradient_cta.php',
            'category'            => 'layout',
            'icon'                => 'button',
            'keywords'            => array('gradient', 'cta'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_gradient_pushthrough',
            'title'                => __('CB Gradient Pushthrough'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_gradient_pushthrough.php',
            'category'            => 'layout',
            'icon'                => 'button',
            'keywords'            => array('gradient', 'pushthrough'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_section_title',
            'title'                => __('CB Section Title'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_section_title.php',
            'category'            => 'layout',
            'icon'                => 'heading',
            'keywords'            => array('section', 'title'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Rollover Nav',
            'title'                => __('CB Rollover Nav'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_rollover.php',
            'category'            => 'layout',
            'icon'                => 'networking',
            'keywords'            => array('rollover', 'nav'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Rollover Two',
            'title'                => __('CB Rollover Two'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_rollover_two.php',
            'category'            => 'layout',
            'icon'                => 'networking',
            'keywords'            => array('rollover', 'two'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Not Rollover Nav',
            'title'                => __('CB Not Rollover Nav'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_not_rollover.php',
            'category'            => 'layout',
            'icon'                => 'networking',
            'keywords'            => array('not', 'rollover', 'nav'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'             => 'CB Shop',
            'title'                => __('CB Shop'),
            'description'      => __(''),
            'render_template'  => 'page-templates/blocks/cb_shop.php',
            'category'         => 'layout',
            'icon'             => 'networking',
            'keywords'         => array('shop'),
            'mode' => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'             => 'CB Technology Nav',
            'title'                => __('CB Technology Nav'),
            'description'      => __(''),
            'render_template'  => 'page-templates/blocks/cb_tech_nav.php',
            'category'         => 'layout',
            'icon'             => 'networking',
            'keywords'         => array('tech', 'nav'),
            'mode' => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Lone Worker Block',
            'title'                => __('CB Lone Worker Block'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_tech_nav--lone-worker.php',
            'category'            => 'layout',
            'icon'                => 'networking',
            'keywords'            => array('tech', 'nav', 'lone', 'worker'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Configurable Tech Nav Block (2 col)',
            'title'                => __('CB Configurable Tech Nav Block (2 col)'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_tech_nav--2-up-configurable.php',
            'category'            => 'layout',
            'icon'                => 'networking',
            'keywords'            => array('tech', 'nav', 'configurable'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Clients Slider',
            'title'                => __('CB Clients Slider'),
            'description'        => __('Case studies having logos'),
            'render_template'    => 'page-templates/blocks/cb_clients_slider.php',
            'category'            => 'layout',
            'icon'                => 'slides',
            'keywords'            => array('clients', 'slider'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Logo Slider',
            'title'                => __('CB Logo Slider'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_logo_slider.php',
            'category'            => 'layout',
            'icon'                => 'slides',
            'keywords'            => array('logo', 'slider'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Stat Spinner',
            'title'                => __('CB Stat Spnner'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_stat_spinner.php',
            'category'            => 'layout',
            'icon'                => 'performance',
            'keywords'            => array('stat', 'spinner'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Product Header',
            'title'                => __('CB Product Header'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_product_header.php',
            'category'            => 'layout',
            'icon'                => 'align-left',
            'keywords'            => array('feature'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Feature Block',
            'title'                => __('CB Feature Block'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_feature_block.php',
            'category'            => 'layout',
            'icon'                => 'list-view',
            'keywords'            => array('feature'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Feature List',
            'title'                => __('CB Feature List'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_feature_list.php',
            'category'            => 'layout',
            'icon'                => 'list-view',
            'keywords'            => array('feature', 'list'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Big Quote',
            'title'                => __('CB Big Quote'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_big_quote.php',
            'category'            => 'layout',
            'icon'                => 'quote',
            'keywords'            => array('big', 'quote'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Big Quote Slider',
            'title'                => __('CB Big Quote Slider'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_big_quote_slider.php',
            'category'            => 'layout',
            'icon'                => 'quote',
            'keywords'            => array('big', 'quote', 'slider'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB File Download',
            'title'                => __('CB File Download'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_file_download.php',
            'category'            => 'layout',
            'icon'                => 'download',
            'keywords'            => array('file', 'download'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Sector Nav',
            'title'                => __('CB Sector Nav'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_sector_nav.php',
            'category'            => 'layout',
            'icon'                => 'networking',
            'keywords'            => array('sector', 'nav'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Container',
            'title'                => __('CB Container'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_container.php',
            'category'            => 'layout',
            'icon'                => 'text',
            'keywords'            => array('container'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Related Products',
            'title'                => __('CB Related Products'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_related_products.php',
            'category'            => 'layout',
            'icon'                => 'slides',
            'keywords'            => array('related', 'products'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Related Case Studies',
            'title'                => __('CB Related Case Studies'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_related_case_studies.php',
            'category'            => 'layout',
            'icon'                => 'slides',
            'keywords'            => array('related', 'case', 'studies'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Related Resources',
            'title'                => __('CB Related Resources'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_related_resources.php',
            'category'            => 'layout',
            'icon'                => 'slides',
            'keywords'            => array('related', 'resources'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Case Study User Story Combo',
            'title'                => __('CB Case Study User Story Combo'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_case_user_combo.php',
            'category'            => 'layout',
            'icon'                => 'table',
            'keywords'            => array('case', 'study', 'user', 'story', 'combo'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Breadcrumbs',
            'title'                => __('CB Breadcrumbs'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_breadcrumbs.php',
            'category'            => 'layout',
            'icon'                => 'links',
            'keywords'            => array('breadcrumbs'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Two Cards',
            'title'                => __('CB Two Cards'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_two_cards.php',
            'category'            => 'layout',
            'icon'                => 'columns',
            'keywords'            => array('two', 'cards'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Banner',
            'title'                => __('CB Banner'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_banner.php',
            'category'            => 'layout',
            'icon'                => 'slides',
            'keywords'            => array('banner'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Gallery',
            'title'                => __('CB Gallery'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_gallery.php',
            'category'            => 'layout',
            'icon'                => 'gallery',
            'keywords'            => array('gallery'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Turtl Link',
            'title'                => __('CB Turtl Link'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_turtl_link.php',
            'category'            => 'layout',
            'icon'                => 'image',
            'keywords'            => array('turtl', 'link'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Person',
            'title'                => __('CB Person'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_person.php',
            'category'            => 'layout',
            'icon'                => 'users',
            'keywords'            => array('person'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Latest Posts',
            'title'                => __('CB Latest Posts'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_latest_posts.php',
            'category'            => 'layout',
            'icon'                => 'excerpt-view',
            'keywords'            => array('latest', 'posts'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Guides',
            'title'                => __('CB Guides'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_guides.php',
            'category'            => 'layout',
            'icon'                => 'excerpt-view',
            'keywords'            => array('latest', 'guides'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Two Columns',
            'title'                => __('CB Two Columns'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_two_cols.php',
            'category'            => 'layout',
            'icon'                => 'columns',
            'keywords'            => array('two', 'columns'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Featured In',
            'title'                => __('CB Featured In'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_featured_in.php',
            'category'            => 'layout',
            'icon'                => 'columns',
            'keywords'            => array('featured', 'in'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Timeline',
            'title'                => __('CB Timeline'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_timeline.php',
            'category'            => 'layout',
            'icon'                => 'columns',
            'keywords'            => array('timeline'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Benefits / Text',
            'title'                => __('CB Benefits / Text'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_benefits_text.php',
            'category'            => 'layout',
            'icon'                => 'columns',
            'keywords'            => array('benefits', 'text'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Benefits / Video',
            'title'                => __('CB Benefits / Video'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_benefits_video.php',
            'category'            => 'layout',
            'icon'                => 'columns',
            'keywords'            => array('benefits', 'video'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Case Study Quote Slider',
            'title'                => __('CB Case Study Quote Slider'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_testimonial_slider.php',
            'category'            => 'layout',
            'icon'                => 'columns',
            'keywords'            => array('case', 'study', 'quote', 'slider'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Three Col Cards',
            'title'                => __('CB Three Col Cards'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_three_col_cards.php',
            'category'            => 'layout',
            'icon'                => 'columns',
            'keywords'            => array('three', 'column', 'cards'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Newsletter Signup Block',
            'title'                => __('CB Newsletter Signup Block'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_newsletter_signup.php',
            'category'            => 'layout',
            'icon'                => 'columns',
            'keywords'            => array('newsletter', 'signup'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Media Block',
            'title'                => __('CB Media Block'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_media_block.php',
            'category'            => 'layout',
            'icon'                => 'columns',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Gated Modal',
            'title'                => __('CB Gated Modal'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_gated_modal.php',
            'category'            => 'layout',
            'icon'                => 'columns',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'              => 'CB Banner Slideshow',
            'title'             => __('CB Banner Slideshow'),
            'description'       => __(''),
            'render_template'   => 'page-templates/blocks/cb_banner_slideshow.php',
            'category'          => 'layout',
            'icon'              => 'columns',
            'mode'  => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'              => 'CB Team',
            'title'             => __('CB Team'),
            'description'       => __(''),
            'render_template'   => 'page-templates/blocks/cb_team.php',
            'category'          => 'layout',
            'icon'              => 'columns',
            'mode'  => 'edit',
            'supports' => array(
                'mode' => false,
                'switch_mode' => false,
            ),
        ));

        // 2024 Blocks below

        acf_register_block(array(
            'name'                => 'cb_home_hero_2024',
            'title'                => __('CB Homepage Hero (2024)'),
            'render_template'    => 'page-templates/blocks_2024/cb_home_hero_2024.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array(
                'mode' => false,
                'switch_mode' => false,
            ),
        ));
        acf_register_block(array(
            'name'                => 'cb_hero_2024',
            'title'                => __('CB Hero (2024)'),
            'render_template'    => 'page-templates/blocks_2024/cb_hero_2024.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_text_image_2024',
            'title'                => __('CB Text Image (2024)'),
            'render_template'    => 'page-templates/blocks_2024/cb_text_image_2024.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_case_study_quotes_2024',
            'title'                => __('CB Case Study / Quotes (2024)'),
            'render_template'    => 'page-templates/blocks_2024/cb_case_study_quotes_2024.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_spinner_2024',
            'title'                => __('CB Stat Spinner (2024)'),
            'render_template'    => 'page-templates/blocks_2024/cb_spinner_2024.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_latest_2024',
            'title'                => __('CB Latest News (2024)'),
            'render_template'    => 'page-templates/blocks_2024/cb_latest_2024.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_product_header_2024',
            'title'                => __('CB Product Header (2024)'),
            'render_template'    => 'page-templates/blocks_2024/cb_product_header_2024.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_top_tab_group_2024',
            'title'                => __('CB Top Tab Group (2024)'),
            'render_template'    => 'page-templates/blocks_2024/cb_top_tab_group_2024.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_side_tab_group_2024',
            'title'                => __('CB Side Tab Group (2024)'),
            'render_template'    => 'page-templates/blocks_2024/cb_side_tab_group_2024.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_text_video_2024',
            'title'                => __('CB Text Video (2024)'),
            'render_template'    => 'page-templates/blocks_2024/cb_text_video_2024.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_case_user_combo_2024',
            'title'                => __('CB Case Study / User Stories Combo (2024)'),
            'render_template'    => 'page-templates/blocks_2024/cb_case_user_combo_2024.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_big_quote_slider_2024',
            'title'                => __('CB Big Quote Slider (2024)'),
            'render_template'    => 'page-templates/blocks_2024/cb_big_quote_slider_2024.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_contact_2024',
            'title'                => __('CB Contact Cards (2024)'),
            'render_template'    => 'page-templates/blocks_2024/cb_contact_2024.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_solutions_nav_2024',
            'title'                => __('CB Solutions Nav (2024)'),
            'render_template'    => 'page-templates/blocks_2024/cb_solutions_nav_2024.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Caption Slider 2024',
            'title'                => __('CB Caption Slider 2024'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks_2024/cb_caption_slider_2024.php',
            'category'            => 'layout',
            'icon'                => 'slides',
            'keywords'            => array('caption', 'slider'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Buttons',
            'title'                => __('CB Buttons'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks_2024/cb_buttons.php',
            'category'            => 'layout',
            'icon'                => 'slides',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
    }
}
add_action('acf/init', 'acf_blocks');

// remove the default buttons component.
add_filter('allowed_block_types_all', function($allowed_blocks, $editor_context) {
	if (!empty($editor_context->post)) {
		$blocked = [
			'core/buttons', // this is the parent wrapper
			'core/button',  // this is the inner block
		];
		$allowed_blocks = array_diff($allowed_blocks, $blocked);
	}
	return $allowed_blocks;
}, 10, 2);

// Gutenburg core modifications
add_filter('register_block_type_args', 'core_image_block_type_args', 10, 3);
function core_image_block_type_args($args, $name)
{
    if ($name == 'core/paragraph') {
        $args['render_callback'] = 'modify_core_add_container';
    }
    if ($name == 'core/heading') {
        $args['render_callback'] = 'modify_core_add_container';
    }
    if ($name == 'core/list') {
        $args['render_callback'] = 'modify_core_add_container';
    }
    if ($name == 'core/table') {
        $args['render_callback'] = 'modify_core_add_container';
    }

    return $args;
}

function modify_core_add_container($attributes, $content)
{
    ob_start();
    // $class = $block['className'];
?>
    <div class="container-xl">
        <?= $content ?>
    </div>
<?php
    $content = ob_get_clean();
    return $content;
}
?>