<?php
/**
 * Single post content.
 *
 * @package farbest-classic
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		</div>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumbnail"><?php the_post_thumbnail( 'large' ); ?></div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'farbest-classic' ),
			'after'  => '</div>',
		) );
		?>
	</div>

</article>
