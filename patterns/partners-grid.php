<?php
/**
 * Title: Partners Grid
 * Slug: farbest/partners-grid
 * Categories: query
 * Description: Query loop displaying partner/supplier posts in a 4-column logo grid.
 * Block Types: core/query
 */
?>
<!-- wp:group {"align":"full","style":{"color":{"background":"#ffffff"},"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="background-color:#ffffff;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">

	<!-- wp:heading {"level":2,"textAlign":"center","align":"wide"} -->
	<h2 class="alignwide has-text-align-center">Our Partners</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}}} -->
	<p class="has-text-align-center alignwide" style="margin-bottom:var(--wp--preset--spacing--40)">We partner with world-class suppliers to bring you the best ingredients on the market.</p>
	<!-- /wp:paragraph -->

	<!-- wp:query {"align":"wide","query":{"postType":"partners","perPage":12,"order":"asc","orderBy":"title"},"layout":{"type":"default"}} -->
	<div class="wp-block-query alignwide">

		<!-- wp:post-template {"layout":{"type":"grid","columnCount":4}} -->

			<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20","right":"var:preset|spacing|20"}}},"layout":{"type":"flex","orientation":"vertical","crossAxis":"center"}} -->
			<div class="wp-block-group" style="padding:var(--wp--preset--spacing--20)">
				<!-- wp:post-featured-image {"isLink":false,"style":{"border":{"radius":"0px"}}} /-->
				<!-- wp:post-title {"level":5,"style":{"color":{"text":"#5C643A"},"typography":{"fontSize":"var:preset|font-size|small","textAlign":"center"}}} /-->
			</div>
			<!-- /wp:group -->

		<!-- /wp:post-template -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">No partners found.</p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->

	</div>
	<!-- /wp:query -->

</div>
<!-- /wp:group -->
