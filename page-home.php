<?php
/**
 * Template name: Homepage
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
		'post_type' => 'homepage',
		'posts_per_page'=>1
		);

$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post(); 
		$logo = get_post_meta($post->ID, 'homepage_logo', true); 
		$bkgd_img = get_post_meta($post->ID, 'homepage_bkgd_img', true);
		$headline = get_post_meta($post->ID, 'homepage_headline', true);  
		$fbb_headline = get_post_meta($post->ID, 'homepage_fbb_headline', true);  
		$fbb_content = get_post_meta($post->ID, 'homepage_fbb_content', true);  
		$fbb_button = get_post_meta($post->ID, 'homepage_fbb_button', true);  
		$fbb_button_link = get_post_meta($post->ID, 'homepage_fbb_button_link', true);  
		$fcta_headline = get_post_meta($post->ID, 'homepage_fcta_headline', true);  
		$fcta_content = get_post_meta($post->ID, 'homepage_fcta_content', true);  
		$fcta_footnote = get_post_meta($post->ID, 'homepage_fcta_footnote', true);  
		$fcta_button = get_post_meta($post->ID, 'homepage_fcta_button', true);  
		$fcta_button_link = get_post_meta($post->ID, 'homepage_fcta_button_link', true);  
		$sbb_headline = get_post_meta($post->ID, 'homepage_sbb_headline', true);  
		$sbb_content = get_post_meta($post->ID, 'homepage_sbb_content', true);  
		$sbbl_button = get_post_meta($post->ID, 'homepage_sbbl_button', true);   
		$sbbl_content = get_post_meta($post->ID, 'homepage_sbbl_content', true);    
		$sbbc_button = get_post_meta($post->ID, 'homepage_sbbc_button', true);    
		$sbbc_content = get_post_meta($post->ID, 'homepage_sbbc_content', true);    
		$sbbr_button = get_post_meta($post->ID, 'homepage_sbbr_button', true);    
		$sbbr_content = get_post_meta($post->ID, 'homepage_sbbr_content', true);    
		$scta_headline = get_post_meta($post->ID, 'homepage_scta_headline', true);     
		$scta_content = get_post_meta($post->ID, 'homepage_scta_content', true);     
		$scta_button = get_post_meta($post->ID, 'homepage_scta_button', true);     
		$scta_button_link = get_post_meta($post->ID, 'homepage_scta_button_link', true);     
		$partners_headline = get_post_meta($post->ID, 'homepage_partners_headline', true);     
		$partners_content = get_post_meta($post->ID, 'homepage_partners_content', true); 
?>

<?php endwhile; ?>
<div id="hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/<?php echo $bkgd_img; ?>');"><img class="home" src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $logo; ?>"><h1 class="home"><?php echo $headline; ?></h1></div>
<div id="ingredients">
<div class="fb_content">
<div><h2 class="home"><?php echo $fbb_headline; ?></h2></div>
	<div><h6 class="home"><?php echo $fbb_content; ?></h6></div>
<div><a href="<?php echo $fbb_button_link; ?>" class="hb_other"><h5><span><?php echo $fbb_button; ?> <i class="fa fa-chevron-right"></i></span></h5></a></div>
</div>
</div>
<?php /*
<div id="cta1">
<div class="fb_content clearfix">
<div class="left60">
<div><h3 class="home"><?php echo $fcta_headline; ?></h3></div>
<div><h6 class="home"><?php echo $fcta_content; ?></h6></div>
<div class="note"><?php echo $fcta_footnote; ?></div>
</div>
<div class="left40">
<div style="white-space:nowrap;"><a href="<?php echo $fcta_button_link; ?>" class="hb_other"><span class="button"><?php echo $fcta_button; ?> <i class="fa fa-chevron-right"></i></span></a></div>
</div>
</div>
</div>
*/ ?>
<?php /* New Promo Block */ ?>
<div id="cta1" class="container">
	<div class="promo_content-1 clearfix">
<div class="column left-column">
	<img style="display:block;padding:0;" src="https://farbest.com/wp-content/uploads/NEW-FarPro.png" alt="FarPro logo" width="350" height="auto" />  
<p style="font-size:30px;">Featuring</p>
	<h3 class="home" style="color:#638D3D;font-weight:600;">Pea Protein <br class="mobile-break"><span style="font-weight:300;color: 003e51 ;"> 80%</span></h3>
	<p class="promo-subtext" style="font-size:30px;margin-top:0;">Conventional &amp; Organic</p>

<p style="font-size:20px;">Clean taste. Superior solubility. Optimal viscosity.</p>
	
<div style="white-space:nowrap;margin: 40px 0;"><?php echo do_shortcode('[fc id="4" type="popup" class="homebutton"]Request product details   <i class="fa fa-chevron-right"></i>[/fc]'); ?></div>
</div>
<div class="column right-column">
<img style="display:block;padding-top:30px;" src="https://farbest.com/wp-content/uploads/FarPro-Application-images.png" alt="four novel ingredient images" width="450" height="auto" />
</div>
</div>
</div>

<div id="offerings">
<div class="fb_content">
<div><h2 class="home"><?php echo $sbb_headline; ?></h2></div>
	<div class="tnh"><h6 class="home"><?php echo $sbb_content; ?></h6></div>
<div class="clearfix">
<div class="threeWide"><h4><span><?php echo $sbbl_button; ?></span></h4><?php echo $sbbl_content; ?></div>
<div class="threeWide"><h4><span><?php echo $sbbc_button; ?></span></h4><?php echo $sbbc_content; ?></div>
<div class="threeWide"><h4><span><?php echo $sbbr_button; ?></span></h4><?php echo $sbbr_content; ?></div>
</div>
</div>
</div>
<?php /*
<div id="cta2">
<div class="fb_content clearfix">
<div class="left65">
<div><h3 class="home"><?php echo $scta_headline; ?></h3></div>
<div><h6 class="home"><?php echo $scta_content; ?></h6></div>
</div>
<div class="left35">
<div style="white-space:nowrap;"><a href="<?php echo $scta_button_link; ?>" class="hb_other"><span class="button"><?php echo $scta_button; ?> <i class="fa fa-chevron-right"></i></span></a></div>
</div>
</div>
</div>
*/ ?>
<?php /* New Promo Block */ ?>
<div id="cta2" class="container">
	<div class="promo_content-1 clearfix">
<div class="column left-column">
<h3 class="home">Novel ingredients. <span class="break" style="white-space:nowrap;">Innovative formulations.</span></h3>
<p>Consumers are open to novel ingredients—especially plant-based proteins—and we have plenty to choose from.</p>
<p>Have an innovative food or beverage you are sourcing for? <b>Give our experts a call</b></p>
	
<div style="white-space:nowrap;margin: 40px 0;"><?php echo do_shortcode('[fc id="5" type="popup" class="homebutton"]ASK FOR A QUOTE   <i class="fa fa-chevron-right"></i>[/fc]'); ?></div>
</div>
<div class="column right-column">
<img style="display:block;" src="https://farbest.com/wp-content/uploads/Novel-Ingredients.png" alt="four novel ingredient images" width="400" height="auto" />
</div>
</div>
</div>


<div id="partners">
<div class="fb_content" style="max-width:1000px">
<div><h2><?php echo $partners_headline; ?></h2></div>
	<div><h6 class="home"><?php echo $partners_content; ?></h6></div>
<p></p>
<?php echo do_shortcode('[carousel-horizontal-posts-content-slider id=3499]');?>

</div>
</div>	

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
