<?php
/**
 * Title: Hero
 * Slug: farbest/hero
 * Categories: featured, banner
 * Description: Full-width hero with heading, subtitle, and CTA button on a teal background.
 */
?>
<!-- wp:cover {"align":"full","minHeight":560,"minHeightUnit":"px","style":{"color":{"background":"#003e52"}},"isDark":true} -->
<div class="wp-block-cover alignfull is-dark" style="min-height:560px;background-color:#003e52">
	<div class="wp-block-cover__inner-container">

		<!-- wp:group {"align":"wide","layout":{"type":"flex","orientation":"vertical","crossAxis":"flex-start"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-group alignwide">

			<!-- wp:heading {"level":1,"style":{"color":{"text":"#ffffff"},"typography":{"fontSize":"var:preset|font-size|xxx-large","fontWeight":"700"}}} -->
			<h1 style="color:#ffffff;font-size:var(--wp--preset--font-size--xxx-large);font-weight:700">Quality ingredients.<br>Trusted expertise.</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"style":{"color":{"text":"#ddd7cb"},"typography":{"fontSize":"var:preset|font-size|x-large","fontWeight":"300"}}} -->
			<p style="color:#ddd7cb;font-size:var(--wp--preset--font-size--x-large);font-weight:300">Supplying the food and beverage industry with premium functional ingredients.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"backgroundColor":"lime","textColor":"footer-navy","style":{"border":{"radius":"4px"}}} -->
				<div class="wp-block-button">
					<a class="wp-block-button__link has-footer-navy-color has-lime-background-color has-text-color has-background" style="border-radius:4px">Explore Ingredients</a>
				</div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->

		</div>
		<!-- /wp:group -->

	</div>
</div>
<!-- /wp:cover -->
