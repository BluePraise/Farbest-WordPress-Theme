<?php
/**
 * ACF integration.
 *
 * Points ACF's JSON sync at the theme's acf-json/ directory so field group
 * changes are version-controlled instead of living only in the database.
 *
 * The ingredient field groups belong to the Farbest Product Catalog plugin and
 * are registered in PHP there — do not duplicate them here. The only field
 * group this theme owns is the Card Grid repeater (inc/card-grid.php).
 *
 * @package farbest-classic
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Save ACF field group JSON into the theme.
 *
 * @param string $path Default save path.
 * @return string
 */
function farbest_acf_json_save_point( $path ) {
	return get_template_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'farbest_acf_json_save_point' );

/**
 * Load ACF field group JSON from the theme.
 *
 * @param array $paths Default load paths.
 * @return array
 */
function farbest_acf_json_load_point( $paths ) {
	unset( $paths[0] );
	$paths[] = get_template_directory() . '/acf-json';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'farbest_acf_json_load_point' );
