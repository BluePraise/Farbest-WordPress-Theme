<?php
/**
 * ACF customization — JSON save point.
 *
 * @package farbest
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function farbest_acf_json_save_point( $path ) {
	return get_stylesheet_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'farbest_acf_json_save_point' );
