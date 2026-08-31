<?php
/**
 * Archive Template
 *
 * Displays category, tag, author and date archives.
 *
 * @package CodeAndCuriosity
 */

get_header();
?>

<main class="archive-page">

    <div class="archive-layout">

        <section class="archive-content">

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


            <?php if (have_posts()) : ?>

                <div class="archive-grid">

                    <?php while (have_posts()) : the_post(); ?>

                        <article
                            id="post-<?php the_ID(); ?>"
                            <?php post_class('article-card'); ?>
                        >

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


                            <div class="article-card-content">

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


                                <h2 class="article-title">

                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>

                                </h2>


                                <div class="article-excerpt">

                                    <?php the_excerpt(); ?>

                                </div>


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


                <nav
                    class="archive-pagination"
                    aria-label="Archive navigation"
                >

                    <?php
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


        <aside class="archive-sidebar">

            <?php get_sidebar(); ?>

        </aside>

    </div>

</main>

<?php
get_footer();