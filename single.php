<?php
/**
 * jenga-code - Sidebar Template
 *
 * Displays the shared sidebar used throughout the custom jenga-code
 * WordPress blog.
 *
 * The sidebar provides supplementary content alongside blog posts,
 * archive pages, search results and other WordPress templates.
 *
 * It currently contains:
 * - Two reserved advertising areas
 * - A newsletter subscription form
 * - A Popular Articles section
 * - Article thumbnails and estimated reading times
 * - A standard WordPress widget area
 *
 * WordPress does not provide built-in post-view statistics, so the
 * Popular Articles section currently displays the five most recent
 * published posts. This can later be replaced with genuine popularity
 * data from analytics or a post-view tracking system.
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
?>


<!-- =====================================================
     JENGA-CODE BLOG SIDEBAR
     ===================================================== -->


<!-- =====================================================
     TOP ADVERTISEMENT
     ===================================================== -->

<!--
    Primary advertising area.

    This space is reserved for a future jenga-code sponsor,
    advertising network or other promotional content.
-->
<section class="sidebar-card advert-card">

    <span class="sidebar-label">
        SPONSORED
    </span>


    <div class="advert-content">

        <!-- Placeholder advertiser identity -->
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


        <!--
            Placeholder advertising link.

            Replace the href when an advertising destination
            has been configured.
        -->
        <a
            class="advert-link"
            href="#"
        >
            Learn More
        </a>


        <!--
            Decorative advertisement artwork.

            This element is hidden from assistive technology
            because it contains no meaningful content.
        -->
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
     JENGA-CODE NEWSLETTER
     ===================================================== -->

<!--
    Newsletter subscription area.

    Allows visitors to subscribe for future jenga-code articles,
    programming projects and resources.
-->
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


    <!--
        Newsletter form.

        The action is currently a placeholder and can later be
        connected to the newsletter service used by jenga-code.
    -->
    <form
        class="newsletter-form"
        action="#"
        method="post"
    >

        <!-- Accessible label for the email input -->
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

<!--
    Article discovery section.

    WordPress does not maintain post-view statistics by default,
    so recently published posts are currently used as a temporary
    substitute for genuinely popular articles.
-->
<section class="sidebar-card popular-card">

    <span class="sidebar-label">
        POPULAR ARTICLES
    </span>


    <div class="popular-list">

        <?php

        /*
         * ---------------------------------------------------------
         * POPULAR / RECENT ARTICLE QUERY
         * ---------------------------------------------------------
         *
         * Retrieve five recently published jenga-code articles.
         *
         * WordPress does not record post-view counts by default,
         * meaning there is no reliable native query for determining
         * which articles are genuinely the most popular.
         *
         * This can later be replaced or extended using:
         * - Analytics data
         * - WordPress post metadata
         * - A custom view counter
         * - A dedicated analytics/plugin integration
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


        /*
         * Check whether the custom WordPress query returned
         * any published articles.
         */
        if ($popular_posts->have_posts()) :

            /*
             * Number the displayed articles from one to five.
             */
            $article_number = 1;


            while ($popular_posts->have_posts()) :

                $popular_posts->the_post();
        ?>


                <!--
                    Individual popular/recent article.

                    The entire article entry links directly to
                    the corresponding jenga-code blog post.
                -->
                <a
                    class="popular-article"
                    href="<?php the_permalink(); ?>"
                >


                    <!-- =========================================
                         ARTICLE NUMBER
                         ========================================= -->

                    <span class="article-number">

                        <?php
                        echo esc_html(
                            $article_number
                        );
                        ?>

                    </span>



                    <!-- =========================================
                         ARTICLE THUMBNAIL
                         ========================================= -->

                    <?php if (has_post_thumbnail()) : ?>

                        <!--
                            Display the custom sidebar-thumbnail
                            image size registered in functions.php.
                        -->
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


                        <!--
                            Text-based fallback displayed when the
                            article does not have a featured image.
                        -->
                        <div
                            class="
                                article-thumbnail
                                article-thumbnail-placeholder
                            "
                        >

                            <?php

                            /*
                             * Use the first character of the article
                             * title as its thumbnail placeholder.
                             *
                             * The title is stripped of HTML before the
                             * first character is extracted and converted
                             * to uppercase.
                             *
                             * If no title is available, use the familiar
                             * programming symbol as a final fallback.
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



                    <!-- =========================================
                         ARTICLE INFORMATION
                         ========================================= -->

                    <div class="article-info">


                        <!-- Article title -->
                        <h3>
                            <?php the_title(); ?>
                        </h3>


                        <!--
                            Estimated article reading time.

                            The shared jenga-code helper function is
                            defined in the theme's functions.php file.
                        -->
                        <p>

                            <?php
                            echo esc_html(
                                jenga_code_reading_time()
                            );
                            ?>

                        </p>

                    </div>


                </a>


        <?php

                /*
                 * Increment the displayed article position.
                 */
                $article_number++;

            endwhile;


            /*
             * Restore the original WordPress global post object.
             *
             * This is required after using a secondary WP_Query so
             * that subsequent template functions continue working
             * with the original page or post.
             */
            wp_reset_postdata();


        else :
        ?>


            <!--
                Fallback displayed when there are currently
                no published jenga-code articles.
            -->
            <div class="sidebar-empty">

                <p>
                    Articles will appear here
                    once the blog gets going.
                </p>

            </div>


        <?php endif; ?>

    </div>



    <!--
        Link to the complete jenga-code article archive.
    -->
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

<!--
    Standard WordPress widget area.

    The blog-sidebar widget location is registered in the
    jenga-code functions.php file.

    Widgets assigned to this location through WordPress will
    automatically appear here.
-->
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

<!--
    Secondary advertising area.

    Provides another reserved sponsor position further down the
    sidebar without inserting advertising directly into articles.
-->
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


            <!--
                Placeholder advertising destination.
            -->
            <a
                class="advert-link"
                href="#"
            >
                Learn More
            </a>

        </div>


        <!--
            Decorative artwork for the secondary advertisement.
        -->
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