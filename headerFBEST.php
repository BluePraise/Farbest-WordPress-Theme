<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package farbest
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600.700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<!-- can remove was from KG menu
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/icons.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/component.css" />
--><?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.css">
<script src="<?php echo get_template_directory_uri(); ?>/js/viewportchecker.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.custom.js"></script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<header <?php if (is_front_page()) { echo 'id="fb_home"';} else {echo 'id="fb_inner"';} ?>>
	<?php if (!is_front_page()) { ?> <a href="#mmenu">Open the menu</a> <?php } ?>
	
	<div class="fb_content"><div style="float:left"><img class="logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png"></div><div style="float:right;margin-top:60px;"><ul><li>HOME</li><li>INGREDIENTS</li><li>WAREHOUSING</li><li>PARTNERS</li><li>NEWS</li><li>ABOUT</li><li>CONTACT</li></ul></div></div></header>
	
	<?php if (is_front_page()) { ?>
		<div id="hero"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png"><h1><span>Premier distributor of</span><br /><span>food & nutrition ingredients</span><br /><span>sourced from the world’s most</span><br /><span>trusted suppliers.</span></h1></div>
		<div id="ingredients">
		<div class="fb_content">
		<div><h2>COMMITTED TO QUALITY</h2></div>
		<div>We’re your source for specialized and non-GMO ingredients including dairy and 
		plant proteins, vitamins, gums and organics. When it comes from Farbest, you know it’s the best</div>
		<div><h5><span>OUR INGREDIENTS <i class="fa fa-arrow-right"></i></span></h5></div>
		</div>
		</div>
		
		<div id="cta1">
		<div class="fb_content clearfix">
		<div class="left60">
		<div><h3>TRY FOR YOURSELF</h3></div>
		<div><h6>We would be happy to send you a quote or a sample along with Product information and specification sheet.</h6></div>
		<div class="note">(Our samples are not available to the general public at this time.)</div>
		</div>
		<div class="left40">
		<div><span class="button">SEND ME A SAMPLE <i class="fa fa-chevron-right"></i></span></div>
		</div>
		</div>
		</div>
		
		<div id="offerings">
		<div class="fb_content">
		<div><h2>TRUTH & HONESTY</h2></div>
		<div class="tnh">It’s just how we do business. We enjoy longstanding relationships with our customers because 
		our business is built on integrity and representing the most ethical suppliers in the industry.</div>
		
		<div class="clearfix">
		<div class="threeWide"><h4><span>SERVICE</span></h4> Our deep commitment to providing outstanding customer service means when you call us, you’ll speak with a real person and get the personalized service you deserve. <strong>Call us at 800-897-6096.</strong></div>
		
		<div class="threeWide"><h4><span>TRENDS</span></h4> Gain a competitive advantage with our extensive market knowledge and six decades of industry experience. We spot the trend beforeit's a trend and can help you decide what to source, when to buy, and more. <strong>Contact us to learn more.</strong></div>
		
		<div class="threeWide"><h4><span>WAREHOUSING</span></h4> Farbest is dedicated to providing our customers with the highest quality ingredients when and where you need it. Our AIB-certified warehousing centers are strategically located to quickly and reliably serve our customers throughout North America. <strong>Learn more ></strong></div>
		</div>
		
		
		</div>
		</div>
		
		<div id="cta2">
		<div class="fb_content clearfix">
		<div class="left65">
		<div><h3>We can keep your labels clean</h3></div>
		<div><h6>Looking for ingredients that are Non-gmo, rBST-free, allergen-free, kosher, vegan, halal?</h6></div>
		</div>
		<div class="left35">
		<div><span class="button">find out more <i class="fa fa-chevron-right"></i></span></div>
		</div>
		</div>
		</div>
		
		<div id="partners">
		<div class="fb_content" style="max-width:1000px">
		<div><h2>Partners</h2></div>
		<div>We travel the world in search of the highest quality ingredients.</div>
		<p></p>
		<?php echo do_shortcode('[carousel-horizontal-posts-content-slider]'); ?>
		
		</div>
		</div>
		
<?php	} else { ?>
	
<div id="content" class="site-content">

<?php	} ?>
	

