<?php
/**
 * jenga-code
 * Theme Functions
 *
 * Contains the core WordPress configuration and supporting functions
 * used by the custom jenga-code WordPress theme.
 *
 * This file connects the jenga-code theme to WordPress and defines
 * the functionality shared across the blog, including theme features,
 * navigation menus, stylesheets, JavaScript, widgets, excerpts,
 * image sizes, body classes and article utilities.
 *
 * The theme is designed to visually integrate the WordPress blog with
 * the main jenga-code website and its collection of programming
 * projects, interactive tools, experiments and technical articles.
 *
 * @package JengaCode
 */


/*
 * Prevent this file from being executed directly outside WordPress.
 *
 * ABSPATH is defined by WordPress during normal execution. If it is
 * unavailable, the request is not being made through WordPress and
 * execution is stopped immediately.
 */
if (!defined('ABSPATH')) {
    exit;
}


/* =========================================================
   JENGA-CODE THEME SETUP
   ========================================================= */

/**
 * Configure the standard WordPress features used by jenga-code.
 *
 * This function enables WordPress functionality required throughout
 * the custom theme and registers the navigation menu locations used
 * by the site's header and footer.
 */
function jenga_code_setup()
{
    /*
     * Let WordPress manage the document <title>.
     */
    add_theme_support('title-tag');


    /*
     * Enable featured images for posts and pages.
     *
     * These images are used throughout jenga-code for article cards,
     * archive pages and featured article layouts.
     */
    add_theme_support('post-thumbnails');


    /*
     * Enable modern HTML5 markup.
     *
     * WordPress will output HTML5-compatible markup for these
     * standard theme components instead of older legacy markup.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script'
        )
    );


    /*
     * Allow WordPress to automatically generate RSS feed links
     * for the jenga-code blog.
     */
    add_theme_support('automatic-feed-links');


    /*
     * Allow embedded media to adapt correctly to responsive
     * jenga-code page layouts.
     */
    add_theme_support('responsive-embeds');


    /*
     * Enable wide and full-width alignment options within the
     * WordPress block editor.
     */
    add_theme_support('align-wide');


    /*
     * Register the navigation menu locations used by jenga-code.
     *
     * "primary" is intended for the main site navigation.
     * "footer" is intended for navigation displayed in the footer.
     */
    register_nav_menus(
        array(
            'primary' => __('Main Navigation', 'jenga-code'),
            'footer'  => __('Footer Navigation', 'jenga-code')
        )
    );
}

add_action(
    'after_setup_theme',
    'jenga_code_setup'
);


/* =========================================================
   JENGA-CODE CSS AND JAVASCRIPT
   ========================================================= */

/**
 * Load the stylesheets and JavaScript used by the jenga-code theme.
 *
 * The main WordPress stylesheet is always loaded. Additional blog
 * styling and JavaScript are loaded only when their corresponding
 * files exist within the theme directory.
 */
