<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package farbest
 */

get_header(); ?>

	<div class="fb_content_left">	

	<div id="primary" class="content-area news">
		<main id="main" class="site-main" role="main">

		<?php 
		$args = array (
			'posts_per_page' => '4',
			'category_name' => 'news',
			'paged'=>$paged
		);
		$the_query = new WP_Query($args); ?>

		<?php if ( $the_query->have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>
				
				

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
		
		<?php wp_reset_postdata(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<div id="newsSidebar"><?php get_sidebar(); ?></div>
	<div style="clear:both;"></div>
	</div><!-- fb content -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
