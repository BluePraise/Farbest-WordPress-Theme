<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package farbest
 */
?>
		<h1><?php the_title(); ?></h1>
		<div class=""><?php the_content(); ?></div>
		
		<div class="ingred_acc" style="display:none">
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
			'335' => 'sweeteners_organic',
			'168' => 'thiamine',
			'154' => 'vitamin_a',
			'156' => 'vitamin_d',
			'158' => 'vitamin_e',
			'160' => 'vitamin_k',
			'105' => 'whey_protein',
			'1790' => 'rice_protein',
			'2160' => 'cyanocobalamin',
			'2163' => 'folic_acid',
			'2166' => 'methylcobalamin',
			'2184' =>  'weighting_agents',
			'3427' =>  'pea_protein_ngpv',
			'3430' =>  'soy_protein_ngpv',
			'3438' =>  'gum_acacia_ngpv',
			'3435' =>  'fiber_ngpv',
			'3441' =>  'sweeteners_ngpv',
			'3450' =>  'lecithins_ngpv',
			'3481' =>  'dairy_protein_ngpv',
			'4343' => 'omega_3_fish_oil',
			'4576' => 'lecithin'
);

		$page = get_the_ID();
		
		if (array_key_exists($page, $pages2cats)) {

		$cat = $pages2cats[$page];
	
		
		$args = array(
		'post_type' => 'products', 
		'meta_key' => 'products_order',
		'orderby' => 'meta_value_num',
		'order' => 'ASC',
		'posts_per_page'=>-1,
		'meta_query' => array(
			array(
					'key'     => 'products_categories',
					'value'   => $cat,
					'compare' => 'LIKE'
				)
			)
		);
		
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post(); 
		
		$prod_desc = get_post_meta($post->ID, 'products_description', true);
		$prod_apps = get_post_meta($post->ID, 'products_applications', true);
		$prod_pack = get_post_meta($post->ID, 'products_packaging', true);
		?>
		
		<h3 class="post-title dkblue"><?php the_title(); ?><span id="acc_icon" style="display:block;float:right;position:relative"><!--<i class="fa fa-angle-down"></i>--></span></h3>
		<div>
		<p><?php echo $prod_desc; ?></p>
		<?php if(!empty ($prod_apps)) { echo '<p><strong>PROVEN APPLICATIONS:</strong><br>' . $prod_apps . '</p>'; } ?>
		<p><strong>LABEL CLAIMS:</strong><br><?php echo get_the_term_list( $post->ID, 'claim', '', ' | ' ); ?></p>
		<p><strong>CERTIFICATIONS:</strong><br><?php echo get_the_term_list( $post->ID, 'certification', '', ' | ' ); ?></p>
		<?php if(!empty ($prod_pack)) { echo '<p><strong>PACKAGING:</strong><br>' . $prod_pack . '</p>'; } ?>
		</div>
		<?php endwhile; ?>
		<?php } ?>
		</div><!-- close #accordion -->
