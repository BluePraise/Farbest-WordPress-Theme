<?php
/**
 * Title: Locations Grid
 * Slug: farbest/locations-grid
 * Categories: query
 * Description: Query loop displaying warehousing/location posts in a 3-column grid.
 * Block Types: core/query
 */
?>
<!-- wp:group {"align":"full","style":{"color":{"background":"#f2efe9"},"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="background-color:#f2efe9;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">

	<!-- wp:heading {"level":2,"textAlign":"center","align":"wide"} -->
	<h2 class="alignwide has-text-align-center">Warehousing &amp; Distribution</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}}} -->
	<p class="has-text-align-center alignwide" style="margin-bottom:var(--wp--preset--spacing--40)">Strategically located facilities to serve your supply chain needs.</p>
	<!-- /wp:paragraph -->

	<!-- wp:query {"align":"wide","query":{"postType":"post","perPage":6,"order":"asc","orderBy":"title","taxQuery":{"category":[{"slug":"warehousing"}]}},"layout":{"type":"default"}} -->
	<div class="wp-block-query alignwide">

		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->

			<!-- wp:group {"style":{"border":{"width":"1px","color":"#ddd7cb","radius":"4px"},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group" style="border:1px solid #ddd7cb;border-radius:4px;padding:var(--wp--preset--spacing--30)">
				<!-- wp:post-featured-image {"style":{"border":{"radius":"4px"}}} /-->
				<!-- wp:post-title {"level":3,"style":{"color":{"text":"#4D7B29"},"typography":{"fontSize":"var:preset|font-size|large"}}} /-->
				<!-- wp:post-excerpt /-->
			</div>
			<!-- /wp:group -->

		<!-- /wp:post-template -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">No locations found.</p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->

	</div>
	<!-- /wp:query -->

</div>
<!-- /wp:group -->
