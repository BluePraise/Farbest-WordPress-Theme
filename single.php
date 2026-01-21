<?php
/**
 * The template for displaying all single posts.
 *
 * @package farbest
 */

get_header(); ?>

	<div class="fb_content_left">		

	<div id="primary" class="content-area" style="float:left;width:65%;margin-right:10%;">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<div style="float:left;"><?php previous_post_link('%link', 'Previous', TRUE); ?></div>
			<div style="float:right;"><?php next_post_link('%link', 'Next', TRUE); ?></div>
			<div style="clear:both;"></div>
	
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<div style="float:right;width:300px;margin-top: 40px;"><?php get_sidebar(); ?></div>
	<div style="clear:both;"></div>
	</div><!-- fb content -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>