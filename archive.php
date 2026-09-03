<?php
/**
 * jenga-code - Archive Template
 *
 * Displays archive pages within the custom jenga-code WordPress theme.
 *
 * WordPress uses this template when displaying collections of posts
 * organised by category, tag, author, date or another archive type.
 *
 * The archive follows the same visual design language as the main
 * jenga-code website and presents matching articles in a responsive
 * card-based layout.
 *
 * The page provides:
 * - Dynamic archive titles and descriptions
 * - Article cards containing metadata and excerpts
 * - Featured images when available
 * - Category information
 * - Pagination between archive pages
 * - A fallback message when no posts are available
 * - The shared jenga-code WordPress sidebar
 *
 * @package JengaCode
 */

/*
 * Load the shared jenga-code header from header.php.
 */
get_header();
?>

<!-- =========================================================
     JENGA-CODE
     WORDPRESS ARCHIVE PAGE
     ========================================================= -->

<main class="archive-page">

    <!--
        Main archive layout.

        Separates the archive article collection from the shared
        jenga-code sidebar while allowing the CSS layout to become
        responsive on smaller displays.
    -->
    <div class="archive-layout">

        <!-- =====================================================
             ARCHIVE CONTENT
             ===================================================== -->

        <section class="archive-content">

            <!--
                Archive heading.

                WordPress automatically determines the appropriate
                title and description for categories, tags, authors,
                dates and other archive types.
            -->
            <header class="archive-header">

                <span class="content-label">
                    ARCHIVE
                </span>

                <h1 class="archive-title">
                    <?php the_archive_title(); ?>
                </h1>

                <?php if (get_the_archive_description()) : ?>

                    <div class="archive-description">
                        <?php the_archive_description(); ?>
                    </div>

                <?php endif; ?>

            </header>


            <!-- =================================================
                 ARCHIVE POST LOOP
                 ================================================= -->

            <?php if (have_posts()) : ?>

                <!--
                    Responsive collection of article cards.

                    Each card represents one WordPress post returned
                    for the current archive query.
                -->
                <div class="archive-grid">

                    <?php while (have_posts()) : the_post(); ?>

                        <article
                            id="post-<?php the_ID(); ?>"
                            <?php post_class('article-card'); ?>
                        >

                            <!--
                                Display the article's featured image
                                when one has been assigned in WordPress.
                            -->
                            <?php if (has_post_thumbnail()) : ?>

                                <a
                                    class="article-card-image"
                                    href="<?php the_permalink(); ?>"
                                    aria-label="<?php echo esc_attr(get_the_title()); ?>"
                                >
                                    <?php
                                    the_post_thumbnail(
                                        'large',
                                        array(
                                            'loading' => 'lazy'
                                        )
                                    );
                                    ?>
                                </a>

                            <?php endif; ?>


                            <!-- =====================================
                                 ARTICLE INFORMATION
                                 ===================================== -->

                            <div class="article-card-content">

                                <!--
                                    Article metadata containing the
                                    publication date and primary category.
                                -->
                                <div class="article-meta">

                                    <span class="article-date">
                                        <?php echo esc_html(get_the_date()); ?>
                                    </span>

                                    <?php
                                    $categories = get_the_category();

                                    if (!empty($categories)) :
                                    ?>

                                        <span
                                            class="article-category"
                                        >
                                            <?php
                                            echo esc_html(
                                                $categories[0]->name
                                            );
                                            ?>
                                        </span>

                                    <?php endif; ?>

                                </div>


                                <!-- Article title linking to the full post -->
                                <h2 class="article-title">

                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>

                                </h2>


                                <!-- Short WordPress-generated article excerpt -->
                                <div class="article-excerpt">

                                    <?php the_excerpt(); ?>

                                </div>


                                <!-- Link to the complete jenga-code article -->
                                <a
                                    class="text-button"
                                    href="<?php the_permalink(); ?>"
                                >
                                    Read article
                                    <span>→</span>
                                </a>

                            </div>

                        </article>

                    <?php endwhile; ?>

                </div>


                <!-- =================================================
                     ARCHIVE PAGINATION
                     ================================================= -->

                <nav
                    class="archive-pagination"
                    aria-label="Archive navigation"
                >

                    <?php
                    /*
                     * Generate WordPress pagination when the archive
                     * contains more posts than fit on a single page.
                     */
                    the_posts_pagination(
                        array(
                            'mid_size'  => 2,
                            'prev_text' => '← Previous',
                            'next_text' => 'Next →',
                        )
                    );
                    ?>

                </nav>


            <?php else : ?>

                <!-- =================================================
                     EMPTY ARCHIVE
                     ================================================= -->

                <section class="no-results">

                    <span class="content-label">
                        NOTHING HERE
                    </span>

                    <h2>
                        No articles found.
                    </h2>

                    <p>
                        There are currently no posts in this archive.
                    </p>

                    <!-- Return visitors to the main jenga-code blog -->
                    <a
                        class="primary-button"
                        href="<?php echo esc_url(home_url('/blog/')); ?>"
                    >
                        Browse the Blog
                        <span>→</span>
                    </a>

                </section>

            <?php endif; ?>

        </section>


        <!-- =====================================================
             JENGA-CODE SIDEBAR
             ===================================================== -->

        <aside class="archive-sidebar">

            <?php
            /*
             * Load the shared sidebar from sidebar.php.
             */
            get_sidebar();
            ?>

        </aside>

    </div>

</main>

<?php
/*
 * Load the shared jenga-code footer from footer.php.
 */
get_footer();
?>