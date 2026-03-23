<?php

/**
 * Template Name: Filter Demo
 * Description: Proof of concept for ingredient filtering
 */

get_header(); ?>

<link href="<?php echo get_template_directory_uri(); ?>/css/farbest.css" rel="stylesheet">

<!-- Demo Ribbon -->
<div id="demo-ribbon" role="banner" aria-label="Demo notice">
    <div class="demo-ribbon-inner">
        <span class="demo-ribbon-badge">DEMO</span>
        <span class="demo-ribbon-message">
            This is a <strong>client preview</strong> — features, data, and design are subject to change and do not represent the final product.
        </span>
        <button class="demo-ribbon-close" onclick="document.getElementById('demo-ribbon').style.display='none'" aria-label="Dismiss notice">&times;</button>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Our Ingredients,
                Your Sourcing Simplified.</h2>
            <p class="lead">Filter and search through our ingredients catalog</p>

            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3 align-items-end">
                                <!-- Search Box -->
                                <div class="col-md-3">
                                    <label for="ingredientSearch" class="form-label fw-bold">Search</label>
                                    <input type="text" class="form-control" id="ingredientSearch" placeholder="Search ingredients...">
                                </div>

                                <!-- Label Claims Filter -->
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Label Claims</label>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" id="claimsDropdown" aria-expanded="false">
                                            <span id="claimsLabel">All Claims</span>
                                        </button>
                                        <div class="dropdown-menu p-3" style="min-width: 300px; width: 100%;">
                                            <?php
                                            $claims_terms = get_terms(array(
                                                'taxonomy' => 'claim',
                                                'hide_empty' => true,
                                                'orderby' => 'name',
                                                'order' => 'ASC'
                                            ));

                                            if (!empty($claims_terms) && !is_wp_error($claims_terms)) {
                                                foreach ($claims_terms as $term) : ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input claims-filter" type="checkbox" value="<?php echo esc_attr($term->slug); ?>" id="claim-<?php echo esc_attr($term->slug); ?>" data-name="<?php echo esc_attr($term->name); ?>">
                                                        <label class="form-check-label" for="claim-<?php echo esc_attr($term->slug); ?>">
                                                            <?php echo esc_html($term->name); ?> [<?php echo $term->count; ?>]
                                                        </label>
                                                    </div>
                                            <?php endforeach;
                                            } else {
                                                echo '<div class="text-muted small">No claims available</div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Certifications Filter -->
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Certifications</label>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" id="certificationsDropdown" aria-expanded="false">
                                            <span id="certificationsLabel">All Certifications</span>
                                        </button>
                                        <div class="dropdown-menu p-3" style="min-width: 300px; width: 100%;">
                                            <?php
                                            $certification_terms = get_terms(array(
                                                'taxonomy' => 'certification',
                                                'hide_empty' => true,
                                                'orderby' => 'name',
                                                'order' => 'ASC'
                                            ));

                                            if (!empty($certification_terms) && !is_wp_error($certification_terms)) {
                                                foreach ($certification_terms as $term) : ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input certifications-filter" type="checkbox" value="<?php echo esc_attr($term->slug); ?>" id="cert-<?php echo esc_attr($term->slug); ?>" data-name="<?php echo esc_attr($term->name); ?>">
                                                        <label class="form-check-label" for="cert-<?php echo esc_attr($term->slug); ?>">
                                                            <?php echo esc_html($term->name); ?> [<?php echo $term->count; ?>]
                                                        </label>
                                                    </div>
                                            <?php endforeach;
                                            } else {
                                                echo '<div class="text-muted small">No certifications available</div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reset Button -->
                                <div class="col-md-1">
                                    <label class="form-label fw-bold">&nbsp;</label>
                                    <button class="btn btn-outline-danger w-100" id="resetFilters" title="Reset all filters"><i class="bi bi-x-circle"></i> Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Results Header -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div id="resultsCount" class="text-muted">Loading...</div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center gap-2">
                                <label for="sortBy" class="form-label fw-bold mb-0 text-nowrap">Sort By</label>
                                <select class="form-select form-select-sm" id="sortBy">
                                    <option value="name-asc">Name (A-Z)</option>
                                    <option value="name-desc">Name (Z-A)</option>
                                    <option value="date-desc">Newest First</option>
                                    <option value="date-asc">Oldest First</option>
                                </select>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm active" id="gridView">
                                    Grid
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" id="listView">
                                    List
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading Spinner -->
            <div class="row">
                <div class="col-12">
                    <div id="loadingSpinner" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Results Grid -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4" id="ingredientsGrid" style="display: none;">
                <!-- Will be populated by JavaScript -->
            </div>

            <!-- No Results Message -->
            <div class="row">
                <div class="col-12">
                    <div id="noResults" class="alert alert-info" style="display: none;">
                        <h4 class="alert-heading">No ingredients found</h4>
                        <p>Try adjusting your filters or search terms.</p>
                    </div>
                </div>
            </div>
        </div>

        <script>
            jQuery(document).ready(function($) {
                // Dropdown toggle
                $(document).on('click', '.dropdown > button', function(e) {
                    e.stopPropagation();
                    const $menu = $(this).siblings('.dropdown-menu');
                    const isOpen = $menu.hasClass('show');
                    $('.dropdown-menu.show').removeClass('show');
                    $('[aria-expanded="true"]').attr('aria-expanded', 'false');
                    if (!isOpen) {
                        $menu.addClass('show');
                        $(this).attr('aria-expanded', 'true');
                    }
                });
                $(document).on('click', '.dropdown-menu', function(e) {
                    e.stopPropagation();
                });
                $(document).on('click', function() {
                    $('.dropdown-menu.show').removeClass('show');
                    $('[aria-expanded="true"]').attr('aria-expanded', 'false');
                });

                let allIngredients = [];
                let filteredIngredients = [];
                let currentView = 'grid'; // Track current view mode

                // Fetch all ingredients
                function fetchIngredients() {
                    $('#loadingSpinner').show();
                    $('#ingredientsGrid').hide();

                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'POST',
                        data: {
                            action: 'get_ingredients_filter_demo',
                            nonce: '<?php echo wp_create_nonce('filter_demo_nonce'); ?>'
                        },
                        success: function(response) {
                            if (response.success) {
                                allIngredients = response.data;
                                filteredIngredients = allIngredients;
                                applyFilters();
                            }
                            $('#loadingSpinner').hide();
                        },
                        error: function() {
                            $('#loadingSpinner').hide();
                            $('#noResults').show();
                        }
                    });
                }

                // Apply filters and sorting
                function applyFilters() {
                    const searchTerm = $('#ingredientSearch').val().toLowerCase();
                    const selectedClaims = $('.claims-filter:checked').map(function() {
                        return $(this).data('name');
                    }).get();
                    const selectedCertifications = $('.certifications-filter:checked').map(function() {
                        return $(this).data('name');
                    }).get();
                    const sortBy = $('#sortBy').val();

                    // Filter by search
                    filteredIngredients = allIngredients.filter(function(ingredient) {
                        const matchesSearch = !searchTerm ||
                            ingredient.title.toLowerCase().includes(searchTerm) ||
                            (ingredient.description && ingredient.description.toLowerCase().includes(searchTerm)) ||
                            (ingredient.excerpt && ingredient.excerpt.toLowerCase().includes(searchTerm));

                        const matchesClaims = selectedClaims.length === 0 ||
                            (ingredient.claims && ingredient.claims.some(claim => selectedClaims.includes(claim)));

                        const matchesCertifications = selectedCertifications.length === 0 ||
                            (ingredient.certifications && ingredient.certifications.some(cert => selectedCertifications.includes(cert)));

                        return matchesSearch && matchesClaims && matchesCertifications;
                    });

                    // Update available filter options
                    updateAvailableFilters();

                    // Sort
                    filteredIngredients.sort(function(a, b) {
                        switch (sortBy) {
                            case 'name-asc':
                                return a.title.localeCompare(b.title);
                            case 'name-desc':
                                return b.title.localeCompare(a.title);
                            case 'date-desc':
                                return new Date(b.date) - new Date(a.date);
                            case 'date-asc':
                                return new Date(a.date) - new Date(b.date);
                        }
                    });

                    renderResults();
                }

                // Render results
                function renderResults() {
                    const $grid = $('#ingredientsGrid');
                    $grid.empty();

                    if (filteredIngredients.length === 0) {
                        $('#noResults').show();
                        $grid.hide();
                        $('#resultsCount').text('0 ingredients found');
                        return;
                    }

                    $('#noResults').hide();
                    $grid.show();
                    $('#resultsCount').html('<strong>' + filteredIngredients.length + '</strong> ingredient' + (filteredIngredients.length !== 1 ? 's' : '') + ' found');

                    // Update grid classes based on view
                    if (currentView === 'grid') {
                        $grid.removeClass('row-cols-1').addClass('row-cols-1 row-cols-md-2 row-cols-lg-4');
                    } else {
                        $grid.removeClass('row-cols-md-2 row-cols-lg-4').addClass('row-cols-1');
                    }

                    filteredIngredients.forEach(function(ingredient) {
                        let card;

                        if (currentView === 'grid') {
                            // Grid view - compact card
                            card = `
                    <div class="col">
                        <div class="card h-100 ingredient-card">
                            ${ingredient.thumbnail ? `
                                <img src="${ingredient.thumbnail}" class="card-img-top" alt="${ingredient.title}">
                            ` : `
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <span class="text-muted">No image</span>
                                </div>
                            `}
                            <div class="card-body">
                                <h5 class="card-title">${ingredient.title}</h5>
                                ${ingredient.excerpt ? `<p class="card-text text-muted small">${ingredient.excerpt}</p>` : ''}
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="${ingredient.link}" class="btn btn-primary btn-sm w-100">Product Details</a>
                            </div>
                        </div>
                    </div>
                `;
                        } else {
                            // List view - horizontal card with more info
                            card = `
                    <div class="col">
                        <div class="card ingredient-card list-view-card mb-3">
                            <div class="row g-0">
                                <div class="col-md-2">
                                    ${ingredient.thumbnail ? `
                                        <img src="${ingredient.thumbnail}" class="img-fluid rounded-start h-100" style="object-fit: cover;" alt="${ingredient.title}">
                                    ` : `
                                        <div class="bg-light d-flex align-items-center justify-content-center h-100" style="min-height: 150px;">
                                            <span class="text-muted">No image</span>
                                        </div>
                                    `}
                                </div>
                                <div class="col-md-10">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h5 class="card-title">${ingredient.title}</h5>
                                                ${ingredient.description ? `<p class="card-text">${ingredient.description.substring(0, 250)}${ingredient.description.length > 250 ? '...' : ''}</p>` : ''}
                                                ${ingredient.claims && ingredient.claims.length > 0 ? `
                                                    <div class="mb-2">
                                                        <strong class="text-muted small">Claims: </strong>
                                                        ${ingredient.claims.slice(0, 5).join(', ')}${ingredient.claims.length > 5 ? '...' : ''}
                                                    </div>
                                                ` : ''}
                                            </div>
                                            <div class="col-md-3 d-flex align-items-center">
                                                <a href="${ingredient.link}" class="btn btn-primary w-100">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                        }

                        $grid.append(card);
                    });
                }

                // Event listeners
                $('#ingredientSearch').on('keyup', function() {
                    applyFilters();
                });

                $('.claims-filter').on('change', function() {
                    applyFilters();
                    updateClaimsLabel();
                });

                $('.certifications-filter').on('change', function() {
                    applyFilters();
                    updateCertificationsLabel();
                });

                $('#sortBy').on('change', function() {
                    applyFilters();
                });

                $('#resetFilters').on('click', function() {
                    $('#ingredientSearch').val('');
                    $('.claims-filter').prop('checked', false);
                    $('.certifications-filter').prop('checked', false);
                    $('#sortBy').val('name-asc');
                    updateClaimsLabel();
                    updateCertificationsLabel();
                    applyFilters();
                });

                // Update claims dropdown label
                function updateClaimsLabel() {
                    const selectedCount = $('.claims-filter:checked').length;
                    if (selectedCount === 0) {
                        $('#claimsLabel').text('All Claims');
                    } else if (selectedCount === 1) {
                        $('#claimsLabel').text('1 Claim Selected');
                    } else {
                        $('#claimsLabel').text(selectedCount + ' Claims Selected');
                    }
                }

                // Update certifications dropdown label
                function updateCertificationsLabel() {
                    const selectedCount = $('.certifications-filter:checked').length;
                    if (selectedCount === 0) {
                        $('#certificationsLabel').text('All Certifications');
                    } else if (selectedCount === 1) {
                        $('#certificationsLabel').text('1 Certification Selected');
                    } else {
                        $('#certificationsLabel').text(selectedCount + ' Certifications Selected');
                    }
                }

                // Update available filter options based on current results
                function updateAvailableFilters() {
                    // Count available claims and certifications in filtered results
                    const availableClaims = {};
                    const availableCertifications = {};

                    filteredIngredients.forEach(function(ingredient) {
                        // Count claims
                        if (ingredient.claims) {
                            ingredient.claims.forEach(function(claim) {
                                availableClaims[claim] = (availableClaims[claim] || 0) + 1;
                            });
                        }

                        // Count certifications
                        if (ingredient.certifications) {
                            ingredient.certifications.forEach(function(cert) {
                                availableCertifications[cert] = (availableCertifications[cert] || 0) + 1;
                            });
                        }
                    });

                    // Update claims filters
                    $('.claims-filter').each(function() {
                        const checkbox = $(this);
                        const parent = checkbox.closest('.form-check');
                        const label = parent.find('label');
                        const claimName = checkbox.data('name');
                        const count = availableClaims[claimName] || 0;
                        const isChecked = checkbox.is(':checked');

                        if (count > 0 || isChecked) {
                            parent.show();
                            checkbox.prop('disabled', false);
                            parent.css('opacity', '1');
                            label.html(claimName + ' [' + count + ']');
                        } else {
                            parent.show();
                            checkbox.prop('disabled', true);
                            parent.css('opacity', '0.4');
                            label.html(claimName + ' <span class="text-muted">[0]</span>');
                        }
                    });

                    // Update certifications filters
                    $('.certifications-filter').each(function() {
                        const checkbox = $(this);
                        const parent = checkbox.closest('.form-check');
                        const label = parent.find('label');
                        const certName = checkbox.data('name');
                        const count = availableCertifications[certName] || 0;
                        const isChecked = checkbox.is(':checked');

                        if (count > 0 || isChecked) {
                            parent.show();
                            checkbox.prop('disabled', false);
                            parent.css('opacity', '1');
                            label.html(certName + ' [' + count + ']');
                        } else {
                            parent.show();
                            checkbox.prop('disabled', true);
                            parent.css('opacity', '0.4');
                            label.html(certName + ' <span class="text-muted">[0]</span>');
                        }
                    });
                }

                // View toggle
                $('#gridView').on('click', function() {
                    if (currentView !== 'grid') {
                        currentView = 'grid';
                        $('#gridView, #listView').removeClass('active');
                        $(this).addClass('active');
                        renderResults();
                    }
                });

                $('#listView').on('click', function() {
                    if (currentView !== 'list') {
                        currentView = 'list';
                        $('#gridView, #listView').removeClass('active');
                        $(this).addClass('active');
                        renderResults();
                    }
                });

                // Initialize
                fetchIngredients();
            });
        </script>

        <style>
            .ingredient-card {
                transition: transform 0.2s, box-shadow 0.2s;
            }

            .ingredient-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }

            .card-img-top {
                height: 200px;
                object-fit: cover;
            }

            .badge {
                font-size: 0.7rem;
                margin-right: 0.25rem;
            }

            .dropdown-menu {
                max-height: 400px;
                overflow-y: auto;
            }

            /* List view specific styles */
            .list-view-card {
                margin-bottom: 1rem;
            }

            .list-view-card:hover {
                transform: translateY(-2px);
            }

            .list-view-card .card-body {
                padding: 1.5rem;
            }

            .list-view-card img {
                max-height: 200px;
            }

            /* Filter dropdown styles */
            .form-check input[type="checkbox"]:disabled {
                cursor: not-allowed;
            }

            .form-check input[type="checkbox"]:disabled+label {
                cursor: not-allowed;
                color: #999;
            }

            .dropdown-menu .form-check {
                transition: opacity 0.2s ease;
            }

            .text-muted {
                font-weight: normal;
            }

            /* =========================================
   DEMO RIBBON
   ========================================= */

            #demo-ribbon {
                position: sticky;
                top: 0;
                z-index: 9999;
                background: repeating-linear-gradient(-45deg,
                        #f59e0b,
                        #f59e0b 10px,
                        #fbbf24 10px,
                        #fbbf24 20px);
                border-bottom: 3px solid #d97706;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            }

            .demo-ribbon-inner {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.75rem;
                padding: 0.5rem 2.5rem;
                max-width: 100%;
                position: relative;
            }

            .demo-ribbon-badge {
                display: inline-block;
                background: #1e1e1e;
                color: #f59e0b;
                font-size: 0.7rem;
                font-weight: 800;
                letter-spacing: 0.15em;
                padding: 0.2rem 0.6rem;
                border-radius: 3px;
                flex-shrink: 0;
                text-transform: uppercase;
            }

            .demo-ribbon-message {
                color: #1e1e1e;
                font-size: 0.875rem;
                font-weight: 500;
                text-align: center;
                line-height: 1.4;
            }

            .demo-ribbon-message strong {
                font-weight: 700;
            }

            .demo-ribbon-close {
                position: absolute;
                right: 0.75rem;
                top: 50%;
                transform: translateY(-50%);
                background: rgba(0, 0, 0, 0.15);
                border: none;
                border-radius: 50%;
                width: 1.5rem;
                height: 1.5rem;
                font-size: 1rem;
                line-height: 1;
                cursor: pointer;
                color: #1e1e1e;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                transition: background 0.2s;
            }

            .demo-ribbon-close:hover {
                background: rgba(0, 0, 0, 0.3);
            }

            /* =========================================
   DEMO PAGE — CSS OVERRIDES
   Add page-specific overrides below.
   ========================================= */

            /* Offset sticky page header so ribbon doesn't overlap */
            .container.my-5 {
                padding-top: 1rem;
            }

            #page {
                background-color: #F5F3EF;
            }
        </style>

        <?php get_footer(); ?>