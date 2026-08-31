<?php
/**
 * Search Results Template
 *
 * Displays WordPress search results.
 *
 * @package CodeAndCuriosity
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>


<!-- =====================================================
     SEARCH PAGE
     ===================================================== -->

<main class="search-page">

    <div class="search-layout">


        <!-- =================================================
             MAIN CONTENT
             ================================================= -->

        <section class="search-content">


            <!-- =============================================
                 SEARCH HEADER
                 ============================================= -->

            <header class="search-header">

                <span class="content-label">
                    SEARCH
                </span>

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


                <?php if (have_posts()) : ?>

                    <p class="search-summary">

                        <?php
                        global $wp_query;

                        $result_count =
                            (int) $wp_query->found_posts;

                        printf(
                            esc_html(
                                _n(
                                    '%s result found.',
                                    '%s results found.',
                                    $result_count,
                                    'code-and-curiosity'
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

                <form
                    class="search-page-form"
                    role="search"
                    method="get"
                    action="<?php echo esc_url(home_url('/')); ?>"
                >

                    <label
                        class="screen-reader-text"
                        for="search-page-field"
                    >
                        Search Code &amp; Curiosity
                    </label>


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


                <div class="search-results">


                    <?php while (have_posts()) : the_post(); ?>


                        <article
                            id="post-<?php the_ID(); ?>"
                            <?php post_class('search-result-card'); ?>
                        >


                            <!-- =================================
                                 IMAGE
                                 ================================= -->

                            <a
                                class="search-result-image"
                                href="<?php the_permalink(); ?>"
                                aria-label="<?php echo esc_attr(get_the_title()); ?>"
                            >

                                <?php if (has_post_thumbnail()) : ?>

                                    <?php
                                    the_post_thumbnail(
                                        'article-card',
                                        array(
                                            'loading' => 'lazy'
                                        )
                                    );
                                    ?>

                                <?php else : ?>

                                    <div class="article-image-placeholder">

                                        <span>
                                            &lt;/&gt;
                                        </span>

                                        <small>
                                            CODE &amp; CURIOSITY
                                        </small>

                                    </div>

                                <?php endif; ?>

                            </a>



                            <!-- =================================
                                 RESULT CONTENT
                                 ================================= -->

                            <div class="search-result-content">


                                <div class="article-meta">


                                    <!-- CONTENT TYPE -->

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



                                    <!-- DATE -->

                                    <span class="article-date">

                                        <?php
                                        echo esc_html(
                                            get_the_date()
                                        );
                                        ?>

                                    </span>



                                    <!-- CATEGORY -->

                                    <?php
                                    if (get_post_type() === 'post') {

                                        $categories =
                                            get_the_category();

                                        if (!empty($categories)) :
                                    ?>

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


                                    <!-- READING TIME -->

                                    <?php
                                    if (get_post_type() === 'post') :
                                    ?>

                                        <span class="article-reading-time">

                                            <?php
                                            echo esc_html(
                                                code_and_curiosity_reading_time()
                                            );
                                            ?>

                                        </span>

                                    <?php endif; ?>


                                </div>



                                <!-- =================================
                                     TITLE
                                     ================================= -->

                                <h2 class="search-result-title">

                                    <a href="<?php the_permalink(); ?>">

                                        <?php the_title(); ?>

                                    </a>

                                </h2>



                                <!-- =================================
                                     EXCERPT
                                     ================================= -->

                                <div class="search-result-excerpt">

                                    <?php the_excerpt(); ?>

                                </div>



                                <!-- =================================
                                     LINK
                                     ================================= -->

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
                     PAGINATION
                     ============================================= -->

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
                     NO RESULTS
                     ============================================= -->

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
                        the latest Code &amp; Curiosity articles.
                    </p>


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
             SIDEBAR
             ================================================= -->

        <aside class="blog-sidebar">

            <?php get_sidebar(); ?>

        </aside>


    </div>

</main>


<?php
get_footer();