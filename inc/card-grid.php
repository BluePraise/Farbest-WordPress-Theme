<?php
/**
 * Card Grid — ACF field group and renderer for the Card Grid page template.
 *
 * Ported from the retired block theme's inc/card-grid-block.php
 * (tag archive/fse-final). The block registration is gone; page-card-grid.php
 * calls farbest_render_card_grid() directly.
 *
 * Editor workflow: assign the "Card Grid" template to a page, then fill in
 * cards via the ACF "Cards" meta box below the editor.
 *
 * The flip interaction is pure CSS (css/card-grid.css) — no JavaScript.
 *
 * @package farbest-classic
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The "Cards" repeater (group_card_grid) is no longer registered here in PHP.
 * It lives as ACF Local JSON in acf-json/group_card_grid.json, loaded and saved
 * via the load/save points in inc/acf.php.
 *
 * The move was needed because ACF hides PHP-registered field groups from the
 * Custom Fields → Field Groups screen; as Local JSON the group shows up there
 * (under "Sync available" until it is synced) and can be edited in the admin.
 * The field keys are unchanged, so existing `cards` data is untouched.
 *
 * The location rule still targets `page-card-grid.php` — ACF matches
 * _wp_page_template, which for a classic theme stores the filename, not the
 * bare `page-card-grid` slug the block theme used.
 */

/**
 * Render the card grid for a post.
 *
 * @param int|null $post_id Post to read the `cards` repeater from. Defaults to
 *                          the current post.
 * @return string Rendered HTML, or an empty string when there are no cards.
 */
function farbest_render_card_grid( $post_id = null ) {
	if ( ! function_exists( 'get_field' ) ) {
		return '';
	}

	$post_id = $post_id ? $post_id : get_the_ID();
	if ( ! $post_id ) {
		return '';
	}

	$cards = get_field( 'cards', $post_id );
	if ( empty( $cards ) ) {
		return '';
	}

	ob_start();
	?>
	<div class="card-grid-wrap alignfull">
		<div class="card-grid">
			<?php
			foreach ( $cards as $card ) :
				$img      = ! empty( $card['card_image'] )    ? $card['card_image']                                             : array();
				$img_url  = ! empty( $img['url'] )            ? esc_url( $img['url'] )                                          : '';
				$img_alt  = ! empty( $img['alt'] )            ? esc_attr( $img['alt'] )                                         : '';
				$name     = ! empty( $card['card_name'] )     ? esc_html( $card['card_name'] )                                  : '';
				$role     = ! empty( $card['card_role'] )     ? esc_html( $card['card_role'] )                                  : '';
				$bio      = ! empty( $card['card_bio'] )      ? esc_html( $card['card_bio'] )                                   : '';
				$email    = ! empty( $card['card_email'] )    ? sanitize_email( $card['card_email'] )                           : '';
				$linkedin = ! empty( $card['card_linkedin'] ) ? esc_url( $card['card_linkedin'] )                               : '';
				$phone    = ! empty( $card['card_phone'] )    ? esc_attr( preg_replace( '/[^+\d]/', '', $card['card_phone'] ) ) : '';
				?>
			<div class="grid-card">
				<div class="card-inner">
					<div class="card-front">
						<?php if ( $img_url ) : ?>
							<img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>">
						<?php endif; ?>
						<div class="card-info">
							<?php if ( $name ) : ?><h3 class="card-name"><?php echo $name; ?></h3><?php endif; ?>
							<?php if ( $role ) : ?><p class="card-role"><?php echo $role; ?></p><?php endif; ?>
						</div>
					</div>
					<div class="card-back">
						<?php if ( $bio ) : ?><p class="card-bio"><?php echo $bio; ?></p><?php endif; ?>
						<hr class="card-divider">
						<div class="card-contacts">
							<?php if ( $email ) : ?>
							<a href="mailto:<?php echo $email; ?>" class="card-contact-link" aria-label="<?php esc_attr_e( 'Email', 'farbest-classic' ); ?>">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
							</a>
							<?php endif; ?>
							<?php if ( $linkedin ) : ?>
							<a href="<?php echo $linkedin; ?>" class="card-contact-link" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
							</a>
							<?php endif; ?>
							<?php if ( $phone ) : ?>
							<a href="tel:<?php echo $phone; ?>" class="card-contact-link" aria-label="<?php esc_attr_e( 'Phone', 'farbest-classic' ); ?>">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
							</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
