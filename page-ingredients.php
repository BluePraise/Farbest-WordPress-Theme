<?php
/**
 * Template name: Ingredients
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package farbest
 */

get_header(); ?>

<style>
div.formcraft-css.body-append.image_button_cover.placement-right.now-show {display:none;}
</style>

	<div class="fb_content fb_left ieheightfix">
	<div id="ingredientMenu"><?php bellows( 'main' , array( 'menu' => 5 ) ); ?></div>
	<div id="sampleForm"><?php echo do_shortcode( '[fc id="4"][/fc]'); ?></div>
		<div id="sampleFormAlt"><?php echo do_shortcode( '[fc id="4" class="samplePopUp" type="popup" placement="right" button_color="#5d9732" font_color="white"]Get a Sample![/fc]'); ?></div>
	<div id="primary" class="content-area fb_content_ingred fb_left">
	<div id="breadCrumb"><?php breadcrumb_simple(); ?></div>
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'ingredients' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<div style="clear:both"></div>
	
	</div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>