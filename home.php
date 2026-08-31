<?php
/**
 * Blog Home Template
 *
 * Displays the main Code & Curiosity blog page.
 *
 * @package CodeAndCuriosity
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>


<!-- =====================================================
     BLOG PAGE
     ===================================================== -->

<main class="blog-page">


    <!-- =================================================
         BLOG INTRODUCTION
         ================================================= -->

    <section class="blog-intro">

        <div class="blog-intro-copy">

            <span class="content-label">
                CODE &amp; CURIOSITY
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

    <div class="blog-layout">


        <!-- =================================================
             MAIN COLUMN
             ================================================= -->

        <div class="blog-main">


            <?php if (have_posts()) : ?>


                <?php
                /*
                 * -------------------------------------------------
                 * FEATURED / LATEST ARTICLE
                 * -------------------------------------------------
                 *
                 * The first post returned by WordPress is displayed
                 * as the large featured article.
                 */

                the_post();
                ?>


                <section class="featured-article">

                    <div class="featured-article-content">


                        <div class="article-meta">

                            <span class="article-date">
                                <?php echo esc_html(get_the_date()); ?>
                            </span>


                            <?php
                            $categories = get_the_category();

                            if (!empty($categories)) :
                            ?>

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


                            <span class="article-reading-time">
                                <?php
                                echo esc_html(
                                    code_and_curiosity_reading_time()
                                );
                                ?>
                            </span>

                        </div>



                        <h2 class="featured-article-title">

                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>

                        </h2>



                        <div class="featured-article-excerpt">

                            <?php the_excerpt(); ?>

                        </div>



                        <a
                            class="primary-button"
                            href="<?php the_permalink(); ?>"
                        >
                            Read Article
                            <span>→</span>
                        </a>


                    </div>



                    <a
                        class="featured-article-image"
                        href="<?php the_permalink(); ?>"
                        aria-label="<?php echo esc_attr(get_the_title()); ?>"
                    >

                        <?php if (has_post_thumbnail()) : ?>

                            <?php
                            the_post_thumbnail(
                                'featured-article',
                                array(
                                    'loading' => 'eager'
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

                </section>



                <!-- =============================================
                     LATEST ARTICLES
                     ============================================= -->

                <?php if (have_posts()) : ?>

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



                        <div class="article-grid">


                            <?php while (have_posts()) : the_post(); ?>


                                <article
                                    id="post-<?php the_ID(); ?>"
                                    <?php post_class('article-card'); ?>
                                >


                                    <!-- ARTICLE IMAGE -->

                                    <a
                                        class="article-card-image"
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
                                                    ARTICLE
                                                </small>

                                            </div>

                                        <?php endif; ?>

                                    </a>



                                    <!-- ARTICLE CONTENT -->

                                    <div class="article-card-content">


                                        <div class="article-meta">

                                            <span class="article-date">
                                                <?php
                                                echo esc_html(
                                                    get_the_date()
                                                );
                                                ?>
                                            </span>


                                            <?php
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

                                            <?php endif; ?>

                                        </div>



                                        <h3 class="article-card-title">

                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>

                                        </h3>



                                        <div class="article-card-excerpt">

                                            <?php the_excerpt(); ?>

                                        </div>



                                        <div class="article-card-footer">

                                            <span class="article-reading-time">

                                                <?php
                                                echo esc_html(
                                                    code_and_curiosity_reading_time()
                                                );
                                                ?>

                                            </span>


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
                     PAGINATION
                     ============================================= -->

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
                     NO POSTS
                     ============================================= -->

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
             SIDEBAR
             ================================================= -->

        <aside class="blog-sidebar">

            <?php get_sidebar(); ?>

        </aside>


    </div>


</main>


<?php
get_footer();