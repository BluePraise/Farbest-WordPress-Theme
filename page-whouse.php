<?php
/**
 * Template name: Warehousing
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package farbest
 */

get_header(); ?>

<?php

$args = array(
		'post_type' => 'warehousing',
		'posts_per_page'=>1
		);

$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post(); 
		$logo = get_post_meta($post->ID, 'warehousing_logo', true); 
		$bkgd_img = get_post_meta($post->ID, 'warehousing_bkgd_img', true);
		$headline = get_post_meta($post->ID, 'warehousing_headline', true);  
		$fwr_headline = get_post_meta($post->ID, 'warehousing_fwr_headline', true);  
		$fwr_content = get_post_meta($post->ID, 'warehousing_fwr_content', true);  
		$swr_headline = get_post_meta($post->ID, 'warehousing_swr_headline', true);  
		$swr_content = get_post_meta($post->ID, 'warehousing_swr_content', true);  
		$lb_headline = get_post_meta($post->ID, 'warehousing_lb_headline', true);  
		$lb_content = get_post_meta($post->ID, 'warehousing_lb_content', true);  
		$cb_headline = get_post_meta($post->ID, 'warehousing_cb_headline', true);  
		$cb_content = get_post_meta($post->ID, 'warehousing_cb_content', true);  
		$rb_headline = get_post_meta($post->ID, 'warehousing_rb_headline', true);  
		$rb_content = get_post_meta($post->ID, 'warehousing_rb_content', true);  
		$cta_headline = get_post_meta($post->ID, 'warehousing_cta_headline', true);     
		$cta_content = get_post_meta($post->ID, 'warehousing_cta_content', true);     
		$cta_button = get_post_meta($post->ID, 'warehousing_cta_button', true);     
		$cta_button_link = get_post_meta($post->ID, 'warehousing_cta_button_link', true);
?>

<?php endwhile; ?>
<div id="custom-image"   class="custImgWh" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/<?php echo $bkgd_img; ?>');"><!--<img style="padding-top:60px" src="<?php //echo get_template_directory_uri(); ?>/images/<?php echo $logo; ?>">--><h2 class="wh" style="display:block; margin: 0 auto; padding: 8% 0; width:70%; max-width: 1200px;"><?php echo $headline; ?></h2></div>
<div id="row-wrapper">
<div class="fb_content">

<div><h1 class="wh"><?php echo $fwr_headline; ?></h1><p style="text-align:justify;"><?php echo $fwr_content; ?></p></div>
</div><!--ingredients-->
</div><!--row-wrapper-->

<div id="row-wrapper">
<div class="fb_content">
<div><h2 class="wh"><?php echo $swr_headline; ?></h2></div>
<div class="intro-centered"><?php echo $swr_content; ?></div>
</div>
</div><!--row-wrapper-->
<div id="row-wrapper">
<div class="clearfix fb_content">
<div class="threeWide"><h4 class="wh" style="position:relative"><img style="top:-22px;left:-35px;position:absolute" src="<?php echo get_template_directory_uri(); ?>/images/map-pin-fb-hover-01.png" width="35" /><?php echo $lb_headline; ?></h4><?php echo $lb_content; ?></div>

<div class="threeWide">
  <h4 class="wh" style="position:relative"><img style="top:-22px;left:-35px;position:absolute" src="<?php echo get_template_directory_uri(); ?>/images/map-pin-fb-hover-01.png" width="35" /><?php echo $cb_headline; ?></h4><?php echo $cb_content; ?></div>

<div class="threeWide"><h4 class="wh" style="position:relative"><img style="top:-22px;left:-35px;position:absolute" src="<?php echo get_template_directory_uri(); ?>/images/map-pin-fb-hover-01.png" width="35" /><?php echo $rb_headline; ?></h4><?php echo $rb_content; ?></div>
</div>
</div><!--row-wrapper-->
<div id="cta1">
<div class="fb_content clearfix">
<div class="cta-left-title">
<div><h3 class="wh"><?php echo $cta_headline; ?></h3><?php echo $cta_content; ?></div>
</div>
<div class="cta-right-button">
<div style="white-space:nowrap;"><?php echo do_shortcode('[fc id="5" type="popup" class="homebutton"]ASK FOR A QUOTE   <i class="fa fa-chevron-right"></i>[/fc]'); ?></div>
</div>
</div>
</div><!--cta1-->
<div class="clearfix">&nbsp;</div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
