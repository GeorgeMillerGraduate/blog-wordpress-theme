<?php
/**
 * jenga-code - Sidebar Template
 *
 * Displays the shared sidebar used throughout the custom jenga-code
 * WordPress blog.
 *
 * The sidebar provides supporting content alongside the main articles,
 * archive pages, search results and other WordPress content. It is
 * designed to complement the main jenga-code website without
 * interrupting the primary reading experience.
 *
 * The sidebar provides:
 * - Advertising placeholders for future sponsors
 * - Newsletter subscription functionality
 * - A list of recent/popular articles
 * - Article thumbnails and estimated reading times
 * - A standard WordPress widget area
 * - Additional advertising space
 *
 * WordPress does not provide built-in article view statistics, so the
 * Popular Articles section currently displays recent published posts.
 * This can later be connected to analytics or a view-counting system.
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
     JENGA-CODE
     BLOG SIDEBAR CONTENT
     ===================================================== -->


<!-- =====================================================
     TOP ADVERTISEMENT
     ===================================================== -->

<!--
    Primary advertising area.

    This placeholder provides space for a future jenga-code sponsor
    or advertising integration while keeping promotional content
    visually separate from the main articles.
-->
<section class="sidebar-card advert-card">

    <span class="sidebar-label">
        SPONSORED
    </span>


    <div class="advert-content">

        <!-- Placeholder sponsor identity -->
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
            Placeholder advertising destination.

            The href can later be replaced with the URL supplied
            by the advertiser or advertising platform.
        -->
        <a
            class="advert-link"
            href="#"
        >
            Learn More
        </a>


        <!--
            Decorative advertisement artwork.

            aria-hidden prevents purely visual elements from being
            unnecessarily announced by screen readers.
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
    programming projects and other resources.
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
        Newsletter subscription form.

        The form currently uses a placeholder action. It can later
        be connected to the newsletter or mailing-list provider
        selected for jenga-code.
    -->
    <form
        class="newsletter-form"
        action="#"
        method="post"
    >

        <!-- Accessible label for screen-reader users -->
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
     POPULAR / RECENT JENGA-CODE ARTICLES
     ===================================================== -->

<!--
    Article discovery section.

    WordPress does not record article view counts by default, so this
    section currently uses recently published posts as a temporary
    substitute for genuine popularity rankings.
-->
<section class="sidebar-card popular-card">

    <span class="sidebar-label">
        POPULAR ARTICLES
    </span>


    <div class="popular-list">

        <?php

        /*
         * ---------------------------------------------------------
         * POPULAR ARTICLE QUERY
         * ---------------------------------------------------------
         *
         * For now we use recent published posts.
         *
         * WordPress does not record post-view counts by default,
         * so there is no reliable built-in "most popular" query.
         *
         * This query retrieves up to five published jenga-code
         * articles while ignoring WordPress sticky-post behaviour.
         *
         * Later this section can be connected to analytics,
         * WordPress post metadata or another article-view counter
         * to provide genuine popularity rankings.
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
         * Check whether WordPress returned any articles.
         */
        if ($popular_posts->have_posts()) :

            /*
             * Begin numbering sidebar articles from one.
             */
            $article_number = 1;


            while ($popular_posts->have_posts()) :

                $popular_posts->the_post();
        ?>


                <!--
                    Individual sidebar article.

                    The entire item is clickable and leads directly
                    to the corresponding jenga-code article.
                -->
                <a
                    class="popular-article"
                    href="<?php the_permalink(); ?>"
                >


                    <!-- =========================================
                         ARTICLE NUMBER
                         ========================================= -->

                    <!--
                        Display the article's position within the
                        sidebar list.
                    -->
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
                            Display a text-based placeholder when
                            the article has no featured image.
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
                             * title when no featured image exists.
                             *
                             * This gives every article a simple visual
                             * identifier even when an image has not
                             * been uploaded.
                             *
                             * If the article does not have a title,
                             * fall back to the programming symbol.
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
                            Estimated reading time calculated using
                            the shared jenga-code helper function
                            defined in functions.php.
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
                 * Increase the displayed article number before
                 * processing the next WordPress post.
                 */
                $article_number++;

            endwhile;


            /*
             * Restore the original global WordPress post data.
             *
             * This is important because the custom WP_Query above
             * temporarily changes the global post object used by
             * WordPress template functions.
             */
            wp_reset_postdata();


        else :
        ?>


            <!--
                Fallback displayed when jenga-code does not yet
                contain any published articles.
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
        Provide access to the complete collection of
        jenga-code blog articles.
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

    The blog-sidebar widget location is registered by jenga-code
    in functions.php. WordPress administrators can add, remove
    and configure widgets without editing this template.
-->
<?php if (is_active_sidebar('blog-sidebar')) : ?>

    <div class="sidebar-widgets">

        <?php
        /*
         * Output all widgets currently assigned to the
         * jenga-code Blog Sidebar widget area.
         */
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

    Provides another reserved sponsor location further down the
    jenga-code sidebar without placing advertising directly inside
    the main article content.
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
                Placeholder sponsor destination to be replaced
                when advertising is configured.
            -->
            <a
                class="advert-link"
                href="#"
            >
                Learn More
            </a>

        </div>


        <!--
            Decorative visual element for the smaller advert.
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