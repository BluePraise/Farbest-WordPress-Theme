<?php
/**
 * Widget areas.
 *
 * Only the three footer columns are registered. footer.php renders each one
 * when it has widgets and falls back to static markup when it does not, so a
 * fresh install still shows a complete footer.
 *
 * The IDs match the previous theme (footer_left / footer_center /
 * footer_right) on purpose — the staging site already has widgets assigned to
 * them, and changing the IDs would orphan that content.
 *
 * @package farbest-classic
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the footer widget areas.
 */
function farbest_widgets_init() {
	$columns = array(
		'footer_left'   => __( 'Footer Left', 'farbest-classic' ),
		'footer_center' => __( 'Footer Center', 'farbest-classic' ),
		'footer_right'  => __( 'Footer Right', 'farbest-classic' ),
	);

	foreach ( $columns as $id => $name ) {
		register_sidebar( array(
			'name'          => $name,
			'id'            => $id,
			'description'   => __( 'Footer column widgets.', 'farbest-classic' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="farbest-footer__col-heading">',
			'after_title'   => '</h6>',
		) );
	}
}
add_action( 'widgets_init', 'farbest_widgets_init' );
