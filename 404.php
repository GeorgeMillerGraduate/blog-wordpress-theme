<?php
/**
 * jenga-code - 404 Error Template
 *
 * Displays the custom "Page Not Found" screen whenever WordPress
 * cannot locate the page, article or resource requested by the user.
 *
 * This template forms part of the custom jenga-code WordPress theme
 * and follows the same visual design language as the main jenga-code
 * website.
 *
 * The page provides:
 * - A clear 404 error message
 * - A link back to the jenga-code home page
 * - A link to browse the blog
 * - A WordPress search form for locating other content
 *
 * @package JengaCode
 */

/*
 * Load the shared jenga-code header.
 *
 * WordPress resolves this through header.php, allowing the blog
 * navigation and branding to remain consistent throughout the site.
 */
get_header();
?>

<!-- =========================================================
     JENGA-CODE
     CUSTOM 404 ERROR PAGE
     ========================================================= -->

<main class="error-page">

    <!--
        Main 404 card.

        The classes used here are shared with the wider jenga-code
        design system so buttons, labels and typography remain
        visually consistent with the main website and blog.
    -->
    <section class="error-card">

        <!-- Error category label -->
        <span class="content-label">
            ERROR 404
        </span>

        <!-- Large visual error code -->
        <div class="error-code">
            404
        </div>

        <!-- Primary error message -->
        <h1>
            Page not found.
        </h1>

        <!-- Explanation for the visitor -->
        <p class="error-description">
            The page you're looking for may have been moved,
            renamed or no longer exists.
        </p>

        <!-- =================================================
             ERROR PAGE NAVIGATION
             ================================================= -->

        <div class="error-actions">

            <!-- Return to the main jenga-code home page -->
            <a
                class="primary-button"
                href="<?php echo esc_url(home_url('/')); ?>"
            >
                Return Home
                <span>→</span>
            </a>

            <!-- Browse the jenga-code blog -->
            <a
                class="text-button"
                href="<?php echo esc_url(home_url('/blog/')); ?>"
            >
                Browse the Blog
                <span>→</span>
            </a>

        </div>

        <!-- =================================================
             WORDPRESS SEARCH
             ================================================= -->

        <div class="error-search">

            <h2>
                Try searching instead
            </h2>

            <!--
                Load the standard WordPress search form so visitors
                can search jenga-code without leaving the 404 page.
            -->
            <?php get_search_form(); ?>

        </div>

    </section>

</main>

<?php
/*
 * Load the shared jenga-code footer from footer.php.
 */
get_footer();