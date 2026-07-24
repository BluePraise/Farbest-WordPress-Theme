<?php
/**
 * The template for displaying the footer.
 *
 * Closes #content, then renders the wave divider and the site footer.
 *
 * Ported from the retired block theme's parts/footer.html and
 * parts/footer-wave.html (tag archive/fse-final in the farbest-blocktheme
 * repo). The three columns stay as widget areas so the client can edit them
 * (registered in inc/widgets.php); when a widget area is empty the ported
 * static markup renders instead, so the footer is never blank.
 *
 * css/global.css hangs the hills SVG off `footer.site-footer` on category,
 * ingredient-archive and Hills-template pages — keep both classes here.
 *
 * The previous theme's footer carried ~180 lines of inline jQuery keyed to
 * hardcoded page IDs. All of it called into jquery-ui accordion,
 * viewportChecker or doubleTapToGo — libraries that had already been deleted —
 * so none of it is reproduced here.
 *
 * @package farbest-classic
 */
?>
		</div><!-- #content -->

		<div class="farbest-footer-wave" aria-hidden="true">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 58" preserveAspectRatio="none">
				<path d="M1200,18c-175.177,7.236-316.697,8.325-411,8.076-188.321-.498-283.094-6.583-487-5.28C171.253,21.631,65.6,25.056,0,27.629v31.371h1200V18Z" style="fill:#1f2f36" />
			</svg>
		</div>

		<footer class="site-footer farbest-footer">

			<div class="farbest-footer__columns alignwide">

				<div class="farbest-footer__col farbest-footer__col--brand">
					<?php if ( is_active_sidebar( 'footer_left' ) ) : ?>
						<?php dynamic_sidebar( 'footer_left' ); ?>
					<?php else : ?>
						<a class="farbest-footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/images/logo.png' ); ?>"
								alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
						</a>
						<p class="farbest-footer__tagline">
							<?php esc_html_e( 'Quality ingredients. Trusted expertise.', 'farbest-classic' ); ?>
						</p>
					<?php endif; ?>
				</div>

				<div class="farbest-footer__col">
					<?php if ( is_active_sidebar( 'footer_center' ) ) : ?>
						<?php dynamic_sidebar( 'footer_center' ); ?>
					<?php else : ?>
						<h6 class="farbest-footer__col-heading"><?php esc_html_e( 'Navigate', 'farbest-classic' ); ?></h6>
						<nav class="farbest-footer__nav"
							aria-label="<?php esc_attr_e( 'Footer navigation', 'farbest-classic' ); ?>">
							<?php
							// Use the dedicated footer menu when one is assigned;
							// otherwise mirror the primary menu.
							wp_nav_menu(
								array(
									'theme_location' => has_nav_menu( 'footer' ) ? 'footer' : 'primary',
									'menu_id'        => 'footer-menu',
									'container'      => false,
									'depth'          => 1,
									'fallback_cb'    => false,
								)
							);
							?>
						</nav>
					<?php endif; ?>
				</div>

				<div class="farbest-footer__col">
					<?php if ( is_active_sidebar( 'footer_right' ) ) : ?>
						<?php dynamic_sidebar( 'footer_right' ); ?>
					<?php else : ?>
						<h6 class="farbest-footer__col-heading"><?php esc_html_e( 'Contact', 'farbest-classic' ); ?></h6>
						<p class="farbest-footer__contact-line">
							<a href="mailto:info@farbest.com">info@farbest.com</a>
						</p>
						<p class="farbest-footer__contact-line">
							<a href="tel:+18003272378">1-800-FARBEST</a>
						</p>
					<?php endif; ?>
				</div>

			</div>

			<hr class="farbest-footer__divider">

			<div class="farbest-footer__bottom alignwide">
				<p class="farbest-footer__copyright">
					<?php
					printf(
						/* translators: %s: current year. */
						esc_html__( '© %s Farbest Brands. All rights reserved.', 'farbest-classic' ),
						esc_html( gmdate( 'Y' ) )
					);
					?>
				</p>
			</div>

		</footer>

	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>

</html>
