<?php
/**
 * Search form.
 *
 * @package farbest-classic
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="search-field-<?php echo esc_attr( wp_unique_id() ); ?>">
		<?php esc_html_e( 'Search for:', 'farbest-classic' ); ?>
	</label>
	<input type="search" class="search-field" name="s"
		placeholder="<?php esc_attr_e( 'Search &hellip;', 'farbest-classic' ); ?>"
		value="<?php echo esc_attr( get_search_query() ); ?>">
	<button type="submit" class="search-submit"><?php esc_html_e( 'Search', 'farbest-classic' ); ?></button>
</form>
