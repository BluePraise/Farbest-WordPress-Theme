<?php
/**
 * @package farbest
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div style="width:100%;margin-top:80px;"><?php if ( has_post_thumbnail() ) {the_post_thumbnail(); } ?></div>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta" style="font-size:0.75em;color:#999;">
			<div style="float:left;"><?php the_time( 'F Y' ); ?></div>
			<div style="float:left;margin-left:20px"><?php farbest_entry_footer(); ?></div>
			<div style="clear:both"></div>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
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
	</div><!-- .entry-content -->
	<div style="color:#5f9732;text-align:center;font-size: .75em;margin:10px 0px 20px 0px;"><i class="fa fa-circle"></i></div>

	<!--<footer class="entry-footer">
		<?php farbest_entry_footer(); ?>
	</footer>--><!-- .entry-footer -->
</article><!-- #post-## -->