<?php
/**
 * The header for our theme.
 *
 * Displays the <head> section and everything up to the opening of #content.
 *
 * Ported from the retired block theme's parts/header.html plus the
 * farbest/hamburger-button and farbest/mobile-menu render callbacks
 * (tag archive/fse-final in the farbest-blocktheme repo). Replaces the
 * ShiftNav-based header of the previous theme — ShiftNav Pro can be
 * deactivated once this is verified on staging.
 *
 * Markup contract with css/header.css and js/header.js:
 *   #farbest-header          sticky shell, gains .is-sticky on scroll
 *   .farbest-header__nav     desktop nav; JS clones its innerHTML into the drawer
 *   #farbest-mobile-menu     the drawer, gains .is-open
 *   #farbest-mobile-overlay  the scrim, gains .is-visible
 *
 * @package farbest-classic
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php if ( ! has_site_icon() ) : ?>
		<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/favicon.ico' ); ?>" type="image/x-icon">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div id="page" class="site site-wrap">

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'farbest-classic' ); ?></a>

		<header class="farbest-header" id="farbest-header">
			<div class="farbest-header__inner">

				<div class="farbest-header__logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/images/logo.png' ); ?>"
							alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					</a>
				</div>

				<nav class="farbest-header__nav" id="site-navigation"
					aria-label="<?php esc_attr_e( 'Primary navigation', 'farbest-classic' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'container'      => false,
							'depth'          => 2,
							'fallback_cb'    => false,
						)
					);
					?>
				</nav>

				<button class="farbest-header__hamburger"
					aria-label="<?php esc_attr_e( 'Open menu', 'farbest-classic' ); ?>"
					aria-expanded="false"
					aria-controls="farbest-mobile-menu">
					<span class="farbest-header__hamburger-line"></span>
					<span class="farbest-header__hamburger-line"></span>
					<span class="farbest-header__hamburger-line"></span>
				</button>

			</div>
		</header>

		<div class="farbest-mobile-menu" id="farbest-mobile-menu" aria-hidden="true" role="dialog" aria-modal="true"
			aria-label="<?php esc_attr_e( 'Mobile navigation', 'farbest-classic' ); ?>">
			<button class="farbest-mobile-menu__close" aria-label="<?php esc_attr_e( 'Close menu', 'farbest-classic' ); ?>">
				<span class="farbest-mobile-menu__close-line"></span>
				<span class="farbest-mobile-menu__close-line"></span>
			</button>
			<nav class="farbest-mobile-menu__nav"
				aria-label="<?php esc_attr_e( 'Mobile primary navigation', 'farbest-classic' ); ?>"></nav>
		</div>
		<div class="farbest-mobile-overlay" id="farbest-mobile-overlay" aria-hidden="true"></div>

		<?php do_action( 'farbest_after_header' ); ?>

		<div id="content" class="site-content">
