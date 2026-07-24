<?php
/**
 * 404 template.
 *
 * @package farbest-classic
 */

get_header(); ?>

	<main id="main" class="site-main error-404" role="main">
		<div class="site-constrained">

			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Page not found', 'farbest-classic' ); ?></h1>
			</header>

			<div class="page-content">
				<p><?php esc_html_e( 'That page does not exist. It may have moved, or the link may be out of date.', 'farbest-classic' ); ?></p>

				<p>
					<a class="fbd-cta-button" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php esc_html_e( 'Back to home', 'farbest-classic' ); ?>
					</a>
				</p>

				<?php get_search_form(); ?>
			</div>

		</div>
	</main><!-- #main -->

<?php get_footer(); ?>
