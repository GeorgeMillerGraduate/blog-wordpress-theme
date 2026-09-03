<?php
/**
 * jenga-code - Search Results Template
 *
 * Displays WordPress search results within the custom jenga-code
 * WordPress theme.
 *
 * This template handles searches submitted through the jenga-code
 * website and presents matching WordPress content in a structured,
 * responsive results layout.
 *
 * Search results may include posts, pages or other searchable
 * WordPress content types. Article-specific information such as
 * categories and estimated reading times is displayed for posts
 * where appropriate.
 *
 * The page provides:
 * - The current search query
 * - The total number of matching results
 * - A reusable WordPress search form
 * - Featured images and branded fallback placeholders
 * - Content type, publication date and category information
 * - Estimated reading times for articles
 * - Search-result excerpts
 * - Pagination for larger result sets
 * - A useful fallback when no results are found
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
     SEARCH RESULTS PAGE
     ===================================================== -->

<main class="search-page">

    <!--
        Main search layout.

        Separates the search results from the shared jenga-code
        sidebar while allowing the layout to respond appropriately
        to different screen sizes.
    -->
    <div class="search-layout">


        <!-- =================================================
             MAIN SEARCH CONTENT
             ================================================= -->

        <section class="search-content">


            <!-- =============================================
                 SEARCH HEADER
                 ============================================= -->

            <!--
                Displays the current search query, number of matching
                results and a form allowing the visitor to immediately
                perform another search.
            -->
            <header class="search-header">

                <span class="content-label">
                    SEARCH
                </span>


                <!--
                    Change the main heading depending on whether
                    WordPress found content matching the query.
                -->
                <h1 class="search-title">

                    <?php if (have_posts()) : ?>

                        Search results for
                        <span>
                            “<?php echo esc_html(get_search_query()); ?>”
                        </span>

                    <?php else : ?>

                        No results found

                    <?php endif; ?>

                </h1>


                <!-- =========================================
                     SEARCH RESULT COUNT
                     ========================================= -->

                <?php if (have_posts()) : ?>

                    <p class="search-summary">

                        <?php
                        /*
                         * Access the current WordPress query so the
                         * total number of matching results can be
                         * displayed to the visitor.
                         */
                        global $wp_query;

                        $result_count =
                            (int) $wp_query->found_posts;


                        /*
                         * Display grammatically correct singular or
                         * plural result text using WordPress's
                         * localisation system.
                         */
                        printf(
                            esc_html(
                                _n(
                                    '%s result found.',
                                    '%s results found.',
                                    $result_count,
                                    'jenga-code'
                                )
                            ),
                            esc_html(
                                number_format_i18n(
                                    $result_count
                                )
                            )
                        );
                        ?>

                    </p>

                <?php endif; ?>


                <!-- =========================================
                     SEARCH FORM
                     ========================================= -->

                <!--
                    Allow visitors to perform another WordPress
                    search directly from the results page.
                -->
                <form
                    class="search-page-form"
                    role="search"
                    method="get"
                    action="<?php echo esc_url(home_url('/')); ?>"
                >

                    <!--
                        Accessible description of the jenga-code
                        search field for screen-reader users.
                    -->
                    <label
                        class="screen-reader-text"
                        for="search-page-field"
                    >
                        Search jenga-code
                    </label>


                    <!--
                        Preserve the current search query so it can
                        easily be modified and submitted again.
                    -->
                    <input
                        id="search-page-field"
                        type="search"
                        name="s"
                        value="<?php echo esc_attr(get_search_query()); ?>"
                        placeholder="Search articles..."
                    >


                    <button
                        class="primary-button"
                        type="submit"
                    >
                        Search
                    </button>

                </form>

            </header>



            <!-- =============================================
                 SEARCH RESULTS
                 ============================================= -->

            <?php if (have_posts()) : ?>


                <!--
                    Collection containing every WordPress item
                    matching the visitor's search query.
                -->
                <div class="search-results">


                    <?php while (have_posts()) : the_post(); ?>


                        <!--
                            Individual jenga-code search result.

                            WordPress adds its standard post classes
                            alongside the custom search-result-card
                            class used by the theme.
                        -->
                        <article
                            id="post-<?php the_ID(); ?>"
                            <?php post_class('search-result-card'); ?>
                        >


                            <!-- =================================
                                 SEARCH RESULT IMAGE
                                 ================================= -->

                            <!--
                                The image itself links directly to
                                the corresponding WordPress content.
                            -->
                            <a
                                class="search-result-image"
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
                                     * Lazy loading prevents images
                                     * further down the search page from
                                     * loading before they are required.
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
                                        placeholder when no featured
                                        image has been assigned.
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
                                 SEARCH RESULT CONTENT
                                 ================================= -->

                            <div class="search-result-content">


                                <!-- =================================
                                     RESULT METADATA
                                     ================================= -->

                                <div class="article-meta">


                                    <!-- =============================
                                         CONTENT TYPE
                                         ============================= -->

                                    <!--
                                        Identify whether the result is
                                        a post, page or another searchable
                                        WordPress content type.
                                    -->
                                    <span class="search-result-type">

                                        <?php

                                        $post_type =
                                            get_post_type_object(
                                                get_post_type()
                                            );

                                        if ($post_type) {

                                            echo esc_html(
                                                $post_type
                                                    ->labels
                                                    ->singular_name
                                            );
                                        }

                                        ?>

                                    </span>



                                    <!-- =============================
                                         PUBLICATION DATE
                                         ============================= -->

                                    <span class="article-date">

                                        <?php
                                        echo esc_html(
                                            get_the_date()
                                        );
                                        ?>

                                    </span>



                                    <!-- =============================
                                         ARTICLE CATEGORY
                                         ============================= -->

                                    <?php
                                    /*
                                     * Categories only apply to standard
                                     * WordPress posts in this layout.
                                     */
                                    if (get_post_type() === 'post') {

                                        $categories =
                                            get_the_category();

                                        if (!empty($categories)) :
                                    ?>

                                            <!--
                                                Display the first returned
                                                category as the primary
                                                category for the article.
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

                                        <?php
                                        endif;
                                    }
                                    ?>


                                    <!-- =============================
                                         ESTIMATED READING TIME
                                         ============================= -->

                                    <?php
                                    /*
                                     * Reading-time information is only
                                     * displayed for standard blog posts.
                                     */
                                    if (get_post_type() === 'post') :
                                    ?>

                                        <span class="article-reading-time">

                                            <?php
                                            /*
                                             * Use the shared jenga-code
                                             * reading-time helper defined
                                             * within functions.php.
                                             */
                                            echo esc_html(
                                                jenga_code_reading_time()
                                            );
                                            ?>

                                        </span>

                                    <?php endif; ?>


                                </div>



                                <!-- =================================
                                     RESULT TITLE
                                     ================================= -->

                                <!--
                                    Display the WordPress content title
                                    and link it to the full result.
                                -->
                                <h2 class="search-result-title">

                                    <a href="<?php the_permalink(); ?>">

                                        <?php the_title(); ?>

                                    </a>

                                </h2>



                                <!-- =================================
                                     RESULT EXCERPT
                                     ================================= -->

                                <!--
                                    Display a shortened preview of the
                                    matching WordPress content.
                                -->
                                <div class="search-result-excerpt">

                                    <?php the_excerpt(); ?>

                                </div>



                                <!-- =================================
                                     RESULT LINK
                                     ================================= -->

                                <!--
                                    Provide a clear route to the complete
                                    post, page or other search result.
                                -->
                                <a
                                    class="text-button"
                                    href="<?php the_permalink(); ?>"
                                >
                                    View
                                    <span>→</span>
                                </a>


                            </div>


                        </article>


                    <?php endwhile; ?>


                </div>



                <!-- =============================================
                     SEARCH RESULTS PAGINATION
                     ============================================= -->

                <!--
                    Display WordPress pagination when the search
                    returns more results than fit on one page.
                -->
                <nav
                    class="search-pagination"
                    aria-label="Search results navigation"
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
                     NO SEARCH RESULTS
                     ============================================= -->

                <!--
                    Helpful fallback when WordPress cannot find
                    content matching the supplied search query.
                -->
                <section class="no-results">

                    <div class="no-results-symbol">
                        ?
                    </div>


                    <h2>
                        We couldn't find anything matching
                        “<?php echo esc_html(get_search_query()); ?>”.
                    </h2>


                    <p>
                        Try a different search term, or browse
                        the latest jenga-code articles.
                    </p>


                    <!--
                        Give visitors alternative routes into the
                        jenga-code website instead of leaving them
                        at an empty search result.
                    -->
                    <div class="no-results-actions">

                        <a
                            class="primary-button"
                            href="<?php echo esc_url(home_url('/blog/')); ?>"
                        >
                            Browse Articles
                            <span>→</span>
                        </a>

                        <a
                            class="text-button"
                            href="<?php echo esc_url(home_url('/')); ?>"
                        >
                            Return Home
                            <span>→</span>
                        </a>

                    </div>

                </section>


            <?php endif; ?>


        </section>



        <!-- =================================================
             JENGA-CODE SIDEBAR
             ================================================= -->

        <!--
            Load the shared WordPress sidebar alongside the
            jenga-code search results.
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