<?php
/**
 * Team — the Team Member post type, its grid renderer, and the [farbest_team]
 * shortcode.
 *
 * Replaces the hand-built Kadence Row Layout on the Team page, where every
 * member was a duplicated stack of nested blocks. Each member is now a post,
 * edited through a short ACF form.
 *
 * The markup deliberately reuses the class names from that Kadence build
 * (.team-grid-container, .team-card, .card-expanded-bio, …) so the styling the
 * client wrote against them carries over unchanged. Those rules have moved out
 * of Customizer → Additional CSS into css/team.css so they are version
 * controlled; delete the Customizer copy or both will apply.
 *
 * Members have no single pages by design: the full bio *is* the hover panel, so
 * a /team/{name}/ URL would only duplicate it. Singular requests redirect to
 * the archive.
 *
 * @package farbest-classic
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Team Member post type.
 *
 * `editor` is deliberately not supported. The bio lives in the ACF field so
 * there is exactly one place to type it, and so a member cannot grow its own
 * nested block layout — the problem this post type exists to solve.
 */
function farbest_register_team_post_type() {
	$labels = array(
		'name'               => _x( 'Team', 'Post Type General Name', 'farbest-classic' ),
		'singular_name'      => _x( 'Team Member', 'Post Type Singular Name', 'farbest-classic' ),
		'menu_name'          => __( 'Team', 'farbest-classic' ),
		'name_admin_bar'     => __( 'Team Member', 'farbest-classic' ),
		'all_items'          => __( 'All Team Members', 'farbest-classic' ),
		'add_new'            => __( 'Add New', 'farbest-classic' ),
		'add_new_item'       => __( 'Add New Team Member', 'farbest-classic' ),
		'new_item'           => __( 'New Team Member', 'farbest-classic' ),
		'edit_item'          => __( 'Edit Team Member', 'farbest-classic' ),
		'update_item'        => __( 'Update Team Member', 'farbest-classic' ),
		'view_item'          => __( 'View Team Member', 'farbest-classic' ),
		'view_items'         => __( 'View Team', 'farbest-classic' ),
		'search_items'       => __( 'Search Team', 'farbest-classic' ),
		'not_found'          => __( 'No team members found', 'farbest-classic' ),
		'not_found_in_trash' => __( 'No team members found in Trash', 'farbest-classic' ),
		'featured_image'     => __( 'Photo', 'farbest-classic' ),
		'set_featured_image' => __( 'Set photo', 'farbest-classic' ),
		'remove_featured_image' => __( 'Remove photo', 'farbest-classic' ),
		'use_featured_image' => __( 'Use as photo', 'farbest-classic' ),
		'archives'           => __( 'Team Archives', 'farbest-classic' ),
		'attributes'         => __( 'Order', 'farbest-classic' ),
	);

	$args = array(
		'label'               => __( 'Team Member', 'farbest-classic' ),
		'labels'              => $labels,
		'description'         => __( 'People shown in the Farbest team grid.', 'farbest-classic' ),
		'supports'            => array( 'title', 'thumbnail', 'page-attributes' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 21,
		'menu_icon'           => 'dashicons-groups',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => 'team',
		// Members are only ever seen in the grid, so keep them out of site
		// search results; the archive itself stays publicly queryable.
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest'        => true,
		'rest_base'           => 'team',
		'rewrite'             => array(
			'slug'       => 'team',
			'with_front' => false,
		),
	);

	register_post_type( 'farbest_team', $args );
}
add_action( 'init', 'farbest_register_team_post_type' );

/**
 * Send single team-member URLs to the archive.
 *
 * There is no single template on purpose (see the file header). Without this a
 * member would fall through to single.php and render a bare title.
 */
function farbest_team_redirect_single() {
	if ( ! is_singular( 'farbest_team' ) ) {
		return;
	}

	$archive = get_post_type_archive_link( 'farbest_team' );

	if ( $archive ) {
		wp_safe_redirect( $archive, 301 );
		exit;
	}
}
add_action( 'template_redirect', 'farbest_team_redirect_single' );

/**
 * Fetch published team members in display order.
 *
 * Ordered by the Order field (Page Attributes box) with title as the
 * tie-breaker, so the client can rank people without renaming them.
 *
 * @param int $limit Maximum members to return. -1 for all.
 * @return WP_Post[]
 */
function farbest_get_team_members( $limit = -1 ) {
	return get_posts( array(
		'post_type'      => 'farbest_team',
		'post_status'    => 'publish',
		'posts_per_page' => $limit,
		'orderby'        => array(
			'menu_order' => 'ASC',
			'title'      => 'ASC',
		),
		'no_found_rows'  => true,
	) );
}

/**
 * Default heading for the bio panel, e.g. "Meet Dan".
 *
 * @param string $name Member's full name.
 * @return string
 */
function farbest_team_default_bio_heading( $name ) {
	$parts = preg_split( '/\s+/', trim( $name ) );
	$first = ! empty( $parts[0] ) ? $parts[0] : $name;

	/* translators: %s: team member's first name. */
	return sprintf( __( 'Meet %s', 'farbest-classic' ), $first );
}

/**
 * Render the team grid.
 *
 * @param WP_Post[]|null $members Members to render. Defaults to all published.
 * @return string Rendered HTML, or an empty string when there are no members.
 */
function farbest_render_team_grid( $members = null ) {
	if ( null === $members ) {
		$members = farbest_get_team_members();
	}

	if ( empty( $members ) ) {
		return '';
	}

	$has_acf = function_exists( 'get_field' );

	ob_start();
	?>
	<div class="team-grid-container">
		<?php
		foreach ( $members as $member ) :
			$id       = $member->ID;
			$role     = $has_acf ? (string) get_field( 'team_role', $id ) : '';
			$bio      = $has_acf ? (string) get_field( 'team_bio', $id ) : '';
			$heading  = $has_acf ? trim( (string) get_field( 'team_bio_heading', $id ) ) : '';
			$email    = $has_acf ? sanitize_email( (string) get_field( 'team_email', $id ) ) : '';
			$linkedin = $has_acf ? esc_url_raw( (string) get_field( 'team_linkedin', $id ) ) : '';
			$phone    = $has_acf ? trim( (string) get_field( 'team_phone', $id ) ) : '';
			$tel      = $phone ? preg_replace( '/[^+\d]/', '', $phone ) : '';
			$name     = get_the_title( $id );

			if ( '' === $heading ) {
				$heading = farbest_team_default_bio_heading( $name );
			}
			?>
		<div class="team-card">
			<div class="card-main-info">
				<?php if ( has_post_thumbnail( $id ) ) : ?>
					<figure class="team-photo">
						<?php echo get_the_post_thumbnail( $id, 'medium_large', array( 'alt' => esc_attr( $name ) ) ); ?>
					</figure>
				<?php endif; ?>
				<h3 class="team-name"><?php echo esc_html( $name ); ?></h3>
				<?php if ( $role ) : ?>
					<p class="team-title"><?php echo esc_html( $role ); ?></p>
				<?php endif; ?>
			</div>

			<div class="card-expanded-bio">
				<div class="bio-inner-content">
					<h4><?php echo esc_html( $heading ); ?></h4>
					<?php if ( $bio ) : ?>
						<div class="team-bio"><?php echo wp_kses_post( $bio ); ?></div>
					<?php endif; ?>

					<?php if ( $email || $tel || $linkedin ) : ?>
					<div class="team-links">
						<?php if ( $email ) : ?>
							<a class="team-email" href="mailto:<?php echo esc_attr( $email ); ?>">
								<?php
								/* translators: %s: team member's name. */
								printf( esc_html__( 'Email %s', 'farbest-classic' ), esc_html( $name ) );
								?>
							</a>
						<?php endif; ?>
						<?php if ( $tel ) : ?>
							<a class="team-phone" href="tel:<?php echo esc_attr( $tel ); ?>"><?php echo esc_html( $phone ); ?></a>
						<?php endif; ?>
						<?php if ( $linkedin ) : ?>
							<a class="team-linkedin" href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer">
								<?php esc_html_e( 'LinkedIn', 'farbest-classic' ); ?>
							</a>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php
	return ob_get_clean();
}

/**
 * Shortcode: [farbest_team] — the team grid, for dropping into any page.
 *
 * @param array $atts Shortcode attributes. `limit` caps the number shown.
 * @return string
 */
function farbest_team_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'limit' => -1 ), $atts, 'farbest_team' );

	$limit = (int) $atts['limit'];
	if ( $limit < 1 ) {
		$limit = -1;
	}

	return farbest_render_team_grid( farbest_get_team_members( $limit ) );
}
add_shortcode( 'farbest_team', 'farbest_team_shortcode' );

