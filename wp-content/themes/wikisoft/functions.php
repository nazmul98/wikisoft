<?php 
require_once get_theme_file_path('/inc/tgm.php');

function wikisoft_theme_setup () {
    load_theme_textdomain( 'wikisoft' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'post-formats', ['audio', 'video', 'image', 'gallery', 'quote', 'link'] );
    add_theme_support( 'html5', ['search-form', 'comment-list'] );
    add_editor_style( '/assets/css/editor-style.css' );
    register_nav_menu( 'topmenu', __( 'Top Menu', 'wikisoft' ) );
    add_image_size('wikisoft-square', 400, 400, true);
}
add_action('after_setup_theme', 'wikisoft_theme_setup');

function wikisoft_assets() {
    // Cache Busting
    if (site_url() == 'http://localhost/wikisoft') {
        define('VERSION', time());
    } else {
        define('VERSION', wp_get_theme()->get('Version'));
    }

    // StyleSheets
    wp_enqueue_style('fontawesome', get_theme_file_uri('/assets/css/font-awesome/css/font-awesome.min.css'), null, VERSION);
    wp_enqueue_style('fonts', get_theme_file_uri('/assets/css/fonts.css'), null, VERSION);
    wp_enqueue_style('base', get_theme_file_uri('/assets/css/base.css'), null, VERSION);
    wp_enqueue_style('vendor', get_theme_file_uri('/assets/css/vendor.css'), null, VERSION);
    wp_enqueue_style('main', get_theme_file_uri('/assets/css/main.css'), null, VERSION);
    wp_enqueue_style('wikisoft', get_stylesheet_uri(), null, VERSION);

    // Header Script
    wp_enqueue_script('modernizr', get_theme_file_uri('/assets/js/modernizr.js'), null, VERSION);
    wp_enqueue_script('pace', get_theme_file_uri('/assets/js/pace.min.js'), null, VERSION);

    // Footer Script
    wp_enqueue_script('plugins', get_theme_file_uri('/assets/js/plugins.js'), ['jquery'], VERSION, true);
    wp_enqueue_script('main', get_theme_file_uri('/assets/js/main.js'), ['jquery'], VERSION, true);
}
add_action('wp_enqueue_scripts', 'wikisoft_assets');

// WikiSoft Pagination
function wikisoft_pagination () {
    global $wp_query;
    $links = paginate_links([
        'total'   => isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1,
        'current' => get_query_var( 'paged' ) ? (int) get_query_var( 'paged' ) : 1,
        'type' => 'list'
    ]);
    $links = str_replace('page-numbers', 'pgn__num', $links);
    $links = str_replace("<ul class='pgn__num'>", "<ul>", $links);
    $links = str_replace("prev pgn__num", "pgn__prev", $links);
    $links = str_replace("next pgn__num", "pgn__next", $links);
    return $links;
}