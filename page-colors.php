<?php
/**
 * Template name: Natural Color
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
	<div id="ingredientMenu"><?php dynamic_sidebar( 'ingredient_menu_1' ); ?></div>
	<div id="sampleForm">
	<div><?php $id = 1459; $p = get_page($id); echo '<strong>' . apply_filters('the_title', $p->post_title) . '</strong>'; echo '<br />'; echo apply_filters('the_content', $p->post_content); ?></div>
	<div style="margin-top:40px;"><?php $id = 1461; $p = get_page($id); echo '<strong>' . apply_filters('the_title', $p->post_title) . '</strong>'; echo '<br />'; echo apply_filters('the_content', $p->post_content); ?></div>
	</div>
	<div id="primary" class="content-area fb_content_ingred fb_left">
	<div id="breadCrumb"><?php breadcrumb_simple(); ?></div>
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'color' ); ?>

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
	<div id="sampleFormAlt">
	<div><?php $id = 1459; $p = get_page($id); echo '<strong>' . apply_filters('the_title', $p->post_title) . '</strong>'; echo '<br />'; echo apply_filters('the_content', $p->post_content); ?></div>
	<div style="margin-top:40px;"><?php $id = 1461; $p = get_page($id); echo '<strong>' . apply_filters('the_title', $p->post_title) . '</strong>'; echo '<br />'; echo apply_filters('the_content', $p->post_content); ?></div>
	</div>
	</div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>