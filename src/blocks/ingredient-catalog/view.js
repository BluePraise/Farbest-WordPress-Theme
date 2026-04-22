/**
 * Frontend view script for farbest/ingredient-catalog block.
 *
 * The plugin (farbest-product-catalog) owns the React bundle and mounts it
 * on #farbest-ingredient-grid. This script only ensures the mount point div
 * exists with the correct id so the plugin can find it.
 *
 * The plugin's enqueue_frontend_assets() fires on is_post_type_archive() and
 * loads the React bundle independently — no duplication needed here.
 */

document.addEventListener( 'DOMContentLoaded', () => {
	const blocks = document.querySelectorAll(
		'.wp-block-farbest-ingredient-catalog'
	);

	blocks.forEach( ( block ) => {
		if ( ! block.querySelector( '#farbest-ingredient-grid' ) ) {
			const mount = document.createElement( 'div' );
			mount.id = 'farbest-ingredient-grid';
			block.appendChild( mount );
		}
	} );
} );