/**
 * Whether the post being viewed embeds the team grid.
 *
 * Used by farbest_scripts() to enqueue css/team.css in wp_head on pages
 * carrying the shortcode, rather than from inside the shortcode itself where
 * the stylesheet would land in the footer and flash unstyled.
 *
 * @return bool
 */
function farbest_post_has_team_grid() {
	if ( ! is_singular() ) {
		return false;
	}

	$post = get_post();

	return ( $post instanceof WP_Post ) && has_shortcode( $post->post_content, 'farbest_team' );
}

/**
 * Admin list columns: photo, role, and order, so the list reads like the grid.
 *
 * @param array $columns Existing columns.
 * @return array
 */
function farbest_team_admin_columns( $columns ) {
	$new = array();

	foreach ( $columns as $key => $label ) {
		if ( 'title' === $key ) {
			$new['farbest_team_photo'] = __( 'Photo', 'farbest-classic' );
		}

		$new[ $key ] = $label;

		if ( 'title' === $key ) {
			$new['farbest_team_role']  = __( 'Role', 'farbest-classic' );
			$new['farbest_team_order'] = __( 'Order', 'farbest-classic' );
		}
	}

	return $new;
}
add_filter( 'manage_farbest_team_posts_columns', 'farbest_team_admin_columns' );

/**
 * Fill the custom Team columns.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post being listed.
 */
function farbest_team_admin_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'farbest_team_photo':
			echo has_post_thumbnail( $post_id )
				? get_the_post_thumbnail( $post_id, array( 48, 48 ) )
				: '&mdash;';
			break;

		case 'farbest_team_role':
			$role = function_exists( 'get_field' ) ? (string) get_field( 'team_role', $post_id ) : '';
			echo $role ? esc_html( $role ) : '&mdash;';
			break;

		case 'farbest_team_order':
			echo (int) get_post_field( 'menu_order', $post_id );
			break;
	}
}
add_action( 'manage_farbest_team_posts_custom_column', 'farbest_team_admin_column_content', 10, 2 );

/**
 * Sort the admin list the same way the front end does.
 *
 * @param WP_Query $query Current admin query.
 */
function farbest_team_admin_order( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( 'farbest_team' !== $query->get( 'post_type' ) || $query->get( 'orderby' ) ) {
		return;
	}

	$query->set( 'orderby', array( 'menu_order' => 'ASC', 'title' => 'ASC' ) );
}
add_action( 'pre_get_posts', 'farbest_team_admin_order' );
