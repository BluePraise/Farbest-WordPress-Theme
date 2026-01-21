<?php
/**
 * Template name: Partners
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package farbest
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<!-- desktop -->
<div id="custom-image"  class="custImgPart" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bkgd_partners.jpg');"><img style="padding-top:60px" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Farbest Partners"><h2 class="part" style="display:block; width:70%; margin: 0 auto; padding: 20px 0 40px;"><?php the_content(); ?></h2></div>

<!-- mobile 
<div id="custom-image" class="custImgMobile" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bkgd_partners.jpg');"><img style="padding-top:60px" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Farbest Partners"><h2 class="part" style="display:block; width:70%; margin: 0 auto; padding: 20px 0 40px;"><?php the_content(); ?></h2></div>-->

<div style="text-align:center"><h1><?php the_title(); ?></h1></div>
<?php endwhile; // end of the loop. ?>

<div class="fb_content">			
			


<?php
$i=1;
$args = array(
		'post_type' => 'partners',
		'posts_per_page' => -1,
		'meta_key' => 'partners_order',
		'orderby' => 'meta_value_num',
		'order' => 'ASC'
		);

$loop = new WP_Query( $args );
		
		while ( $loop->have_posts() ) : $loop->the_post(); 
		$logo = get_post_meta($post->ID, 'partners_logo', true); 
		$company = get_post_meta($post->ID, 'partners_company', true); 
		$desc = get_post_meta($post->ID, 'partners_desc', true); 
		$website = get_post_meta($post->ID, 'partners_website', true);
?>

<div class="threeWide">
	<div class="partner-logo">
	<?php if(!empty($website)) { ?><a href="<?php echo $website; ?>"><?php } ?><img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/<?php echo $logo; ?>" alt="logo"><?php if(!empty($website)) { ?></a><?php } ?>
	</div>
	<div class="partner-title">
	<h4 class="partner-title"><?php echo $company; ?></h4>
	</div>
	<div class="clip">
	<?php echo $desc; ?>
	</div>
	<div class="fadeout"></div>
	<div class="openup"><i class="fa fa-chevron-down"></i></div>
</div>

<?php
if ($i % 3 == 0) {echo '<div style="clear:both"></div>';}
$i++;
?>

<?php endwhile; ?>
</div>

<div style="clear:both"></div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