function jenga_code_assets()
{
    /*
     * Main jenga-code WordPress theme stylesheet.
     *
     * WordPress requires style.css in the root of the theme
     * directory. The theme version is used as the stylesheet
     * version to assist with browser cache management.
     */
    wp_enqueue_style(
        'jenga-code-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );


    /*
     * Additional jenga-code blog-specific stylesheet.
     *
     * This stylesheet contains styling specifically required by
     * the WordPress blog and will only be loaded if blog.css exists.
     *
     * filemtime() is used as the version number so browsers receive
     * the latest stylesheet whenever the file is modified.
     */
    $blog_css_path =
        get_template_directory()
        . '/assets/css/blog.css';

    if (file_exists($blog_css_path)) {

        wp_enqueue_style(
            'jenga-code-blog',
            get_template_directory_uri()
            . '/assets/css/blog.css',
            array('jenga-code-style'),
            filemtime($blog_css_path)
        );
    }


    /*
     * Main jenga-code theme JavaScript.
     *
     * The script is only registered when main.js exists. It is
     * loaded in the footer to avoid unnecessarily blocking the
     * initial rendering of the page.
     *
     * filemtime() provides automatic cache invalidation whenever
     * the JavaScript source file changes.
     */
    $main_js_path =
        get_template_directory()
        . '/assets/js/main.js';

    if (file_exists($main_js_path)) {

        wp_enqueue_script(
            'jenga-code-main',
            get_template_directory_uri()
            . '/assets/js/main.js',
            array(),
            filemtime($main_js_path),
            true
        );
    }
}

add_action(
    'wp_enqueue_scripts',
    'jenga_code_assets'
);


/* =========================================================
   JENGA-CODE SIDEBAR / WIDGET AREA
   ========================================================= */

/**
 * Register the widget area used by the jenga-code blog sidebar.
 *
 * Widgets placed into this area through the WordPress administration
 * interface are wrapped in markup matching the jenga-code sidebar
 * card design.
 */
function jenga_code_widgets_init()
{
    register_sidebar(
        array(
            'name'          => __('Blog Sidebar', 'jenga-code'),

            'id'            => 'blog-sidebar',

            'description'   => __(
                'Widgets displayed in the jenga-code blog sidebar.',
                'jenga-code'
            ),

            /*
             * Wrap each WordPress widget in the same sidebar-card
             * structure used throughout the jenga-code design.
             */
            'before_widget' => '<section id="%1$s" class="sidebar-card widget %2$s">',

            'after_widget'  => '</section>',

            /*
             * Widget headings use the shared sidebar-label class
             * so their appearance remains consistent.
             */
            'before_title'  => '<h2 class="sidebar-label">',

            'after_title'   => '</h2>'
        )
    );
}

add_action(
    'widgets_init',
    'jenga_code_widgets_init'
);


/* =========================================================
   ARTICLE EXCERPT LENGTH
   ========================================================= */

/**
 * Set the default length of excerpts displayed by jenga-code.
 *
 * Shorter excerpts keep article cards compact and consistent
 * throughout the blog, archive and search layouts.
 *
 * @param int $length WordPress default excerpt length.
 *
 * @return int jenga-code excerpt length.
 */
function jenga_code_excerpt_length($length)
{
    return 28;
}

add_filter(
    'excerpt_length',
    'jenga_code_excerpt_length',
    999
);


/* =========================================================
   ARTICLE EXCERPT ENDING
   ========================================================= */

/**
 * Replace the standard WordPress excerpt ending with an ellipsis.
 *
 * @param string $more Existing WordPress excerpt ending.
 *
 * @return string Custom jenga-code excerpt ending.
 */
function jenga_code_excerpt_more($more)
{
    return '&hellip;';
}

add_filter(
    'excerpt_more',
    'jenga_code_excerpt_more'
);


/* =========================================================
   JENGA-CODE CUSTOM IMAGE SIZES
   ========================================================= */

/**
 * Register the custom image dimensions used throughout jenga-code.
 *
 * WordPress generates these sizes when images are uploaded, allowing
 * the theme to request appropriately sized images for different
 * parts of the blog rather than always loading the original image.
 */
function jenga_code_image_sizes()
{
    /*
     * Article cards.
     *
     * Used for article previews and other card-based layouts.
     */
    add_image_size(
        'article-card',
        700,
        420,
        true
    );


    /*
     * Large featured article.
     *
     * Intended for prominent articles and larger featured content
     * areas within the jenga-code blog.
     */
    add_image_size(
        'featured-article',
        1200,
        650,
        true
    );


    /*
     * Small sidebar thumbnails.
     *
     * Used for compact article previews and other sidebar content.
     */
    add_image_size(
        'sidebar-thumbnail',
        160,
        120,
        true
    );
}

add_action(
    'after_setup_theme',
    'jenga_code_image_sizes'
);


/* =========================================================
   JENGA-CODE BODY CLASSES
   ========================================================= */

/**
 * Add page-specific CSS classes to the WordPress body element.
 *
 * These classes allow the jenga-code stylesheet to target different
 * WordPress views without requiring separate body markup in every
 * template.
 *
 * @param array $classes Existing WordPress body classes.
 *
 * @return array Modified body classes.
 */
function jenga_code_body_classes($classes)
{
    /*
     * Main WordPress posts/blog page.
     */
    if (is_home()) {
        $classes[] = 'blog-home';
    }


    /*
     * Individual jenga-code article.
     */
    if (is_single()) {
        $classes[] = 'single-article';
    }


    /*
     * Category, tag, author, date or other archive page.
     */
    if (is_archive()) {
        $classes[] = 'archive-view';
    }


    /*
     * WordPress search results page.
     */
    if (is_search()) {
        $classes[] = 'search-view';
    }


    /*
     * Custom jenga-code 404 error page.
     */
    if (is_404()) {
        $classes[] = 'error-view';
    }


    return $classes;
}

add_filter(
    'body_class',
    'jenga_code_body_classes'
);


/* =========================================================
   ESTIMATED ARTICLE READING TIME
   ========================================================= */

/**
 * Calculate an estimated reading time for a jenga-code article.
 *
 * The post content is retrieved from WordPress, shortcodes and HTML
 * markup are removed, and the remaining words are counted.
 *
 * Reading time is estimated using an average reading speed of
 * approximately 220 words per minute.
 *
 * @param int|null $post_id Optional WordPress post ID.
 *
 * @return string Human-readable estimated reading time.
 */
function jenga_code_reading_time($post_id = null)
{
    /*
     * Use the current WordPress post when a specific post ID
     * has not been supplied.
     */
    if (!$post_id) {
        $post_id = get_the_ID();
    }


    /*
     * Retrieve the raw article content from WordPress.
     */
    $content =
        get_post_field(
            'post_content',
            $post_id
        );


    /*
     * Always return at least one minute when the post does not
     * contain readable content.
     */
    if (!$content) {
        return '1 min read';
    }


    /*
     * Remove WordPress shortcodes and HTML markup before counting
     * words so only the readable article text contributes to the
     * estimate.
     */
    $content =
        wp_strip_all_tags(
            strip_shortcodes($content)
        );


    /*
     * Count the words remaining in the article.
     */
    $word_count =
        str_word_count($content);


    /*
     * Approximate reading speed:
     * 220 words per minute.
     *
     * ceil() rounds partial minutes upwards while max() ensures
     * that even very short articles display at least one minute.
     */
    $minutes =
        max(
            1,
            (int) ceil($word_count / 220)
        );


    /*
     * Return the translated and correctly formatted reading-time
     * label for use within jenga-code article templates.
     */
    return sprintf(
        _n(
            '%s min read',
            '%s min read',
            $minutes,
            'jenga-code'
        ),
        number_format_i18n($minutes)
    );
}


/* =========================================================
   PRIMARY POST CATEGORY
   ========================================================= */

/**
 * Display the primary category associated with the current article.
 *
 * WordPress can associate multiple categories with a post. For the
 * compact jenga-code article interface, the first category returned
 * by WordPress is displayed as the primary category.
 */
function jenga_code_primary_category()
{
    /*
     * Retrieve all categories associated with the current post.
     */
    $categories =
        get_the_category();


    /*
     * Nothing needs to be displayed when the article has not been
     * assigned to a category.
     */
    if (empty($categories)) {
        return;
    }


    /*
     * Use the first returned category as the article's displayed
     * primary category.
     */
    $category =
        $categories[0];


    /*
     * Output a safe link to the corresponding WordPress
     * category archive.
     */
    echo sprintf(
        '<a class="article-category" href="%s">%s</a>',
        esc_url(
            get_category_link(
                $category->term_id
            )
        ),
        esc_html(
            $category->name
        )
    );
}


/* =========================================================
   JENGA-CODE PAGINATION
   ========================================================= */

/**
 * Display standard WordPress pagination using jenga-code labels.
 *
 * This helper can be reused by blog, archive and other templates
 * that display collections of articles across multiple pages.
 */
function jenga_code_pagination()
{
    the_posts_pagination(
        array(
            'mid_size'  => 2,

            'prev_text' =>
                __('← Previous', 'jenga-code'),

            'next_text' =>
                __('Next →', 'jenga-code'),

            'screen_reader_text' =>
                __('Article navigation', 'jenga-code')
        )
    );
}


/* =========================================================
   REMOVE WORDPRESS EMOJI ASSETS
   ========================================================= */

/*
 * jenga-code does not require WordPress's legacy emoji
 * JavaScript and CSS on the front end.
 *
 * Removing these assets avoids loading resources that are not
 * required by the custom theme.
 */

remove_action(
    'wp_head',
    'print_emoji_detection_script',
    7
);

remove_action(
    'wp_print_styles',
    'print_emoji_styles'
);


/* =========================================================
   WORDPRESS COMMENTS
   ========================================================= */

/**
 * Load WordPress's threaded comment reply JavaScript when required.
 *
 * The script is only loaded on individual pages/posts where comments
 * are enabled and WordPress threaded comments have been activated.
 * This prevents an unnecessary script from loading throughout the
 * rest of jenga-code.
 */
function jenga_code_comments_script()
{
    if (
        is_singular()
        && comments_open()
        && get_option('thread_comments')
    ) {

        wp_enqueue_script(
            'comment-reply'
        );
    }
}

add_action(
    'wp_enqueue_scripts',
    'jenga_code_comments_script'
);