<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package farbest
 */
 
get_header(); ?>

	<div class="fb_content">		
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title huge">OOPS!</h1>
				</header><!-- .page-header -->

				<div class="page-content">
					
					<div style="text-align:center">
					THAT PAGE CAN'T BE FOUND.<br> 
					IT EITHER NO LONGER EXISTS OR HAS BEEN MOVED.<br> <br> 
					LET'S START OVER AGAIN <br> <br> 
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><h5><span>HOME PAGE <i class="fa fa-arrow-right"></i></span></h5></a>
					</div>
					
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
	</div><!-- fb content -->

<?php get_footer(); ?>
