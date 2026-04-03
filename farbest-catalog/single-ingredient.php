<?php
/**
 * Theme override: single ingredient template
 *
 * Loaded in place of the plugin's templates/single-ingredient.php.
 * Plugin styles (archive grid, tabs, related cards) are still enqueued.
 * Theme-specific layout styles live in css/ingredient-single.css.
 */

get_header();

while ( have_posts() ) :
    the_post();
    $ingredient_id = get_the_ID();

    // Product Details tab data
    $application_terms = wp_get_post_terms( $ingredient_id, 'fpc_application', array( 'fields' => 'names' ) );
    if ( is_wp_error( $application_terms ) || ! is_array( $application_terms ) ) {
        $application_terms = array();
    }
    $app_list = array_values( array_filter( array_map( 'trim', $application_terms ) ) );
    if ( empty( $app_list ) ) {
        $legacy_applications = get_field( 'product_applications' );
        if ( ! empty( $legacy_applications ) && is_string( $legacy_applications ) ) {
            $app_list = array_values( array_filter( array_map( 'trim', explode( '|', $legacy_applications ) ) ) );
        }
    }

    $claim_terms = wp_get_post_terms( $ingredient_id, 'fpc_claim', array( 'fields' => 'names' ) );
    if ( is_wp_error( $claim_terms ) || ! is_array( $claim_terms ) ) {
        $claim_terms = array();
    }

    $cert_terms = wp_get_post_terms( $ingredient_id, 'fpc_certification' );
    if ( is_wp_error( $cert_terms ) || ! is_array( $cert_terms ) ) {
        $cert_terms = array();
    }

    $packaging           = get_field( 'product_packaging' );
    $product_sheet       = get_field( 'product_sheet' );
    $product_description = get_field( 'product_description' );
    $benefits_columns    = get_field( 'benefits_columns' );
    ?>



        <div id="primary" class="content-area fis-content-area">
            <main id="main" class="site-main" role="main">

                <article id="ingredient-<?php the_ID(); ?>" <?php post_class( 'farbest-ingredient-single' ); ?>>

                    <div class="ingredient-container">

                        <!-- Breadcrumb -->
                        <?php
                        $breadcrumb_categories = wp_get_post_terms( $ingredient_id, 'fpc_category' );
                        $breadcrumb_category   = ( ! is_wp_error( $breadcrumb_categories ) && ! empty( $breadcrumb_categories ) ) ? $breadcrumb_categories[0] : null;
                        $ingredients_url       = get_post_type_archive_link( 'fpc_ingredient' );
                        ?>
                        <nav class="ingredient-breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'farbest-catalog' ); ?>">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'farbest-catalog' ); ?></a>
                            <span class="ingredient-breadcrumb__sep" aria-hidden="true"> | </span>
                            <a href="<?php echo esc_url( $ingredients_url ); ?>"><?php esc_html_e( 'Ingredients', 'farbest-catalog' ); ?></a>
                            <?php if ( $breadcrumb_category ) : ?>
                                <span class="ingredient-breadcrumb__sep" aria-hidden="true"> | </span>
                                <a href="<?php echo esc_url( get_term_link( $breadcrumb_category ) ); ?>"><?php echo esc_html( $breadcrumb_category->name ); ?></a>
                            <?php endif; ?>
                            <span class="ingredient-breadcrumb__sep" aria-hidden="true"> | </span>
                            <span class="ingredient-breadcrumb__current" aria-current="page"><?php the_title(); ?></span>
                        </nav>

                        <!-- Ingredient Header -->
                        <header class="ingredient-header">
                            <h1 class="ingredient-title"><?php the_title(); ?></h1>


                        </header>

                        <?php if ( ! empty( $benefits_columns ) ) : ?>
                            <div class="ingredient-benefits">
                                <?php foreach ( $benefits_columns as $column ) :
                                    $col_label = ! empty( $column['column_label'] ) ? $column['column_label'] : '';
                                    $col_items = ! empty( $column['column_items'] ) ? $column['column_items'] : array();
                                    if ( empty( $col_label ) && empty( $col_items ) ) continue;
                                ?>
                                    <div class="ingredient-benefits__column">
                                        <?php if ( $col_label ) : ?>
                                            <h3 class="ingredient-benefits__heading"><?php echo esc_html( $col_label ); ?></h3>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $col_items ) ) : ?>
                                            <ul class="ingredient-benefits__list">
                                                <?php foreach ( $col_items as $item ) : ?>
                                                    <?php if ( ! empty( $item['item_text'] ) ) : ?>
                                                        <li><?php echo esc_html( $item['item_text'] ); ?></li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>


                        <!-- Ingredient Main Content -->
                        <div class="ingredient-main">

                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="ingredient-image">
                                    <?php the_post_thumbnail( 'large' ); ?>
                                </div>
                            <?php endif; ?>

                            <div class="ingredient-info">

                                <?php if ( $product_sheet ) : ?>
                                    <div class="ingredient-sheet">
                                        <a href="<?php echo esc_url( $product_sheet['url'] ); ?>"
                                           class="button ingredient-sheet-button"
                                           download>
                                            <span class="dashicons dashicons-pdf"></span>
                                            <?php esc_html_e( 'Download Product Sheet', 'farbest-catalog' ); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                            </div>

                        </div>

                        <!-- Tabbed Content: Product Description / Product Details -->
                        <div class="ingredient-tabs" id="ingredient-tabs-<?php the_ID(); ?>">

                            <nav class="ingredient-tabs__nav" role="tablist">
                                <button
                                    class="ingredient-tabs__tab ingredient-tabs__tab--active"
                                    role="tab"
                                    aria-selected="true"
                                    aria-controls="tab-description-<?php the_ID(); ?>"
                                    id="tab-btn-description-<?php the_ID(); ?>"
                                    data-tab="description"
                                >
                                    <?php esc_html_e( 'Product Description', 'farbest-catalog' ); ?>
                                </button>
                                <button
                                    class="ingredient-tabs__tab"
                                    role="tab"
                                    aria-selected="false"
                                    aria-controls="tab-details-<?php the_ID(); ?>"
                                    id="tab-btn-details-<?php the_ID(); ?>"
                                    data-tab="details"
                                >
                                    <?php esc_html_e( 'Product Details', 'farbest-catalog' ); ?>
                                </button>
                            </nav>

                            <!-- Tab: Product Description -->
                            <div
                                class="ingredient-tabs__panel ingredient-tabs__panel--active"
                                role="tabpanel"
                                id="tab-description-<?php the_ID(); ?>"
                                aria-labelledby="tab-btn-description-<?php the_ID(); ?>"
                            >
                                <?php if ( $product_description ) : ?>
                                    <div class="ingredient-description">
                                        <?php echo wp_kses_post( $product_description ); ?>
                                    </div>
                                <?php else : ?>
                                    <p class="ingredient-tabs__empty"><?php esc_html_e( 'No description available.', 'farbest-catalog' ); ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Tab: Product Details -->
                            <div
                                class="ingredient-tabs__panel"
                                role="tabpanel"
                                id="tab-details-<?php the_ID(); ?>"
                                aria-labelledby="tab-btn-details-<?php the_ID(); ?>"
                                hidden
                            >
                                <table class="ingredient-details-table">
                                    <tbody>

                                        <?php if ( ! empty( $app_list ) ) : ?>
                                            <tr>
                                                <th><?php esc_html_e( 'Applications', 'farbest-catalog' ); ?></th>
                                                <td>
                                                    <?php foreach ( $app_list as $app ) : ?>
                                                        <div><?php echo esc_html( $app ); ?></div>
                                                    <?php endforeach; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                        <?php if ( ! empty( $claim_terms ) ) : ?>
                                            <tr>
                                                <th><?php esc_html_e( 'Label Claims', 'farbest-catalog' ); ?></th>
                                                <td><?php echo esc_html( implode( ' | ', $claim_terms ) ); ?></td>
                                            </tr>
                                        <?php endif; ?>

                                        <?php if ( ! empty( $cert_terms ) ) : ?>
                                            <tr>
                                                <th><?php esc_html_e( 'Certifications', 'farbest-catalog' ); ?></th>
                                                <td><?php echo esc_html( implode( ' | ', wp_list_pluck( $cert_terms, 'name' ) ) ); ?></td>
                                            </tr>
                                        <?php endif; ?>

                                        <?php if ( $packaging ) : ?>
                                            <tr>
                                                <th><?php esc_html_e( 'Packaging', 'farbest-catalog' ); ?></th>
                                                <td><?php echo esc_html( $packaging ); ?></td>
                                            </tr>
                                        <?php endif; ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <!-- Tab switching script -->
                        <script>
                        (function () {
                            document.querySelectorAll('.ingredient-tabs').forEach(function (wrapper) {
                                var tabs   = wrapper.querySelectorAll('.ingredient-tabs__tab');
                                var panels = wrapper.querySelectorAll('.ingredient-tabs__panel');

                                tabs.forEach(function (tab) {
                                    tab.addEventListener('click', function () {
                                        var target = tab.getAttribute('aria-controls');

                                        tabs.forEach(function (t) {
                                            t.setAttribute('aria-selected', 'false');
                                            t.classList.remove('ingredient-tabs__tab--active');
                                        });
                                        panels.forEach(function (p) {
                                            p.hidden = true;
                                            p.classList.remove('ingredient-tabs__panel--active');
                                        });

                                        tab.setAttribute('aria-selected', 'true');
                                        tab.classList.add('ingredient-tabs__tab--active');
                                        var panel = document.getElementById(target);
                                        if (panel) {
                                            panel.hidden = false;
                                            panel.classList.add('ingredient-tabs__panel--active');
                                        }
                                    });
                                });
                            });
                        })();
                        </script>

                        <!-- Related Products -->
                        <?php
                        $related_category = ( ! empty( $categories ) && ! is_wp_error( $categories ) ) ? $categories[0] : null;
                        if ( $related_category ) :
                            $related_query = new WP_Query( array(
                                'post_type'      => 'fpc_ingredient',
                                'posts_per_page' => 4,
                                'post__not_in'   => array( $ingredient_id ),
                                'orderby'        => 'rand',
                                'tax_query'      => array(
                                    array(
                                        'taxonomy' => 'fpc_category',
                                        'field'    => 'term_id',
                                        'terms'    => $related_category->term_id,
                                    ),
                                ),
                            ) );
                        ?>
                        <?php if ( $related_query->have_posts() ) : ?>
                            <div class="ingredient-related">
                                <h2 class="fpc-filter-label ingredient-related__heading">
                                    <?php echo esc_html( sprintf( __( 'More %s Products', 'farbest-catalog' ), $related_category->name ) ); ?>
                                </h2>
                                <div class="fpc-ingredients-grid">
                                    <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                                        <?php
                                        $rel_id       = get_the_ID();
                                        $rel_benefits = get_field( 'benefits_columns', $rel_id );
                                        $rel_certs    = wp_get_post_terms( $rel_id, 'fpc_certification' );
                                        $rel_certs    = ( ! is_wp_error( $rel_certs ) && is_array( $rel_certs ) ) ? $rel_certs : array();
                                        ?>
                                        <article class="fpc-ingredient-card">
                                            <div class="fpc-ingredient-card-content">
                                                <h3 class="fpc-ingredient-title"><?php the_title(); ?></h3>

                                                <?php if ( ! empty( $rel_benefits ) ) :
                                                    $rel_items = ! empty( $rel_benefits[0]['column_items'] ) ? $rel_benefits[0]['column_items'] : array();
                                                    if ( ! empty( $rel_items ) ) : ?>
                                                    <ul class="fpc-ingredient-excerpt">
                                                        <?php foreach ( $rel_items as $rel_item ) : ?>
                                                            <?php if ( ! empty( $rel_item['item_text'] ) ) : ?>
                                                                <li><?php echo esc_html( $rel_item['item_text'] ); ?></li>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; endif; ?>

                                                <?php if ( ! empty( $rel_certs ) ) : ?>
                                                    <div class="fpc-ingredient-terms">
                                                        <?php foreach ( $rel_certs as $rel_cert ) :
                                                            $rel_logo = get_field( 'certification_logo', 'fpc_certification_' . $rel_cert->term_id );
                                                            if ( ! empty( $rel_logo['url'] ) ) : ?>
                                                                <img
                                                                    src="<?php echo esc_url( $rel_logo['url'] ); ?>"
                                                                    alt="<?php echo esc_attr( ! empty( $rel_logo['alt'] ) ? $rel_logo['alt'] : $rel_cert->name ); ?>"
                                                                    class="fpc-ingredient-cert-logo"
                                                                >
                                                        <?php endif; endforeach; ?>
                                                    </div>
                                                <?php endif; ?>

                                                <a href="<?php the_permalink(); ?>" class="fpc-button">
                                                    <?php esc_html_e( 'Product Details', 'farbest-catalog' ); ?>
                                                </a>
                                            </div>
                                        </article>
                                    <?php endwhile; wp_reset_postdata(); ?>
                                </div>
                                <div class="ingredient-related__footer">
                                    <a href="<?php echo esc_url( get_term_link( $related_category ) ); ?>" class="fpc-button">
                                        &lt; <?php esc_html_e( 'More', 'farbest-catalog' ); ?> &gt;
                                    </a>
                                </div>
                            </div>
                        <?php endif; endif; ?>

                    </div><!-- .ingredient-container -->

                </article>

            </main><!-- #main -->
        </div><!-- #primary -->

    <?php
endwhile;

get_footer();
