<?php
/**
 * Template name: Card Grid
 *
 * Page title, the page's own content, then the ACF-driven card grid.
 * Ported from the retired block theme's templates/page-card-grid.html.
 *
 * Cards are edited in the "Cards" meta box below the editor — the field group
 * is registered in inc/card-grid.php and scoped to this template.
 *
 * @package farbest-classic
 */

get_header(); ?>

	<main id="main" class="site-main farbest-card-grid-page" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="site-constrained">
				<?php the_title( '<h1 class="entry-title entry-title--centered">', '</h1>' ); ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>

			<?php echo farbest_render_card_grid( get_the_ID() ); ?>

		<?php endwhile; ?>

	</main><!-- #main -->

<?php get_footer(); ?>
