<?php
/**
 * jenga-code - Footer Template
 *
 * Displays the shared footer used throughout the custom jenga-code
 * WordPress theme.
 *
 * The footer provides consistent branding and navigation between
 * the WordPress blog and the wider jenga-code website. It also
 * contains the newsletter subscription area, copyright information
 * and links to external/social resources.
 *
 * The footer provides:
 * - jenga-code branding and site description
 * - Navigation to the main areas of the website
 * - Information and legal links
 * - Newsletter subscription form
 * - Automatically updated copyright year
 * - GitHub, LinkedIn and RSS links
 * - The required WordPress wp_footer() hook
 *
 * @package JengaCode
 */
?>

<!-- =========================================================
     JENGA-CODE
     SHARED WORDPRESS FOOTER
     ========================================================= -->

<footer class="site-footer">

    <div class="footer-container">

        <!-- =====================================================
             MAIN FOOTER CONTENT
             ===================================================== -->

        <div class="footer-main">

            <!-- =================================================
                 JENGA-CODE BRANDING
                 ================================================= -->

            <div class="footer-brand">

                <!--
                    Main jenga-code footer logo.

                    Links back to the website homepage so visitors
                    can easily return to the main jenga-code site
                    from anywhere within the WordPress blog.
                -->
                <a
                    class="footer-logo"
                    href="<?php echo esc_url(home_url('/')); ?>"
                >
                    <span class="footer-logo-symbol">
                        &lt;/&gt;
                    </span>

                    <span class="footer-logo-text">
                        jenga-code
                    </span>
                </a>

                <p class="footer-tagline">
                    Explore. Build. Understand.
                </p>

                <p class="footer-description">
                    Interactive programming projects, algorithms,
                    experiments and articles about computer science,
                    mathematics and software development.
                </p>

            </div>


            <!-- =================================================
                 WEBSITE NAVIGATION
                 ================================================= -->

            <div class="footer-column">

                <h2 class="footer-heading">
                    Explore
                </h2>

                <!--
                    Links to the primary areas of the jenga-code
                    website and WordPress blog.
                -->
                <nav
                    class="footer-navigation"
                    aria-label="Footer navigation"
                >

                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        Home
                    </a>

                    <a href="<?php echo esc_url(home_url('/blog/')); ?>">
                        Blog
                    </a>

                    <a href="<?php echo esc_url(home_url('/#projects')); ?>">
                        Projects
                    </a>

                    <a href="<?php echo esc_url(home_url('/#tutorials')); ?>">
                        Tutorials
                    </a>

                    <a href="<?php echo esc_url(home_url('/#notes')); ?>">
                        Notes
                    </a>

                </nav>

            </div>


            <!-- =================================================
                 INFORMATION NAVIGATION
                 ================================================= -->

            <div class="footer-column">

                <h2 class="footer-heading">
                    Information
                </h2>

                <!--
                    Secondary navigation for information about
                    jenga-code and important site policies.
                -->
                <nav
                    class="footer-navigation"
                    aria-label="Information navigation"
                >

                    <a href="<?php echo esc_url(home_url('/#about')); ?>">
                        About
                    </a>

                    <a href="<?php echo esc_url(home_url('/#contact')); ?>">
                        Contact
                    </a>

                    <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">
                        Privacy
                    </a>

                </nav>

            </div>


            <!-- =================================================
                 NEWSLETTER SUBSCRIPTION
                 ================================================= -->

            <div class="footer-column footer-subscribe">

                <h2 class="footer-heading">
                    Stay in the loop
                </h2>

                <p>
                    Get new articles, projects and resources
                    delivered straight to your inbox.
                </p>

                <!--
                    Newsletter subscription form.

                    The form can later be connected to the chosen
                    newsletter or mailing-list service used by
                    jenga-code.
                -->
                <form
                    class="footer-subscribe-form"
                    action="#"
                    method="post"
                >

                    <label
                        class="screen-reader-text"
                        for="footer-email"
                    >
                        Email address
                    </label>

                    <input
                        id="footer-email"
                        type="email"
                        name="email"
                        placeholder="Enter your email address"
                        autocomplete="email"
                    >

                    <button
                        class="primary-button"
                        type="submit"
                    >
                        Subscribe
                    </button>

                </form>

                <small class="footer-subscribe-note">
                    No spam. Unsubscribe anytime.
                </small>

            </div>

        </div>


        <!-- =====================================================
             FOOTER BOTTOM
             ===================================================== -->

        <div class="footer-bottom">

            <!--
                Copyright notice.

                wp_date() automatically uses the current year,
                preventing the jenga-code copyright notice from
                requiring a manual yearly update.
            -->
            <p class="footer-copyright">
                &copy;
                <?php echo esc_html(wp_date('Y')); ?>
                jenga-code.
                All rights reserved.
            </p>


            <!-- =================================================
                 SOCIAL AND RSS LINKS
                 ================================================= -->

            <div class="footer-social">

                <a
                    href="#"
                    aria-label="GitHub"
                >
                    GH
                </a>

                <a
                    href="#"
                    aria-label="LinkedIn"
                >
                    in
                </a>

                <!--
                    WordPress automatically provides the URL for
                    the jenga-code blog's RSS 2.0 feed.
                -->
                <a
                    href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>"
                    aria-label="RSS Feed"
                >
                    RSS
                </a>

            </div>

        </div>

    </div>

</footer>


<?php
/*
 * Required WordPress footer hook.
 *
 * Allows WordPress itself, plugins and the jenga-code theme to
 * enqueue scripts and output other required content immediately
 * before the closing body element.
 */
wp_footer();
?>

</body>
</html>