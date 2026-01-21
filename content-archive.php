<?php
/**
 * @package farbest
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">
	
		<?php
		$pages2cats = array(
			'129' => 'ascorbic_acid',
			'121' => 'beta_carotene',
			'150' => 'calcium_ascorbate',
			'107' => 'calcium_caseinate',
			'176' => 'calcium_d_pantothenate',
			'93' => 'caseinonly',
			'95' => 'colostrum',
			'186' => 'crystalline_fructose',
			'164' => 'd_biotin',
			'312' => 'fibers',
			'306' => 'food_ingredients',
			'299' => 'fruits_&_fruit_powders',
			'188' => 'gum_acaciaonly',
			'342' => 'gum_acacia_organic',
			'97' => 'hydrolysates',
			'309' => 'juice_&_concentrates',
			'99' => 'lactoferrin',
			'101' => 'lactoperoxidase',
			'125' => 'lutein',
			'123' => 'lycopene',
			'103' => 'milk_protein',
			'321' => 'monk_fruit',
			'172' => 'niacinonly',
			'174' => 'niacinamide',
			'182' => 'nutrient_premixes_&_blends',
			'115' => 'pea_protein',
			'302' => 'plant_proteins',
			'190' => 'polydextrose',
			'178' => 'pyridoxine',
			'170' => 'riboflavin',
			'152' => 'sodium_ascorbate',
			'11' => 'sodium_caseinate',
			'113' => 'soy_protein',
			'109' => 'specialty',
			'315' => 'supplements',
			'335' => 'sweeteners',
			'168' => 'thiamine',
			'154' => 'vitamin_a',
			'156' => 'vitamin_d',
			'158' => 'vitamin_e',
			'160' => 'vitamin_k',
			'105' => 'whey_protein',
			'1790' => 'rice_protein'
		);
		
		$category = get_post_meta($post->ID, 'products_categories', true);
		if(isset($category[0])) {
		$key = array_search($category[0], $pages2cats);
		$title = get_permalink($key);
		} else {$title = get_permalink();}
		?>
		
		<?php the_title( sprintf( '<div style="border-bottom: 1px solid #5d9731;"<h3 class="post-title"><a style="text-transform:uppercase;color:#004964;" href="'.$title.'" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3></div>' ); ?>

	</header><!-- .entry-header -->

	<!--<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_excerpt( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'farbest' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'farbest' ),
				'after'  => '</div>',
			) );
		?>
	</div>--><!-- .entry-content -->
	
	<!--<footer class="entry-footer">
		<?php farbest_entry_footer(); ?>
	</footer>--><!-- .entry-footer -->
</article><!-- #post-## -->