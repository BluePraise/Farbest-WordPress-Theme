<?php
/**
 * Template name: Team
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package farbest
 */

get_header(); ?>

<div class="fb_content">

<?php while ( have_posts() ) : the_post(); ?>
<h1><?php the_title(); ?></h1>
<div class="intro-centered"><?php the_content(); ?></div>
<?php endwhile; // end of the loop. ?>
			
			


<?php
$i=1;
$args = array(
		'post_type' => 'staff',
		'posts_per_page' => -1,
		'meta_key' => 'staff_order',
		'orderby' => 'meta_value_num',
		'order' => 'ASC'
		);

$loop = new WP_Query( $args );
		
		while ( $loop->have_posts() ) : $loop->the_post(); 
		$image = get_post_meta($post->ID, 'staff_image', true); 
		$phone = get_post_meta($post->ID, 'staff_phone', true); 
		$email = get_post_meta($post->ID, 'staff_email', true); 
		$linkedin = get_post_meta($post->ID, 'staff_linkedin', true); 
		$fullname = get_post_meta($post->ID, 'staff_fullname', true); 
		$title = get_post_meta($post->ID, 'staff_title', true); 
		$quote = get_post_meta($post->ID, 'staff_quote', true); 
		$bio = get_post_meta($post->ID, 'staff_bio', true); 

?>

<div class="profile twoWide">
	<div class="circle">
		<img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $image; ?>" alt="portrait" width="50%">
	</div>
	<div class="profile-contact">
		<?php if(!empty($phone)) { ?><a href="tel:<?php echo $phone; ?>" data-title="<?php echo $phone; ?>"><i class="fas fa-phone" ></i></a><?php } ?> 
		<?php if(!empty($email)) { ?><a href="mailto:<?php echo $email; ?>"><i class="fas fa-envelope"></i></a><?php } ?> 
		<?php if(!empty($linkedin)) { ?><a href="https://www.linkedin.com/profile/view?id=<?php echo $linkedin; ?>"><i class="fab fa-linkedin"></i></a><?php } ?> 
	</div>
	<div class="profile-content">
		<h3>
			<?php echo $fullname; ?>
		</h3>
		<p class="job-title">
			<?php echo $title; ?>
		</p>
		<blockquote class="profile">
			<?php if(!empty($quote)) {echo '"' . $quote . '"';} ?>
		</blockquote>
		<div class="team_acc" style="margin-bottom:60px;">
		<h3 style="text-align:center;margin-top:20px;"><span class="acc_icon_team" style="display:block;"></span></h3>
		<div style="overflow:hidden">
			<?php echo $bio; ?>
		</div>
		</div>
	</div>
</div>

<?php
if ($i % 2 == 0) {echo '<div style="clear:both"></div>';}
$i++;
?>

<?php endwhile; ?>
</div>

<div style="clear:both"></div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
