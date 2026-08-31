<?php
/**
 * Header Template
 *
 * @package CodeAndCuriosity
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo('charset'); ?>">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <?php wp_head(); ?>

</head>


<body <?php body_class(); ?>>

<?php wp_body_open(); ?>


<!-- =====================================================
     HEADER
     ===================================================== -->

<header class="site-header">

    <div class="header-inner">


        <!-- =================================================
             LOGO
             ================================================= -->

        <a
            class="site-logo"
            href="<?php echo esc_url(home_url('/')); ?>"
            aria-label="Code and Curiosity home"
        >

            <span class="logo-symbol">
                &lt;/&gt;
            </span>


            <span class="logo-copy">

                <span class="logo-name">
                    Code &amp;
                    <strong>Curiosity</strong>
                </span>

                <span class="logo-tagline">
                    Explore. Build. Understand.
                </span>

            </span>

        </a>



        <!-- =================================================
             MAIN NAVIGATION
             ================================================= -->

        <nav
            class="main-nav"
            aria-label="Main navigation"
        >


            <!-- HOME -->

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



            <!-- BLOG -->

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



            <!-- PROJECTS -->

            <a
                href="<?php
                echo esc_url(
                    home_url('/#projects')
                );
                ?>"
            >
                Projects
            </a>



            <!-- TUTORIALS -->

            <a
                href="<?php
                echo esc_url(
                    home_url('/#tutorials')
                );
                ?>"
            >
                Tutorials
            </a>



            <!-- NOTES -->

            <a
                href="<?php
                echo esc_url(
                    home_url('/#notes')
                );
                ?>"
            >
                Notes
            </a>



            <!-- ABOUT -->

            <a
                href="<?php
                echo esc_url(
                    home_url('/#about')
                );
                ?>"
            >
                About
            </a>



            <!-- CONTACT -->

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
             SEARCH
             ================================================= -->

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
             SOCIAL LINKS
             ================================================= -->

        <div class="header-social">


            <!-- GITHUB -->

            <a
                href="https://github.com/GeorgeMillerGraduate"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="GitHub"
            >
                GH
            </a>



            <!-- LINKEDIN -->

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



            <!-- RSS -->

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
             SUBSCRIBE
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