<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till "div id="content">
 *
 * @package farbest
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
	<!--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">-->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery-ui.structure.css">
	<link rel="icon" href="https://farbest.com/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="https://farbest.com/favicon.ico" type="image/x-icon" />
	<?php wp_head(); ?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.viewportchecker.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.custom.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/doubletaptogo.min.js"></script>
	<?php if (is_page(1453)) { ?>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jscolor.js"></script>
	<?php } ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">

		<header <?php if (is_front_page()) {
					echo 'id="fb_home"';
				} else {
					echo 'id="fb_inner"';
				} ?>>
			<div class="fb_menu_trigger">
				<a class="shiftnav-toggle" style="color:#333" data-shiftnav-target="shiftnav-main"><i class="fas fa-bars"></i></a>
			</div>
			<div class="fb_content">
				<div style="float:left"><a href="<?php echo esc_url(home_url('/')); ?>"><img class="logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Homepage"></a></div>
				<div style="float:right;margin-top:60px;">
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php _e('Primary Menu', 'farbest'); ?></button>
						<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu')); ?>
					</nav><!-- #site-navigation -->
				</div>
			</div>
		</header>

		<div id="content" class="site-content <?php if (is_front_page()) {
													echo 'hero';
												} ?>">