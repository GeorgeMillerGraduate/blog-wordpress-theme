<?php
/**
 * jenga-code - Blog Home Template
 *
 * Displays the main WordPress blog page for jenga-code.
 *
 * This template presents the latest programming articles, technical
 * experiments, project notes and educational content published on
 * the jenga-code website.
 *
 * The first article returned by WordPress is displayed prominently
 * as the featured article. Remaining posts are presented underneath
 * in a responsive article-card grid.
 *
 * The page provides:
 * - jenga-code blog introduction and branding
 * - A large featured/latest article
 * - Article publication dates and categories
 * - Estimated article reading times
 * - Featured images and fallback placeholders
 * - A responsive grid containing additional articles
 * - WordPress pagination
 * - A fallback message when no articles exist
 * - The shared jenga-code blog sidebar
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
     BLOG HOME PAGE
     ===================================================== -->

<main class="blog-page">


    <!-- =================================================
         JENGA-CODE BLOG INTRODUCTION
         ================================================= -->

    <!--
        Introductory section for the jenga-code blog.

        Provides visitors with a concise description of the
        programming, computer science and technical content
        available through the blog.
    -->
    <section class="blog-intro">

        <div class="blog-intro-copy">

            <span class="content-label">
                JENGA-CODE
            </span>

            <h1>
                Articles, experiments
                and programming notes.
            </h1>

            <p>
                Exploring programming, algorithms, artificial
                intelligence, mathematics and computer science
                through practical examples and visual explanations.
            </p>

        </div>

    </section>



    <!-- =================================================
         BLOG LAYOUT
         ================================================= -->

    <!--
        Main two-column blog structure.

        The primary column contains the featured article and
        latest posts while the secondary column contains the
        shared jenga-code sidebar.
    -->
    <div class="blog-layout">


        <!-- =================================================
             MAIN ARTICLE COLUMN
             ================================================= -->

        <div class="blog-main">


            <?php if (have_posts()) : ?>


                <?php
                /*
                 * -------------------------------------------------
                 * FEATURED / LATEST ARTICLE
                 * -------------------------------------------------
                 *
                 * The first post returned by the WordPress query is
                 * displayed separately as the large featured article.
                 *
                 * Calling the_post() here advances the WordPress loop
                 * once. The remaining posts are therefore available
                 * for the Latest Articles grid below.
                 */
                the_post();
                ?>


                <!-- =============================================
                     FEATURED ARTICLE
                     ============================================= -->

                <section class="featured-article">

                    <div class="featured-article-content">


                        <!--
                            Featured article metadata.

                            Displays the publication date, first
                            assigned category and estimated reading
                            time for the article.
                        -->
                        <div class="article-meta">

                            <span class="article-date">
                                <?php echo esc_html(get_the_date()); ?>
                            </span>


                            <?php
                            /*
                             * Retrieve the categories assigned to
                             * the featured WordPress post.
                             */
                            $categories = get_the_category();

                            if (!empty($categories)) :
                            ?>

                                <!--
                                    Display the first returned category
                                    as the article's primary category.
                                -->
                                <a
                                    class="article-category"
                                    href="<?php
                                    echo esc_url(
                                        get_category_link(
                                            $categories[0]->term_id
                                        )
                                    );
                                    ?>"
                                >
                                    <?php
                                    echo esc_html(
                                        $categories[0]->name
                                    );
                                    ?>
                                </a>

                            <?php endif; ?>


                            <!--
                                Estimated reading time calculated by
                                the jenga-code helper in functions.php.
                            -->
                            <span class="article-reading-time">
                                <?php
                                echo esc_html(
                                    jenga_code_reading_time()
                                );
                                ?>
                            </span>

                        </div>



                        <!--
                            Featured article title linking to the
                            complete WordPress post.
                        -->
                        <h2 class="featured-article-title">

                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>

                        </h2>



                        <!--
                            Short preview of the featured article.
                        -->
                        <div class="featured-article-excerpt">

                            <?php the_excerpt(); ?>

                        </div>



                        <!--
                            Primary call-to-action leading to the
                            complete jenga-code article.
                        -->
                        <a
                            class="primary-button"
                            href="<?php the_permalink(); ?>"
                        >
                            Read Article
                            <span>→</span>
                        </a>


                    </div>



                    <!-- =========================================
                         FEATURED ARTICLE IMAGE
                         ========================================= -->

                    <a
                        class="featured-article-image"
                        href="<?php the_permalink(); ?>"
                        aria-label="<?php echo esc_attr(get_the_title()); ?>"
                    >

                        <?php if (has_post_thumbnail()) : ?>

                            <?php
                            /*
                             * Display the custom featured-article
                             * image size registered in functions.php.
                             *
                             * Eager loading is appropriate here because
                             * this image appears prominently near the
                             * top of the jenga-code blog page.
                             */
                            the_post_thumbnail(
                                'featured-article',
                                array(
                                    'loading' => 'eager'
                                )
                            );
                            ?>

                        <?php else : ?>

                            <!--
                                Display a branded fallback when the
                                article does not have a featured image.
                            -->
                            <div class="article-image-placeholder">

                                <span>
                                    &lt;/&gt;
                                </span>

                                <small>
                                    JENGA-CODE
                                </small>

                            </div>

                        <?php endif; ?>

                    </a>

                </section>



                <!-- =============================================
                     LATEST JENGA-CODE ARTICLES
                     ============================================= -->

                <?php if (have_posts()) : ?>

                    <!--
                        The remaining WordPress posts are displayed
                        as smaller cards underneath the featured post.
                    -->
                    <section class="latest-articles">


                        <div class="panel-heading">

                            <div class="panel-title">

                                <span class="panel-icon">
                                    ◫
                                </span>

                                <h2>
                                    Latest Articles
                                </h2>

                            </div>

                        </div>



                        <!--
                            Responsive grid containing the remaining
                            jenga-code articles returned by WordPress.
                        -->
                        <div class="article-grid">


                            <?php while (have_posts()) : the_post(); ?>


                                <article
                                    id="post-<?php the_ID(); ?>"
                                    <?php post_class('article-card'); ?>
                                >


                                    <!-- =================================
                                         ARTICLE IMAGE
                                         ================================= -->

                                    <a
                                        class="article-card-image"
                                        href="<?php the_permalink(); ?>"
                                        aria-label="<?php echo esc_attr(get_the_title()); ?>"
                                    >

                                        <?php if (has_post_thumbnail()) : ?>

                                            <?php
                                            /*
                                             * Display the custom article-card
                                             * image size registered by the
                                             * jenga-code theme.
                                             *
                                             * Lazy loading avoids downloading
                                             * images before they are required.
                                             */
                                            the_post_thumbnail(
                                                'article-card',
                                                array(
                                                    'loading' => 'lazy'
                                                )
                                            );
                                            ?>

                                        <?php else : ?>

                                            <!--
                                                Generic article placeholder
                                                when no featured image exists.
                                            -->
                                            <div class="article-image-placeholder">

                                                <span>
                                                    &lt;/&gt;
                                                </span>

                                                <small>
                                                    ARTICLE
                                                </small>

                                            </div>

                                        <?php endif; ?>

                                    </a>



                                    <!-- =================================
                                         ARTICLE CONTENT
                                         ================================= -->

                                    <div class="article-card-content">


                                        <!--
                                            Publication metadata for the
                                            current jenga-code article.
                                        -->
                                        <div class="article-meta">

                                            <span class="article-date">
                                                <?php
                                                echo esc_html(
                                                    get_the_date()
                                                );
                                                ?>
                                            </span>


                                            <?php
                                            /*
                                             * Retrieve the categories assigned
                                             * to the current WordPress post.
                                             */
                                            $categories =
                                                get_the_category();

                                            if (!empty($categories)) :
                                            ?>

                                                <!--
                                                    Display the first category
                                                    as the article category.
                                                -->
                                                <a
                                                    class="article-category"
                                                    href="<?php
                                                    echo esc_url(
                                                        get_category_link(
                                                            $categories[0]
                                                                ->term_id
                                                        )
                                                    );
                                                    ?>"
                                                >
                                                    <?php
                                                    echo esc_html(
                                                        $categories[0]
                                                            ->name
                                                    );
                                                    ?>
                                                </a>

                                            <?php endif; ?>

                                        </div>



                                        <!--
                                            Article title linking to the
                                            complete WordPress post.
                                        -->
                                        <h3 class="article-card-title">

                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>

                                        </h3>



                                        <!--
                                            Short article preview generated
                                            through the WordPress excerpt system.
                                        -->
                                        <div class="article-card-excerpt">

                                            <?php the_excerpt(); ?>

                                        </div>



                                        <!-- =================================
                                             ARTICLE CARD FOOTER
                                             ================================= -->

                                        <div class="article-card-footer">

                                            <!--
                                                Estimated reading time using
                                                the shared jenga-code helper.
                                            -->
                                            <span class="article-reading-time">

                                                <?php
                                                echo esc_html(
                                                    jenga_code_reading_time()
                                                );
                                                ?>

                                            </span>


                                            <!--
                                                Link to the complete article.
                                            -->
                                            <a
                                                class="article-link"
                                                href="<?php the_permalink(); ?>"
                                            >
                                                Read Article →
                                            </a>

                                        </div>


                                    </div>


                                </article>


                            <?php endwhile; ?>


                        </div>

                    </section>


                <?php endif; ?>



                <!-- =============================================
                     BLOG PAGINATION
                     ============================================= -->

                <!--
                    WordPress pagination for navigating between
                    multiple pages of jenga-code articles.
                -->
                <nav
                    class="blog-pagination"
                    aria-label="Blog navigation"
                >

                    <?php
                    the_posts_pagination(
                        array(
                            'mid_size'  => 2,
                            'prev_text' => '← Previous',
                            'next_text' => 'Next →'
                        )
                    );
                    ?>

                </nav>



            <?php else : ?>


                <!-- =============================================
                     NO ARTICLES AVAILABLE
                     ============================================= -->

                <!--
                    Fallback content displayed when WordPress does
                    not currently contain any published blog posts.
                -->
                <section class="no-results">

                    <span class="content-label">
                        BLOG
                    </span>

                    <h2>
                        No articles yet.
                    </h2>

                    <p>
                        New programming articles, experiments and
                        project notes will appear here.
                    </p>

                </section>


            <?php endif; ?>


        </div>



        <!-- =================================================
             JENGA-CODE BLOG SIDEBAR
             ================================================= -->

        <!--
            Load the shared WordPress sidebar alongside the
            main collection of jenga-code articles.
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