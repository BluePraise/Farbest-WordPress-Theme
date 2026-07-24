<?php
/**
 * Template name: Hills & Valley
 *
 * Page title plus editable content, sitting above the hills SVG that rises
 * from the footer. Ported from the retired block theme's
 * templates/page-hills.html.
 *
 * The hills artwork itself is attached in css/global.css via
 * `body.page-template-page-hills footer.site-footer::before` — WordPress adds
 * that body class automatically when this template is assigned to a page. The
 * .farbest-hills-page padding reserves room so content clears the artwork.
 *
 * @package farbest-classic
 */

get_header(); ?>

	<main id="main" class="site-main farbest-hills-page" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="site-constrained">
				<?php the_title( '<h1 class="entry-title entry-title--centered">', '</h1>' ); ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>

		<?php endwhile; ?>

	</main><!-- #main -->

<?php get_footer(); ?>
