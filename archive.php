<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package farbest
 */

get_header(); ?>
	<style>
	div.arch-page {max-width:870px;float:left;}
	div.formcraft-css.body-append.image_button_cover.placement-right.now-show {display:none;}
	</style>
	<div class="fb_content_left">		

	<div id="primary" class="content-area arch-page">
		<main id="main" class="site-main" role="main">
		
		<?php if (is_category('News')) {echo '<!--news-->';} else {echo '<!--not news-->';} ?>
		
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', 'archive' );
				?>

			<?php endwhile; ?>
			
			<?php 
			$string = 'some words ' . get_the_archive_title();
			//echo $string;
			$word = 'Category';
			if (strpos($string, $word)) { $tax=0;} else { $tax=1;} ?>
			
			<?php 
			if ($tax==1) { ?>
			
			<div style="padding:5px 0;border-top:1px solid #ccc;border-bottom:1px solid #ccc;margin:4% 0;">
			<div style="float:left"><?php echo "Total Products Found: " . $wp_query->found_posts; ?></div><div style="float:right"><?php the_posts_pagination(); ?></div>
			<div style="clear:both"></div>
			</div>
			
			<?php } ?>
			
			<div>
			
			<?php 
			
			if ($tax==1) {
			
			/*$string = 'some words ' . get_the_archive_title();
			$word = 'Category';
			if (strpos($string, $word)) { } else { */
			
			$args = array( 'hide_empty=0' );

			$terms = get_terms( 'claim', $args );
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				$count = count( $terms );
				$i = 0;
				$term_list = '<p class="my_term-archive"><b>LABEL CLAIMS: </b>';
				foreach ( $terms as $term ) {
					$i++;
					$term_list .= '<a href="' . get_term_link( $term ) . '" title="' . sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) . '">' . $term->name . '</a>';
					if ( $count != $i ) {
						$term_list .= ' &middot; ';
					}
					else {
						$term_list .= '</p>';
					}
				}
				echo $term_list;
			} 
			
			 
			$args = array( 'hide_empty=0' );

			$terms = get_terms( 'certification', $args );
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				$count = count( $terms );
				$i = 0;
				$term_list = '<p class="my_term-archive"><b>CERTIFICATIONS: </b>';
				foreach ( $terms as $term ) {
					$i++;
					$term_list .= '<a href="' . get_term_link( $term ) . '" title="' . sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) . '">' . $term->name . '</a>';
					if ( $count != $i ) {
						$term_list .= ' &middot; ';
					}
					else {
						$term_list .= '</p>';
					}
				}
				echo $term_list;
			}
			}
			?>
				
		</div>
		
		<?php if ($tax==1) { ?>
		
		<div style="text-align:center"><a href="<?php echo esc_url( home_url( '/' ) ); ?>/ingredients" class="hb_other"><h5><span>ALL INGREDIENTS <i class="fa fa-arrow-right"></i></span></h5></a></div>
		
		<?php } ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<div id="sampleForm" style="margin-top:134px;"><?php echo do_shortcode( '[fc id="11"][/fc]'); ?></div>
	<div style="clear:both;"></div>
	<div id="sampleFormAlt"><?php echo do_shortcode( '[fc id="11" class="samplePopUp" type="popup" placement="right" button_color="#5d9732" font_color="white"]Get in Touch![/fc]'); ?></div>
	</div><!-- fb content -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
