<?php
/**
 * The template for displaying search results pages
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main" class="pt-5">
    <div class="container py-3">
        <?php
        if ( have_posts() ) {
            ?>
            <h1 class="mb-4">
                <?php
                printf(
                    /* translators: %s: query term */
                    esc_html__( 'Search Results for: %s', 'understrap' ),
                    '<span>' . get_search_query() . '</span>'
                );
                ?>
            </h1>
            <div>
            <?php
            $ptypes = array(
                'post' => 'Blog',
                'page' => 'Page',
                'news' => 'News',
                'guides' => 'Guide',
                'case_studies' => 'Case Study',
                'whitepapers' => 'Whitepaper',
                'legislation' => 'Legislation',
                'products' => 'Product',
                'partnerships' => 'Partnership',
                'accreditations' => 'Accreditation',
                'stories' => 'User Story',
                'careers' => 'Career',
            );
            while ( have_posts() ) {
                the_post();
                ?>
                <a href="<?=get_permalink()?>" class="text-dark noline">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="ptype <?=get_post_type()?>"><?=$ptypes[get_post_type()]?></div>
                    </div>
                    <div class="col-sm-10">
                        <h2 class="h4"><?=get_the_title()?></h2>
                    <?php
                    if ( 'post' === get_post_type() ) {
                        ?>
                        <div class="entry-meta">
                            Posted on <?=get_the_date('j M, Y')?>
                        </div><!-- .entry-meta -->
                        <?php
                    }
                    ?>
                        <div class="entry-summary">
                            <?=wp_trim_words(get_the_content(),20)?>
                        </div><!-- .entry-summary -->
                    </div>
                </div>
                </a>
                <hr/>
                <?php
            }
            ?>
            </div>
            <?php
        }
        else {
            get_template_part( 'loop-templates/content', 'none' );
        }
        ?>
        <!-- The pagination component -->
        <?php numeric_posts_nav(); ?>
	</div><!-- #content -->
</main><!-- #search-wrapper -->
<?php
get_footer();
