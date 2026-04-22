<?php
/**
 * Widget area registrations.
 *
 * @package farbest
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function farbest_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'farbest' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'farbest_widgets_init' );

function farbest_ingredient_sidebar_init() {
	register_sidebar( array(
		'name'          => 'Ingredient Sidebar Menu',
		'id'            => 'ingredient_menu_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'farbest_ingredient_sidebar_init' );

function footer_widget1_init() {
	register_sidebar( array(
		'name'          => 'Footer Left',
		'id'            => 'footer_left',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
	) );
}
add_action( 'widgets_init', 'footer_widget1_init' );

function footer_widget2_init() {
	register_sidebar( array(
		'name'          => 'Footer Center',
		'id'            => 'footer_center',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
	) );
}
add_action( 'widgets_init', 'footer_widget2_init' );

function footer_widget3_init() {
	register_sidebar( array(
		'name'          => 'Footer Right',
		'id'            => 'footer_right',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
	) );
}
add_action( 'widgets_init', 'footer_widget3_init' );
