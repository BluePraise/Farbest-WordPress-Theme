<?php
/**
 * Title: Ingredient Grid
 * Slug: farbest/product-grid
 * Categories: query
 * Description: Query loop displaying fpc_ingredient posts in a 3-column card grid.
 * Block Types: core/query
 */
?>
<!-- wp:group {"align":"full","style":{"color":{"background":"#ffffff"},"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="background-color:#ffffff;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">

	<!-- wp:heading {"level":2,"textAlign":"center","align":"wide"} -->
	<h2 class="alignwide has-text-align-center">Our Ingredients</h2>
	<!-- /wp:heading -->

	<!-- wp:query {"align":"wide","query":{"postType":"fpc_ingredient","perPage":9,"order":"asc","orderBy":"title"},"layout":{"type":"default"}} -->
	<div class="wp-block-query alignwide">

		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->

			<!-- wp:group {"style":{"border":{"width":"1px","color":"#ddd7cb","radius":"4px"},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group" style="border:1px solid #ddd7cb;border-radius:4px;padding:var(--wp--preset--spacing--30)">
				<!-- wp:post-featured-image {"isLink":true,"style":{"border":{"radius":"4px"}}} /-->
				<!-- wp:post-title {"isLink":true,"level":3,"style":{"color":{"text":"#4D7B29"},"typography":{"fontSize":"var:preset|font-size|large"}}} /-->
				<!-- wp:post-terms {"term":"fpc_category","style":{"color":{"text":"#5C643A"},"typography":{"fontSize":"var:preset|font-size|small"}}} /-->
				<!-- wp:post-excerpt {"moreText":"View ingredient","style":{"typography":{"fontSize":"var:preset|font-size|medium"}}} /-->
			</div>
			<!-- /wp:group -->

		<!-- /wp:post-template -->

		<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
			<!-- wp:query-pagination-previous /-->
			<!-- wp:query-pagination-numbers /-->
			<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">No ingredients found.</p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->

	</div>
	<!-- /wp:query -->

</div>
<!-- /wp:group -->
