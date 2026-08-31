<?php
/**
 * Main Index Template
 *
 * WordPress uses this template as the final fallback
 * when no more specific template is available.
 *
 * @package CodeAndCuriosity
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>


<!-- =====================================================
     MAIN CONTENT
     ===================================================== -->

<main class="index-page">

    <div class="index-layout">


        <!-- =================================================
             CONTENT COLUMN
             ================================================= -->

        <section class="index-content">


            <!-- =============================================
                 PAGE HEADER
                 ============================================= -->

            <header class="index-header">

                <span class="content-label">
                    CODE &amp; CURIOSITY
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
                 WORDPRESS LOOP
                 ============================================= -->

            <?php if (have_posts()) : ?>


                <div class="article-grid">


                    <?php while (have_posts()) : the_post(); ?>


                        <article
                            id="post-<?php the_ID(); ?>"
                            <?php post_class('article-card'); ?>
                        >


                            <!-- =================================
                                 FEATURED IMAGE
                                 ================================= -->

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
                                            CODE &amp; CURIOSITY
                                        </small>

                                    </div>


                                <?php endif; ?>


                            </a>



                            <!-- =================================
                                 ARTICLE CONTENT
                                 ================================= -->

                            <div class="article-card-content">


                                <!-- META -->

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



                                <!-- TITLE -->

                                <h2 class="article-card-title">

                                    <a href="<?php the_permalink(); ?>">

                                        <?php the_title(); ?>

                                    </a>

                                </h2>



                                <!-- EXCERPT -->

                                <div class="article-card-excerpt">

                                    <?php the_excerpt(); ?>

                                </div>



                                <!-- FOOTER -->

                                <div class="article-card-footer">


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
                     PAGINATION
                     ============================================= -->

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