<?php
/**
 * Sidebar Template
 *
 * Displays the Code & Curiosity blog sidebar.
 *
 * @package CodeAndCuriosity
 */

if (!defined('ABSPATH')) {
    exit;
}
?>


<!-- =====================================================
     BLOG SIDEBAR CONTENT
     ===================================================== -->


<!-- =====================================================
     TOP ADVERTISEMENT
     ===================================================== -->

<section class="sidebar-card advert-card">

    <span class="sidebar-label">
        SPONSORED
    </span>


    <div class="advert-content">

        <div class="advert-logo">
            YOUR AD
        </div>


        <h2>
            Advertisement
            space goes here.
        </h2>


        <p>
            A clean advertising area for a future
            sponsor without interrupting the articles.
        </p>


        <a
            class="advert-link"
            href="#"
        >
            Learn More
        </a>


        <div
            class="advert-art"
            aria-hidden="true"
        >
            <span></span>
            <span></span>
            <span></span>
        </div>

    </div>

</section>



<!-- =====================================================
     NEWSLETTER
     ===================================================== -->

<section
    class="sidebar-card newsletter-card"
    id="newsletter"
>

    <span class="sidebar-label">
        STAY IN THE LOOP
    </span>


    <p>
        Get new articles, projects and resources
        delivered straight to your inbox.
    </p>


    <form
        class="newsletter-form"
        action="#"
        method="post"
    >

        <label
            class="screen-reader-text"
            for="sidebar-newsletter-email"
        >
            Email address
        </label>


        <input
            id="sidebar-newsletter-email"
            type="email"
            name="email"
            placeholder="Enter your email address"
            autocomplete="email"
            required
        >


        <button type="submit">
            Subscribe
        </button>

    </form>


    <small>
        ♡ No spam. Unsubscribe anytime.
    </small>

</section>



<!-- =====================================================
     POPULAR ARTICLES
     ===================================================== -->

<section class="sidebar-card popular-card">

    <span class="sidebar-label">
        POPULAR ARTICLES
    </span>


    <div class="popular-list">

        <?php

        /*
         * For now we use recent posts.
         *
         * WordPress does not record post-view counts by
         * default, so there is no reliable built-in
         * "most popular" query.
         *
         * Later this can be connected to analytics or
         * a post-view counter.
         */

        $popular_posts =
            new WP_Query(
                array(
                    'post_type'           => 'post',
                    'post_status'         => 'publish',
                    'posts_per_page'      => 5,
                    'ignore_sticky_posts' => true
                )
            );


        if ($popular_posts->have_posts()) :

            $article_number = 1;


            while ($popular_posts->have_posts()) :

                $popular_posts->the_post();
        ?>


                <a
                    class="popular-article"
                    href="<?php the_permalink(); ?>"
                >


                    <!-- ARTICLE NUMBER -->

                    <span class="article-number">

                        <?php
                        echo esc_html(
                            $article_number
                        );
                        ?>

                    </span>



                    <!-- THUMBNAIL -->

                    <?php if (has_post_thumbnail()) : ?>

                        <div class="article-thumbnail">

                            <?php
                            the_post_thumbnail(
                                'sidebar-thumbnail',
                                array(
                                    'loading' => 'lazy'
                                )
                            );
                            ?>

                        </div>


                    <?php else : ?>


                        <div
                            class="
                                article-thumbnail
                                article-thumbnail-placeholder
                            "
                        >

                            <?php

                            /*
                             * Use the first character of the
                             * article title when no image exists.
                             */

                            $title =
                                get_the_title();

                            if ($title) {

                                echo esc_html(
                                    strtoupper(
                                        substr(
                                            wp_strip_all_tags($title),
                                            0,
                                            1
                                        )
                                    )
                                );

                            } else {

                                echo '&lt;/&gt;';
                            }

                            ?>

                        </div>


                    <?php endif; ?>



                    <!-- ARTICLE INFORMATION -->

                    <div class="article-info">

                        <h3>
                            <?php the_title(); ?>
                        </h3>


                        <p>

                            <?php
                            echo esc_html(
                                code_and_curiosity_reading_time()
                            );
                            ?>

                        </p>

                    </div>


                </a>


        <?php

                $article_number++;

            endwhile;


            wp_reset_postdata();


        else :
        ?>


            <div class="sidebar-empty">

                <p>
                    Articles will appear here
                    once the blog gets going.
                </p>

            </div>


        <?php endif; ?>

    </div>



    <a
        class="sidebar-view-all"
        href="<?php echo esc_url(home_url('/blog/')); ?>"
    >
        View all articles →
    </a>

</section>



<!-- =====================================================
     WORDPRESS WIDGET AREA
     ===================================================== -->

<?php if (is_active_sidebar('blog-sidebar')) : ?>

    <div class="sidebar-widgets">

        <?php
        dynamic_sidebar(
            'blog-sidebar'
        );
        ?>

    </div>

<?php endif; ?>



<!-- =====================================================
     SECOND ADVERTISEMENT
     ===================================================== -->

<section class="sidebar-card advert-card advert-small">

    <span class="sidebar-label">
        SPONSORED BY
    </span>


    <div class="small-ad-layout">

        <div>

            <h2>
                Second advert space.
            </h2>


            <p>
                Reserved for a future sponsor.
            </p>


            <a
                class="advert-link"
                href="#"
            >
                Learn More
            </a>

        </div>


        <div
            class="small-ad-art"
            aria-hidden="true"
        >
            <span></span>
            <span></span>
            <span></span>
        </div>

    </div>

</section>