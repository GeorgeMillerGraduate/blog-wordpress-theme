<?php
/**
 * jenga-code - Header Template
 *
 * Displays the shared header used throughout the custom jenga-code
 * WordPress theme.
 *
 * This template creates the opening HTML document structure and the
 * primary navigation interface used across the jenga-code blog.
 *
 * It visually connects the WordPress blog with the main jenga-code
 * website, programming projects, interactive applications, tutorials
 * and technical content.
 *
 * The header provides:
 * - Standard WordPress document metadata
 * - The required wp_head() hook
 * - The jenga-code image logo
 * - Main website and blog navigation
 * - WordPress search functionality
 * - GitHub, LinkedIn and RSS links
 * - Newsletter subscription navigation
 * - The required wp_body_open() hook
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

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

    <!--
        Use the character encoding configured within WordPress.
    -->
    <meta charset="<?php bloginfo('charset'); ?>">


    <!--
        Ensure jenga-code scales correctly across desktop,
        tablet and mobile displays.
    -->
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >


    <?php
    /*
     * Required WordPress head hook.
     *
     * Allows WordPress, plugins and the jenga-code theme to insert
     * stylesheets, scripts, metadata and other required resources.
     */
    wp_head();
    ?>

</head>


<body <?php body_class(); ?>>

<?php
/*
 * Required WordPress body hook.
 *
 * Allows WordPress and installed plugins to output content
 * immediately after the opening body element.
 */
wp_body_open();
?>


<!-- =====================================================
     JENGA-CODE
     SHARED WORDPRESS HEADER
     ===================================================== -->

<header class="site-header">

    <div class="header-inner">


        <!-- =================================================
             JENGA-CODE LOGO
             ================================================= -->

        <!--
            Main jenga-code site identity.

            The logo image is stored inside the active WordPress
            theme at:

            /images/logo.png

            get_template_directory_uri() automatically generates
            the correct public URL for the active theme directory.

            Clicking the logo returns the visitor to the main
            jenga-code homepage.
        -->
        <a
            class="site-logo"
            href="<?php echo esc_url(home_url('/')); ?>"
            aria-label="jenga-code home"
        >

            <img
                class="logo-image"
                src="<?php
                echo esc_url(
                    get_template_directory_uri()
                    . '/images/logo.png'
                );
                ?>"
                alt="jenga-code"
            >

        </a>



        <!-- =================================================
             JENGA-CODE MAIN NAVIGATION
             ================================================= -->

        <!--
            Primary navigation shared between the WordPress blog
            and the wider jenga-code website.
        -->
        <nav
            class="main-nav"
            aria-label="Main navigation"
        >


            <!-- =============================================
                 HOME
                 ============================================= -->

            <a
                href="<?php echo esc_url(home_url('/')); ?>"
                <?php
                if (!is_home() && !is_singular('post')) {
                    echo 'class="home-link"';
                }
                ?>
            >
                Home
            </a>



            <!-- =============================================
                 BLOG
                 ============================================= -->

            <!--
                The Blog link receives the active class while
                viewing blog-related WordPress content.
            -->
            <a
                href="<?php echo esc_url(home_url('/blog/')); ?>"
                <?php
                if (
                    is_home()
                    || is_single()
                    || is_archive()
                    || is_search()
                ) {
                    echo 'class="active"';
                }
                ?>
            >
                Blog
            </a>



            <!-- =============================================
                 PROJECTS
                 ============================================= -->

            <a
                href="<?php
                echo esc_url(
                    home_url('/#projects')
                );
                ?>"
            >
                Projects
            </a>



            <!-- =============================================
                 TUTORIALS
                 ============================================= -->

            <a
                href="<?php
                echo esc_url(
                    home_url('/#tutorials')
                );
                ?>"
            >
                Tutorials
            </a>



            <!-- =============================================
                 NOTES
                 ============================================= -->

            <a
                href="<?php
                echo esc_url(
                    home_url('/#notes')
                );
                ?>"
            >
                Notes
            </a>



            <!-- =============================================
                 ABOUT
                 ============================================= -->

            <a
                href="<?php
                echo esc_url(
                    home_url('/#about')
                );
                ?>"
            >
                About
            </a>



            <!-- =============================================
                 CONTACT
                 ============================================= -->

            <a
                href="<?php
                echo esc_url(
                    home_url('/#contact')
                );
                ?>"
            >
                Contact
            </a>


        </nav>



        <!-- =================================================
             JENGA-CODE SEARCH
             ================================================= -->

        <!--
            WordPress search form.

            Search queries use WordPress's standard "s"
            query parameter.
        -->
        <form
            class="header-search"
            role="search"
            method="get"
            action="<?php echo esc_url(home_url('/')); ?>"
        >

            <label
                class="screen-reader-text"
                for="header-search-field"
            >
                Search articles
            </label>


            <input
                id="header-search-field"
                type="search"
                name="s"
                value="<?php echo esc_attr(get_search_query()); ?>"
                placeholder="Search articles, projects, tutorials..."
                aria-label="Search"
            >


            <button
                type="submit"
                aria-label="Search"
            >
                &#8981;
            </button>

        </form>



        <!-- =================================================
             JENGA-CODE SOCIAL AND EXTERNAL LINKS
             ================================================= -->

        <div class="header-social">


            <!-- =============================================
                 GITHUB
                 ============================================= -->

            <a
                href="https://github.com/GeorgeMillerGraduate"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="GitHub"
            >
                GH
            </a>



            <!-- =============================================
                 LINKEDIN
                 ============================================= -->

            <!--
                This currently points to the Contact section.

                It can later be replaced with the actual LinkedIn
                profile URL if desired.
            -->
            <a
                href="<?php
                echo esc_url(
                    home_url('/#contact')
                );
                ?>"
                aria-label="LinkedIn"
            >
                in
            </a>



            <!-- =============================================
                 RSS
                 ============================================= -->

            <a
                href="<?php
                echo esc_url(
                    get_bloginfo('rss2_url')
                );
                ?>"
                aria-label="RSS Feed"
            >
                RSS
            </a>


        </div>



        <!-- =================================================
             NEWSLETTER SUBSCRIPTION
             ================================================= -->

        <a
            class="subscribe-button"
            href="<?php
            echo esc_url(
                home_url('/#newsletter')
            );
            ?>"
        >
            Subscribe
        </a>


    </div>

</header>