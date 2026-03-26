<?php

/**
 * Template Name: Filter Demo
 * Description: Legacy compatibility template that redirects to the canonical ingredient archive.
 */

$archive_url = home_url( '/ingredients/' );

if ( $archive_url ) {
	wp_safe_redirect( $archive_url, 302 );
	exit;
}

get_header();
?>
<div class="content-wrapper container">
	<p>
		<?php esc_html_e( 'The ingredient catalog now lives on the main Ingredients archive.', 'farbest' ); ?>
		<a href="<?php echo esc_url( home_url( '/ingredients/' ) ); ?>"><?php esc_html_e( 'Visit Ingredients', 'farbest' ); ?></a>
	</p>
</div>
<?php
get_footer();