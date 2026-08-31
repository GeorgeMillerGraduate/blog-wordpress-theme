<?php
/**
 * Footer Template
 *
 * @package CodeAndCuriosity
 */
?>

<footer class="site-footer">

    <div class="footer-container">

        <div class="footer-main">

            <div class="footer-brand">

                <a
                    class="footer-logo"
                    href="<?php echo esc_url(home_url('/')); ?>"
                >
                    <span class="footer-logo-symbol">
                        &lt;/&gt;
                    </span>

                    <span class="footer-logo-text">
                        Code &amp; Curiosity
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


            <div class="footer-column">

                <h2 class="footer-heading">
                    Explore
                </h2>

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


            <div class="footer-column">

                <h2 class="footer-heading">
                    Information
                </h2>

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


            <div class="footer-column footer-subscribe">

                <h2 class="footer-heading">
                    Stay in the loop
                </h2>

                <p>
                    Get new articles, projects and resources
                    delivered straight to your inbox.
                </p>

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


        <div class="footer-bottom">

            <p class="footer-copyright">
                &copy;
                <?php echo esc_html(wp_date('Y')); ?>
                Code &amp; Curiosity.
                All rights reserved.
            </p>

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


<?php wp_footer(); ?>

</body>
</html>