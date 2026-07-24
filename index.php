<?php
/**
 * Fallback template.
 *
 * WordPress uses this whenever nothing more specific matches. Every other
 * template in this theme delegates its loop here via get_template_part.
 *
 * @package farbest-classic
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">
		<div class="site-constrained">

			<?php if ( have_posts() ) : ?>

				<?php if ( ! is_front_page() && ( is_home() || is_archive() || is_search() ) ) : ?>
					<header class="page-header">
						<?php if ( is_search() ) : ?>
							<h1 class="page-title">
								<?php
								printf(
									/* translators: %s: search query. */
									esc_html__( 'Search results for: %s', 'farbest-classic' ),
									'<span>' . esc_html( get_search_query() ) . '</span>'
								);
								?>
							</h1>
						<?php else : ?>
							<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
							<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
						<?php endif; ?>
					</header>
				<?php endif; ?>

				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;

				the_posts_pagination( array(
					'mid_size'  => 2,
					'prev_text' => esc_html__( '&laquo; Previous', 'farbest-classic' ),
					'next_text' => esc_html__( 'Next &raquo;', 'farbest-classic' ),
				) );
				?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>

		</div>
	</main><!-- #main -->

<?php get_footer(); ?>
