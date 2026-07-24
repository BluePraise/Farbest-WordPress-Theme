<?php
/**
 * Shown when a loop returns no results.
 *
 * @package farbest-classic
 */
?>
<section class="no-results">

	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing found', 'farbest-classic' ); ?></h1>
	</header>

	<div class="page-content">
		<?php if ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, nothing matched those terms. Try again with different keywords.', 'farbest-classic' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Nothing to show here yet.', 'farbest-classic' ); ?></p>
		<?php endif; ?>
	</div>

</section>
