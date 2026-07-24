<?php
/**
 * Default page template.
 *
 * @package farbest-classic
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">
		<div class="site-constrained">

			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'page' );

				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			endwhile;
			?>

		</div>
	</main><!-- #main -->

<?php get_footer(); ?>
