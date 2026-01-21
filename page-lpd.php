<?php
/**
 * Template name: Landing Page D/L
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package farbest
 */

get_header(); ?>
<?php if (!is_front_page()) { ?>
	<div id="primary" class="content-area fb_content">
	<!--<div id="breadCrumb"><?php if(function_exists('simple_breadcrumb')) {simple_breadcrumb();} ?></div>-->
	<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'lpd' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php } ?>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
