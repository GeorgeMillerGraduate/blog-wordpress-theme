<?php
/**
 * jenga-code - Main Index Template
 *
 * Provides the final fallback template for the custom jenga-code
 * WordPress theme.
 *
 * WordPress uses index.php when no more specific template is
 * available for the current request. This ensures that posts can
 * still be displayed using the standard jenga-code article layout
 * even when another specialised template does not apply.
 *
 * The page provides:
 * - jenga-code branding and introductory content
 * - The standard WordPress post loop
 * - Article featured images and fallback placeholders
 * - Publication dates and categories
 * - Estimated article reading times
 * - Article excerpts and links
 * - WordPress pagination
 * - A fallback message when no content is available
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
     MAIN INDEX / FALLBACK TEMPLATE
     ===================================================== -->

<main class="index-page">

    <!--
        Main index layout.

        Separates the primary article collection from the shared
        jenga-code sidebar and provides the structure required for
        the responsive blog layout.
    -->
    <div class="index-layout">


        <!-- =================================================
             MAIN CONTENT COLUMN
             ================================================= -->

        <section class="index-content">


            <!-- =============================================
                 PAGE HEADER
                 ============================================= -->

            <!--
                Introductory heading for the fallback article view.

                This maintains the same jenga-code branding and
                editorial style used throughout the main blog.
            -->
            <header class="index-header">

                <span class="content-label">
                    JENGA-CODE
                </span>

                <h1>
                    Latest Articles
                </h1>

                <p>
                    Programming, algorithms, artificial intelligence,
                    mathematics, experiments and computer science.
                </p>

            </header>



            <!-- =============================================
                 WORDPRESS ARTICLE LOOP
                 ============================================= -->

            <!--
                Check whether WordPress has returned any posts
                for the current request.
            -->
            <?php if (have_posts()) : ?>


                <!--
                    Responsive collection of jenga-code article cards.
                -->
                <div class="article-grid">


                    <?php while (have_posts()) : the_post(); ?>


                        <!--
                            Individual WordPress article.

                            WordPress automatically adds its standard
                            post classes alongside the jenga-code
                            article-card class.
                        -->
                        <article
                            id="post-<?php the_ID(); ?>"
                            <?php post_class('article-card'); ?>
                        >


                            <!-- =================================
                                 FEATURED ARTICLE IMAGE
                                 ================================= -->

                            <!--
                                The article image links directly to
                                the complete WordPress post.
                            -->
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
                                     * jenga-code theme in functions.php.
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
                                        Display a branded jenga-code
                                        placeholder when the article
                                        has no featured image.
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



                            <!-- =================================
                                 ARTICLE CONTENT
                                 ================================= -->

                            <div class="article-card-content">


                                <!-- =================================
                                     ARTICLE METADATA
                                     ================================= -->

                                <!--
                                    Displays useful information about
                                    the current jenga-code article.
                                -->
                                <div class="article-meta">


                                    <!-- Publication date -->
                                    <span class="article-date">

                                        <?php
                                        echo esc_html(
                                            get_the_date()
                                        );
                                        ?>

                                    </span>



                                    <?php
                                    /*
                                     * Retrieve all categories assigned
                                     * to the current WordPress article.
                                     */
                                    $categories =
                                        get_the_category();

                                    if (!empty($categories)) :
                                    ?>


                                        <!--
                                            Display the first returned
                                            category as the article's
                                            primary category.
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
                                        Estimated reading time calculated
                                        by the shared jenga-code helper
                                        function in functions.php.
                                    -->
                                    <span class="article-reading-time">

                                        <?php
                                        echo esc_html(
                                            jenga_code_reading_time()
                                        );
                                        ?>

                                    </span>


                                </div>



                                <!-- =================================
                                     ARTICLE TITLE
                                     ================================= -->

                                <!--
                                    Article title linking to the
                                    complete WordPress post.
                                -->
                                <h2 class="article-card-title">

                                    <a href="<?php the_permalink(); ?>">

                                        <?php the_title(); ?>

                                    </a>

                                </h2>



                                <!-- =================================
                                     ARTICLE EXCERPT
                                     ================================= -->

                                <!--
                                    Display the shortened article
                                    preview generated by WordPress and
                                    configured by the jenga-code theme.
                                -->
                                <div class="article-card-excerpt">

                                    <?php the_excerpt(); ?>

                                </div>



                                <!-- =================================
                                     ARTICLE CARD FOOTER
                                     ================================= -->

                                <div class="article-card-footer">


                                    <!--
                                        Link visitors to the complete
                                        jenga-code article.
                                    -->
                                    <a
                                        class="article-link"
                                        href="<?php the_permalink(); ?>"
                                    >
                                        Read Article
                                        <span>→</span>
                                    </a>


                                </div>


                            </div>


                        </article>


                    <?php endwhile; ?>


                </div>



                <!-- =============================================
                     WORDPRESS PAGINATION
                     ============================================= -->

                <!--
                    Display navigation when the current collection
                    of jenga-code articles spans multiple pages.
                -->
                <nav
                    class="blog-pagination"
                    aria-label="Article navigation"
                >

                    <?php
                    the_posts_pagination(
                        array(
                            'mid_size'  => 2,

                            'prev_text' =>
                                '← Previous',

                            'next_text' =>
                                'Next →'
                        )
                    );
                    ?>

                </nav>



            <?php else : ?>


                <!-- =============================================
                     NO RESULTS
                     ============================================= -->

                <!--
                    Fallback content displayed when WordPress does
                    not return any posts for the current request.
                -->
                <section class="no-results">


                    <span class="content-label">
                        NOTHING HERE
                    </span>


                    <h2>
                        No articles found.
                    </h2>


                    <p>
                        There isn't any content to display here yet.
                    </p>


                    <!--
                        Provide a clear route back to the main
                        jenga-code homepage.
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
            Display the shared WordPress sidebar registered by
            the jenga-code theme.
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