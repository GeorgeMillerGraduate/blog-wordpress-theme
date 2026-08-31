<?php
/**
 * 404 Error Template
 *
 * @package CodeAndCuriosity
 */

get_header();
?>

<main class="error-page">

    <section class="error-card">

        <span class="content-label">
            ERROR 404
        </span>

        <div class="error-code">
            404
        </div>

        <h1>
            Page not found.
        </h1>

        <p class="error-description">
            The page you're looking for may have been moved,
            renamed or no longer exists.
        </p>

        <div class="error-actions">

            <a
                class="primary-button"
                href="<?php echo esc_url(home_url('/')); ?>"
            >
                Return Home
                <span>→</span>
            </a>

            <a
                class="text-button"
                href="<?php echo esc_url(home_url('/blog/')); ?>"
            >
                Browse the Blog
                <span>→</span>
            </a>

        </div>

        <div class="error-search">

            <h2>
                Try searching instead
            </h2>

            <?php get_search_form(); ?>

        </div>

    </section>

</main>

<?php
get_footer();