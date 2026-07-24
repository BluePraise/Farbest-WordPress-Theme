<?php
/**
 * Single post template.
 *
 * Note: single fpc_ingredient pages are NOT rendered here. The Farbest Product
 * Catalog plugin intercepts template_include and serves its own
 * templates/single-ingredient.php.
 *
 * @package farbest-classic
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">
		<div class="site-constrained">

			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'single' );

				the_post_navigation( array(
					'prev_text' => '&laquo; %title',
					'next_text' => '%title &raquo;',
				) );

				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			endwhile;
			?>

		</div>
	</main><!-- #main -->

<?php get_footer(); ?>
