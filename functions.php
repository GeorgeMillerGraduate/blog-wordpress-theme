<?php
/**
 * Code & Curiosity
 * Theme Functions
 *
 * @package CodeAndCuriosity
 */

if (!defined('ABSPATH')) {
    exit;
}


/* =========================================================
   THEME SETUP
   ========================================================= */

function code_and_curiosity_setup()
{
    /*
     * Let WordPress manage the document <title>.
     */
    add_theme_support('title-tag');


    /*
     * Enable featured images for posts and pages.
     */
    add_theme_support('post-thumbnails');


    /*
     * Enable modern HTML5 markup.
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
     * Allow WordPress to generate RSS links.
     */
    add_theme_support('automatic-feed-links');


    /*
     * Allow responsive embedded content.
     */
    add_theme_support('responsive-embeds');


    /*
     * Allow WordPress block editor alignment options.
     */
    add_theme_support('align-wide');


    /*
     * Register navigation menu locations.
     */
    register_nav_menus(
        array(
            'primary' => __('Main Navigation', 'code-and-curiosity'),
            'footer'  => __('Footer Navigation', 'code-and-curiosity')
        )
    );
}

add_action(
    'after_setup_theme',
    'code_and_curiosity_setup'
);


/* =========================================================
   LOAD CSS AND JAVASCRIPT
   ========================================================= */

function code_and_curiosity_assets()
{
    /*
     * Main WordPress theme stylesheet.
     *
     * WordPress requires style.css in the root
     * of the theme directory.
     */
    wp_enqueue_style(
        'code-and-curiosity-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );


    /*
     * Additional blog-specific stylesheet.
     *
     * This will only be loaded if the file exists.
     */
    $blog_css_path =
        get_template_directory()
        . '/assets/css/blog.css';

    if (file_exists($blog_css_path)) {

        wp_enqueue_style(
            'code-and-curiosity-blog',
            get_template_directory_uri()
            . '/assets/css/blog.css',
            array('code-and-curiosity-style'),
            filemtime($blog_css_path)
        );
    }


    /*
     * Theme JavaScript.
     *
     * Again, only load it when the file exists.
     */
    $main_js_path =
        get_template_directory()
        . '/assets/js/main.js';

    if (file_exists($main_js_path)) {

        wp_enqueue_script(
            'code-and-curiosity-main',
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
    'code_and_curiosity_assets'
);


/* =========================================================
   SIDEBAR / WIDGET AREA
   ========================================================= */

function code_and_curiosity_widgets_init()
{
    register_sidebar(
        array(
            'name'          => __('Blog Sidebar', 'code-and-curiosity'),

            'id'            => 'blog-sidebar',

            'description'   => __(
                'Widgets displayed in the Code & Curiosity blog sidebar.',
                'code-and-curiosity'
            ),

            'before_widget' => '<section id="%1$s" class="sidebar-card widget %2$s">',

            'after_widget'  => '</section>',

            'before_title'  => '<h2 class="sidebar-label">',

            'after_title'   => '</h2>'
        )
    );
}

add_action(
    'widgets_init',
    'code_and_curiosity_widgets_init'
);


/* =========================================================
   EXCERPT LENGTH
   ========================================================= */

function code_and_curiosity_excerpt_length($length)
{
    return 28;
}

add_filter(
    'excerpt_length',
    'code_and_curiosity_excerpt_length',
    999
);


/* =========================================================
   EXCERPT ENDING
   ========================================================= */

function code_and_curiosity_excerpt_more($more)
{
    return '&hellip;';
}

add_filter(
    'excerpt_more',
    'code_and_curiosity_excerpt_more'
);


/* =========================================================
   CUSTOM IMAGE SIZES
   ========================================================= */

function code_and_curiosity_image_sizes()
{
    /*
     * Article cards.
     */
    add_image_size(
        'article-card',
        700,
        420,
        true
    );


    /*
     * Large featured article.
     */
    add_image_size(
        'featured-article',
        1200,
        650,
        true
    );


    /*
     * Small sidebar thumbnails.
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
    'code_and_curiosity_image_sizes'
);


/* =========================================================
   BODY CLASSES
   ========================================================= */

function code_and_curiosity_body_classes($classes)
{
    if (is_home()) {
        $classes[] = 'blog-home';
    }

    if (is_single()) {
        $classes[] = 'single-article';
    }

    if (is_archive()) {
        $classes[] = 'archive-view';
    }

    if (is_search()) {
        $classes[] = 'search-view';
    }

    if (is_404()) {
        $classes[] = 'error-view';
    }

    return $classes;
}

add_filter(
    'body_class',
    'code_and_curiosity_body_classes'
);


/* =========================================================
   ESTIMATED READING TIME
   ========================================================= */

function code_and_curiosity_reading_time($post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }


    $content =
        get_post_field(
            'post_content',
            $post_id
        );


    if (!$content) {
        return '1 min read';
    }


    $content =
        wp_strip_all_tags(
            strip_shortcodes($content)
        );


    $word_count =
        str_word_count($content);


    /*
     * Approximate reading speed:
     * 220 words per minute.
     */
    $minutes =
        max(
            1,
            (int) ceil($word_count / 220)
        );


    return sprintf(
        _n(
            '%s min read',
            '%s min read',
            $minutes,
            'code-and-curiosity'
        ),
        number_format_i18n($minutes)
    );
}


/* =========================================================
   POST CATEGORY
   ========================================================= */

function code_and_curiosity_primary_category()
{
    $categories =
        get_the_category();


    if (empty($categories)) {
        return;
    }


    $category =
        $categories[0];


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
   PAGINATION
   ========================================================= */

function code_and_curiosity_pagination()
{
    the_posts_pagination(
        array(
            'mid_size'  => 2,

            'prev_text' =>
                __('← Previous', 'code-and-curiosity'),

            'next_text' =>
                __('Next →', 'code-and-curiosity'),

            'screen_reader_text' =>
                __('Article navigation', 'code-and-curiosity')
        )
    );
}


/* =========================================================
   REMOVE WORDPRESS EMOJI ASSETS
   ========================================================= */

/*
 * The site does not require WordPress's legacy emoji
 * JavaScript/CSS on the front end.
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
   COMMENTS
   ========================================================= */

function code_and_curiosity_comments_script()
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
    'code_and_curiosity_comments_script'
);