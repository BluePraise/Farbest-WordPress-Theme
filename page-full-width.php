<?php
/**
 * Template Name: Full Width
 *
 * Renders page content with NO `.site-constrained` wrapper, so Kadence (and
 * core) full-width block sections can span the viewport edge to edge. Blocks
 * control their own inner width — build these pages with Kadence Row Layout
 * sections (or use `.alignwide` / `.alignfull`) rather than bare paragraphs.
 *
 * This does not make the theme a block theme; it is an ordinary classic-theme
 * page template.
 *
 * @package farbest-classic
 */

get_header(); ?>

	<main id="main" class="site-main site-main--full-width" role="main">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		?>
	</main><!-- #main -->

<?php get_footer(); ?>
