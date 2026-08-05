<?php
/**
 * Block patterns — on-brand starting points for client-built content.
 *
 * These appear in the editor inserter under "Farbest". They exist so common
 * sections (an FAQ, a call to action) can be inserted already using the brand
 * palette and edited, rather than built from scratch and drifting off-brand.
 *
 * Deliberately built from core blocks, not Kadence ones: core block markup is
 * stable and renders even if Kadence is ever deactivated, and core/details is a
 * native accordion so the FAQ needs no plugin at all. Kadence blocks can still
 * be added around or inside these.
 *
 * Colours reference the palette registered in functions.php
 * (add_theme_support('editor-color-palette')); the matching front-end classes
 * live in css/base.css.
 *
 * @package farbest-classic
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the pattern category and the patterns themselves.
 */
function farbest_register_block_patterns() {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'farbest',
			array( 'label' => __( 'Farbest', 'farbest-classic' ) )
		);
	}

	// ── FAQ accordion ──────────────────────────────────────────────────────
	register_block_pattern(
		'farbest-classic/faq-accordion',
		array(
			'title'       => __( 'FAQ accordion', 'farbest-classic' ),
			'description' => __( 'A heading with three expandable question-and-answer items.', 'farbest-classic' ),
			'categories'  => array( 'farbest' ),
			'keywords'    => array( 'faq', 'questions', 'accordion' ),
			'content'     => '
<!-- wp:heading {"textColor":"farbest-teal"} -->
<h2 class="wp-block-heading has-farbest-teal-color has-text-color">' . esc_html__( 'Frequently asked questions', 'farbest-classic' ) . '</h2>
<!-- /wp:heading -->

<!-- wp:details -->
<details class="wp-block-details"><summary>' . esc_html__( 'First question goes here', 'farbest-classic' ) . '</summary>
<!-- wp:paragraph -->
<p>' . esc_html__( 'Replace this with the answer.', 'farbest-classic' ) . '</p>
<!-- /wp:paragraph -->
</details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary>' . esc_html__( 'Second question goes here', 'farbest-classic' ) . '</summary>
<!-- wp:paragraph -->
<p>' . esc_html__( 'Replace this with the answer.', 'farbest-classic' ) . '</p>
<!-- /wp:paragraph -->
</details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary>' . esc_html__( 'Third question goes here', 'farbest-classic' ) . '</summary>
<!-- wp:paragraph -->
<p>' . esc_html__( 'Replace this with the answer.', 'farbest-classic' ) . '</p>
<!-- /wp:paragraph -->
</details>
<!-- /wp:details -->',
		)
	);

	// ── Call to action ─────────────────────────────────────────────────────
	register_block_pattern(
		'farbest-classic/cta-band',
		array(
			'title'       => __( 'Call to action band', 'farbest-classic' ),
			'description' => __( 'A centred heading, short line of copy and a Get in Touch button on a beige band.', 'farbest-classic' ),
			'categories'  => array( 'farbest' ),
			'keywords'    => array( 'cta', 'contact', 'button' ),
			'content'     => '
<!-- wp:group {"backgroundColor":"farbest-beige","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-farbest-beige-background-color has-background">
<!-- wp:heading {"textAlign":"center","textColor":"farbest-teal"} -->
<h2 class="wp-block-heading has-text-align-center has-farbest-teal-color has-text-color">' . esc_html__( 'Need help choosing an ingredient?', 'farbest-classic' ) . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">' . esc_html__( 'Our team can help you find the right grade for your formulation.', 'farbest-classic' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">
<!-- wp:button {"backgroundColor":"farbest-lime","textColor":"farbest-footer-bg"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-farbest-footer-bg-color has-farbest-lime-background-color has-text-color has-background wp-element-button" href="/contact/">' . esc_html__( 'Get in Touch', 'farbest-classic' ) . '</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->',
		)
	);
}
add_action( 'init', 'farbest_register_block_patterns' );
