<?php
/**
 * Farbest functions and definitions.
 *
 * @package farbest
 */

if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

if ( ! function_exists( 'farbest_setup' ) ) :
function farbest_setup() {
	load_theme_textdomain( 'farbest', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'farbest' ),
	) );

	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
}
endif;
add_action( 'after_setup_theme', 'farbest_setup' );

/**
 * Enqueue scripts and styles.
 */
function farbest_scripts() {
	wp_enqueue_style( 'farbest-style', get_stylesheet_uri() );
	wp_enqueue_style( 'farbest-tokens', get_template_directory_uri() . '/css/tokens.css', array( 'farbest-style' ), '1.0.0' );
	wp_enqueue_style( 'farbest-main', get_template_directory_uri() . '/css/farbest.css', array( 'farbest-tokens' ), '1.1.0' );

	if ( is_singular( 'fpc_ingredient' ) ) {
		wp_enqueue_style(
			'farbest-ingredient-single',
			get_template_directory_uri() . '/css/ingredient-single.css',
			array( 'farbest-tokens' ),
			'1.1.0'
		);
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'farbest_scripts' );

/**
 * Register custom blocks.
 */
function farbest_register_blocks() {
	$block_path = get_template_directory() . '/build/ingredient-catalog';
	if ( file_exists( $block_path ) ) {
		register_block_type( $block_path );
	}
}
add_action( 'init', 'farbest_register_blocks' );

/**
 * Utility shortcode: [year]
 */
function farbest_year_shortcode() {
	return date( 'Y' );
}
add_shortcode( 'year', 'farbest_year_shortcode' );

/**
 * Keep archive queries sorted alphabetically.
 */
function farbest_archive_sort_order( $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_archive() ) {
		$query->set( 'orderby', 'title' );
		$query->set( 'order', 'ASC' );
	}
}
add_action( 'pre_get_posts', 'farbest_archive_sort_order' );

/**
 * Deprecated AJAX handler — retired filter demo endpoint.
 */
function farbest_deprecated_filter_demo_ajax() {
	wp_send_json_error(
		array(
			'message'          => 'This endpoint is deprecated. Use /wp-json/farbest/v1/ingredients instead.',
			'deprecated_since' => '1.1.0',
		),
		410
	);
}
add_action( 'wp_ajax_get_ingredients_filter_demo', 'farbest_deprecated_filter_demo_ajax' );
add_action( 'wp_ajax_nopriv_get_ingredients_filter_demo', 'farbest_deprecated_filter_demo_ajax' );

/**
 * Inc files.
 */
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/cpt-legacy.php';
require get_template_directory() . '/inc/acf.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/jetpack.php';
