<?php

/**
 * Team archive — /team/.
 *
 * Renders the same grid as the [farbest_team] shortcode, so both surfaces stay
 * identical. Members have no single template; see inc/team.php.
 *
 * @package farbest-classic
 */

get_header(); ?>

<main id="main" class="site-main farbest-team-archive" role="main">

	<div class="site-constrained">
		<header class="page-header">
			<?php
			// post_type_archive_title() rather than the_archive_title(): core
			// prefixes the latter with "Archives:", which reads badly as a page
			// heading. The text is the post type's label — change it there.
			//
			// the_archive_description() is deliberately not called either: for a
			// post type archive it echoes the type's `description`, which is an
			// internal note for the admin, not front-end copy.
			?>
			<h1 class="page-title entry-title--centered"><?php post_type_archive_title(); ?></h1>
		</header>


		<?php
		// The renderer runs its own query so ordering matches the shortcode.
		echo farbest_render_team_grid();
		?>
	</div>
</main><!-- #main -->

<?php get_footer(); ?>