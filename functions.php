<?php
/**
 * Farbest Classic — theme setup, assets, and includes.
 *
 * This is a classic PHP theme by design. It must never contain a
 * templates/index.html or a theme.json: either would flip
 * wp_is_block_theme() to true and change how WordPress resolves templates
 * out from under the Farbest Product Catalog plugin.
 *
 * @package farbest-classic
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FARBEST_VERSION', '1.0.0' );

/**
 * Theme setup.
 */
function farbest_setup() {
	load_theme_textdomain( 'farbest-classic', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'responsive-embeds' );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'farbest-classic' ),
		'footer'  => __( 'Footer Menu', 'farbest-classic' ),
	) );

	// Brand colour palette for the block editor and Kadence pickers. This theme
	// has no theme.json (by design), so the palette is declared here instead;
	// the matching `.has-{slug}-color` / `-background-color` classes live in
	// css/base.css so the colours also render on the front end. Slugs/hex mirror
	// css/tokens.css — keep them in sync.
	add_theme_support( 'editor-color-palette', array(
		array( 'name' => __( 'Green', 'farbest-classic' ),         'slug' => 'farbest-green',         'color' => '#648c1c' ),
		array( 'name' => __( 'Heading Green', 'farbest-classic' ), 'slug' => 'farbest-heading-green', 'color' => '#4d7b29' ),
		array( 'name' => __( 'Moss Green', 'farbest-classic' ),    'slug' => 'farbest-moss',          'color' => '#5c643a' ),
		array( 'name' => __( 'Teal', 'farbest-classic' ),          'slug' => 'farbest-teal',          'color' => '#003e52' ),
		array( 'name' => __( 'Lime', 'farbest-classic' ),          'slug' => 'farbest-lime',          'color' => '#b5b800' ),
		array( 'name' => __( 'Lime Dark', 'farbest-classic' ),     'slug' => 'farbest-lime-dark',     'color' => '#9da000' ),
		array( 'name' => __( 'Beige', 'farbest-classic' ),         'slug' => 'farbest-beige',         'color' => '#f2efe9' ),
		array( 'name' => __( 'Beige Dark', 'farbest-classic' ),    'slug' => 'farbest-beige-dark',    'color' => '#ddd7cb' ),
		array( 'name' => __( 'Warm Grey', 'farbest-classic' ),     'slug' => 'farbest-warm-grey',     'color' => '#383838' ),
		array( 'name' => __( 'Footer Navy', 'farbest-classic' ),   'slug' => 'farbest-footer-bg',     'color' => '#1f2f36' ),
		array( 'name' => __( 'White', 'farbest-classic' ),         'slug' => 'farbest-white',         'color' => '#ffffff' ),
	) );
}
add_action( 'after_setup_theme', 'farbest_setup' );

/**
 * Content width used by embeds and oEmbed.
 */
function farbest_content_width() {
	$GLOBALS['content_width'] = 780;
}
add_action( 'after_setup_theme', 'farbest_content_width', 0 );

/**
 * File-modification-time asset version, for cache busting.
 *
 * Returns the file's mtime so browsers and CDNs pick up changes without a
 * manually bumped version string.
 *
 * @param string $relative_path Path relative to the theme root, e.g. 'css/global.css'.
 * @return string
 */
function farbest_asset_version( $relative_path ) {
	$file = get_template_directory() . '/' . ltrim( $relative_path, '/' );
	return file_exists( $file ) ? (string) filemtime( $file ) : FARBEST_VERSION;
}

/**
 * Register and enqueue front-end assets.
 *
 * Load order matters: tokens.css declares the custom properties every other
 * stylesheet consumes, so each one depends on it.
 */
function farbest_scripts() {
	$uri = get_template_directory_uri();

	wp_enqueue_style(
		'farbest-fonts',
		'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'farbest-tokens', $uri . '/css/tokens.css', array(), farbest_asset_version( 'css/tokens.css' ) );

	foreach ( array( 'base', 'global', 'header', 'footer' ) as $handle ) {
		wp_enqueue_style(
			'farbest-' . $handle,
			$uri . '/css/' . $handle . '.css',
			array( 'farbest-tokens' ),
			farbest_asset_version( 'css/' . $handle . '.css' )
		);
	}

	if ( is_page_template( 'page-card-grid.php' ) ) {
		wp_enqueue_style(
			'farbest-card-grid',
			$uri . '/css/card-grid.css',
			array( 'farbest-tokens' ),
			farbest_asset_version( 'css/card-grid.css' )
		);
	}

	// Markup for these pages comes from the Farbest Product Catalog plugin;
	// the theme supplies the layout.
	if ( is_singular( 'fpc_ingredient' ) ) {
		wp_enqueue_style(
			'farbest-ingredient-single',
			$uri . '/css/ingredient-single.css',
			array( 'farbest-tokens' ),
			farbest_asset_version( 'css/ingredient-single.css' )
		);
	}

	wp_enqueue_script(
		'farbest-header',
		$uri . '/js/header.js',
		array(),
		farbest_asset_version( 'js/header.js' ),
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'farbest_scripts' );

/**
 * Style the block editor to match the front end, so page content previews
 * accurately. This does not make the theme a block theme.
 */
function farbest_editor_styles() {
	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'css/tokens.css', 'css/base.css' ) );
}
add_action( 'after_setup_theme', 'farbest_editor_styles' );

/**
 * Sort archive queries alphabetically.
 */
function farbest_archive_sort_order( $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_archive() ) {
		$query->set( 'orderby', 'title' );
		$query->set( 'order', 'ASC' );
	}
}
add_action( 'pre_get_posts', 'farbest_archive_sort_order' );

/**
 * Utility shortcode: [year]
 */
function farbest_year_shortcode() {
	return esc_html( wp_date( 'Y' ) );
}
add_shortcode( 'year', 'farbest_year_shortcode' );

require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/acf.php';
require get_template_directory() . '/inc/card-grid.php';
