<?php
/**
 * Title: CTA Section
 * Slug: farbest/cta-section
 * Categories: call-to-action
 * Description: Centered call-to-action section with heading, body text, and a lime button.
 */
?>
<!-- wp:group {"align":"full","style":{"color":{"background":"#f2efe9"},"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="background-color:#f2efe9;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">

	<!-- wp:group {"align":"wide","layout":{"type":"flex","orientation":"vertical","crossAxis":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
	<div class="wp-block-group alignwide">

		<!-- wp:heading {"level":2,"textAlign":"center","style":{"color":{"text":"#4D7B29"}}} -->
		<h2 class="has-text-align-center" style="color:#4D7B29">Ready to source your next ingredient?</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"var:preset|font-size|large"}}} -->
		<p class="has-text-align-center" style="font-size:var(--wp--preset--font-size--large)">Our team of ingredient experts is ready to help you find the right solution for your formulation.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons">
			<!-- wp:button {"backgroundColor":"lime","textColor":"footer-navy","style":{"border":{"radius":"4px"}}} -->
			<div class="wp-block-button">
				<a class="wp-block-button__link has-footer-navy-color has-lime-background-color has-text-color has-background" style="border-radius:4px">Contact Us</a>
			</div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
