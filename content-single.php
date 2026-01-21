<?php
/**
 * @package farbest
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div style="width:100%;margin-top:40px;"><?php if ( has_post_thumbnail() ) {the_post_thumbnail(); } ?></div>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta" style="font-size:0.75em;color:#999;">
			<div style="float:left;"><?php the_time( 'F Y' ); ?></div>
			<div style="float:left;margin-left:20px"><?php farbest_entry_footer(); ?></div>
			<div style="clear:both"></div>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	
</article><!-- #post-## -->
