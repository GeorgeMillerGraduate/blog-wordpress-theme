<?php
/**
 * jenga-code - Standard Page Template
 *
 * Displays standard WordPress pages within the custom jenga-code
 * WordPress theme.
 *
 * WordPress uses this template for ordinary static pages such as
 * informational content, documentation and other pages that do not
 * require a more specialised template.
 *
 * The template maintains the same visual structure and branding as
 * the wider jenga-code website and WordPress blog.
 *
 * The page provides:
 * - jenga-code branding
 * - Dynamic WordPress page titles
 * - Optional page excerpts
 * - Optional featured images
 * - Full WordPress page content
 * - Multi-page content navigation
 * - Administrative edit links when available
 * - WordPress comments when enabled
 * - A fallback when no page content is available
 * - The shared jenga-code sidebar
 *
 * @package JengaCode
 */


/*
 * Prevent this template from being executed directly outside
 * the WordPress environment.
 */
if (!defined('ABSPATH')) {
    exit;
}


/*
 * Load the shared jenga-code header from header.php.
 */
get_header();
?>


<!-- =====================================================
     JENGA-CODE
     STANDARD WORDPRESS PAGE
     ===================================================== -->

<main class="standard-page">

    <!--
        Main standard-page layout.

        Separates the primary WordPress page content from the
        shared jenga-code sidebar while supporting the responsive
        layout defined by the theme stylesheets.
    -->
    <div class="standard-page-layout">


        <!-- =================================================
             MAIN PAGE CONTENT
             ================================================= -->

        <section class="standard-page-content">


            <!--
                Check whether WordPress has returned page content
                for the current request.
            -->
            <?php if (have_posts()) : ?>


                <!--
                    Process each page returned by the WordPress loop.

                    A normal page request will usually contain a
                    single page, but the standard loop structure
                    keeps the template compatible with WordPress.
                -->
                <?php while (have_posts()) : the_post(); ?>


                    <article
                        id="page-<?php the_ID(); ?>"
                        <?php post_class('page-article'); ?>
                    >


                        <!-- =====================================
                             PAGE HEADER
                             ===================================== -->

                        <!--
                            Introduces the current jenga-code page
                            with the site label, WordPress page title
                            and optional introductory excerpt.
                        -->
                        <header class="page-header">

                            <span class="content-label">
                                JENGA-CODE
                            </span>


                            <!--
                                Display the title assigned to this
                                page through WordPress.
                            -->
                            <h1 class="page-title">
                                <?php the_title(); ?>
                            </h1>


                            <!--
                                Display the page excerpt as introductory
                                text when an excerpt has been provided.
                            -->
                            <?php if (has_excerpt()) : ?>

                                <div class="page-introduction">

                                    <?php the_excerpt(); ?>

                                </div>

                            <?php endif; ?>

                        </header>



                        <!-- =====================================
                             FEATURED IMAGE
                             ===================================== -->

                        <!--
                            Display the page's featured image when one
                            has been assigned through WordPress.
                        -->
                        <?php if (has_post_thumbnail()) : ?>

                            <figure class="page-featured-image">

                                <?php
                                /*
                                 * Use the custom featured-article image
                                 * size registered by the jenga-code theme
                                 * in functions.php.
                                 *
                                 * The image is eagerly loaded because it
                                 * appears prominently near the beginning
                                 * of the page.
                                 */
                                the_post_thumbnail(
                                    'featured-article',
                                    array(
                                        'loading' =>
                                            'eager',

                                        'alt' =>
                                            esc_attr(
                                                get_the_title()
                                            )
                                    )
                                );
                                ?>

                            </figure>

                        <?php endif; ?>



                        <!-- =====================================
                             PAGE BODY
                             ===================================== -->

                        <!--
                            Output the complete WordPress page content.

                            WordPress processes blocks, formatting,
                            shortcodes and other content filters before
                            displaying the final page body.
                        -->
                        <div class="page-content">

                            <?php the_content(); ?>

                        </div>



                        <!-- =====================================
                             MULTI-PAGE CONTENT NAVIGATION
                             ===================================== -->

                        <?php
                        /*
                         * Display page navigation when a WordPress page
                         * has been divided into multiple sections using
                         * the WordPress page-break functionality.
                         *
                         * The translation domain now uses jenga-code
                         * so it matches the rebranded theme.
                         */
                        wp_link_pages(
                            array(
                                'before' =>
                                    '<nav class="page-links">'
                                    . '<span>'
                                    . esc_html__(
                                        'Pages:',
                                        'jenga-code'
                                    )
                                    . '</span>',

                                'after' =>
                                    '</nav>'
                            )
                        );
                        ?>


                    </article>


                    <!-- =========================================
                         WORDPRESS EDIT LINK
                         ========================================= -->

                    <!--
                        Display an edit shortcut when the current
                        WordPress user has permission to edit this page.

                        Ordinary visitors will not see this control.
                    -->
                    <?php if (get_edit_post_link()) : ?>

                        <div class="page-edit-link">

                            <?php
                            edit_post_link(
                                esc_html__(
                                    'Edit this page',
                                    'jenga-code'
                                )
                            );
                            ?>

                        </div>

                    <?php endif; ?>


                    <!-- =========================================
                         WORDPRESS COMMENTS
                         ========================================= -->

                    <?php

                    /*
                     * Load the WordPress comments template when
                     * comments are currently open or when the page
                     * already contains existing comments.
                     */
                    if (
                        comments_open()
                        || get_comments_number()
                    ) {

                        comments_template();
                    }

                    ?>


                <?php endwhile; ?>


            <?php else : ?>


                <!-- =============================================
                     NO PAGE CONTENT
                     ============================================= -->

                <!--
                    Fallback displayed when WordPress does not return
                    any content for the current page request.
                -->
                <section class="no-results">

                    <span class="content-label">
                        NOTHING HERE
                    </span>

                    <h1>
                        Page not found.
                    </h1>

                    <p>
                        There is currently no content
                        available on this page.
                    </p>

                    <!--
                        Give visitors a clear route back to the
                        main jenga-code homepage.
                    -->
                    <a
                        class="primary-button"
                        href="<?php echo esc_url(home_url('/')); ?>"
                    >
                        Return Home
                        <span>→</span>
                    </a>

                </section>


            <?php endif; ?>


        </section>



        <!-- =================================================
             JENGA-CODE SIDEBAR
             ================================================= -->

        <!--
            Load the shared WordPress sidebar alongside the
            standard page content.
        -->
        <aside class="blog-sidebar">

            <?php get_sidebar(); ?>

        </aside>


    </div>

</main>


<?php
/*
 * Load the shared jenga-code footer from footer.php.
 */
get_footer();
?>