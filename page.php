<?php
/**
 * Page Template
 *
 * Displays standard WordPress pages.
 *
 * @package CodeAndCuriosity
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>


<!-- =====================================================
     STANDARD PAGE
     ===================================================== -->

<main class="standard-page">

    <div class="standard-page-layout">


        <!-- =================================================
             MAIN CONTENT
             ================================================= -->

        <section class="standard-page-content">


            <?php if (have_posts()) : ?>


                <?php while (have_posts()) : the_post(); ?>


                    <article
                        id="page-<?php the_ID(); ?>"
                        <?php post_class('page-article'); ?>
                    >


                        <!-- =====================================
                             PAGE HEADER
                             ===================================== -->

                        <header class="page-header">

                            <span class="content-label">
                                CODE &amp; CURIOSITY
                            </span>


                            <h1 class="page-title">
                                <?php the_title(); ?>
                            </h1>


                            <?php if (has_excerpt()) : ?>

                                <div class="page-introduction">

                                    <?php the_excerpt(); ?>

                                </div>

                            <?php endif; ?>

                        </header>



                        <!-- =====================================
                             FEATURED IMAGE
                             ===================================== -->

                        <?php if (has_post_thumbnail()) : ?>

                            <figure class="page-featured-image">

                                <?php
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

                        <div class="page-content">

                            <?php the_content(); ?>

                        </div>



                        <!-- =====================================
                             MULTI-PAGE CONTENT NAVIGATION
                             ===================================== -->

                        <?php
                        wp_link_pages(
                            array(
                                'before' =>
                                    '<nav class="page-links">'
                                    . '<span>'
                                    . esc_html__(
                                        'Pages:',
                                        'code-and-curiosity'
                                    )
                                    . '</span>',

                                'after' =>
                                    '</nav>'
                            )
                        );
                        ?>


                    </article>


                    <!-- =========================================
                         EDIT LINK
                         ========================================= -->

                    <?php if (get_edit_post_link()) : ?>

                        <div class="page-edit-link">

                            <?php
                            edit_post_link(
                                esc_html__(
                                    'Edit this page',
                                    'code-and-curiosity'
                                )
                            );
                            ?>

                        </div>

                    <?php endif; ?>


                    <!-- =========================================
                         COMMENTS
                         ========================================= -->

                    <?php

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
                     NO CONTENT
                     ============================================= -->

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
             SIDEBAR
             ================================================= -->

        <aside class="blog-sidebar">

            <?php get_sidebar(); ?>

        </aside>


    </div>

</main>


<?php
get_footer();