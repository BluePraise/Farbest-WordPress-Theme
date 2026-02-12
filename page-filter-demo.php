<?php
/**
 * Template Name: Filter Demo
 * Description: Proof of concept for ingredient filtering with Bootstrap styling
 */

get_header(); ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Ingredient Filter Demo</h1>
            <p class="lead">Filter and search through our ingredients catalog</p>

            <?php
            // Debug: Show available ingredient counts
            $products_count = wp_count_posts('products');
            $total = $products_count ? ($products_count->publish ?? 0) : 0;

            echo '<div class="alert alert-info small">';
            echo '<strong>Debug Info:</strong> ';
            echo "Found <strong>$total</strong> ingredients in the database. ";
            echo 'Categories available: <strong>' . count(get_ingredient_categories()) . '</strong>';
            echo '</div>';
            ?>

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

                        <!-- Category Filter -->
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Ingredients</label>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span id="categoryLabel">All Ingredients</span>
                                </button>
                                <div class="dropdown-menu p-3" style="min-width: 300px; width: 100%;" onclick="event.stopPropagation();">
                                    <?php
                                    $ingredient_categories = get_ingredient_categories();

                                    if (!empty($ingredient_categories)) {
                                        // Sort alphabetically by label
                                        asort($ingredient_categories);

                                        foreach ($ingredient_categories as $slug => $label) : ?>
                                            <div class="form-check">
                                                <input class="form-check-input category-filter" type="checkbox" value="<?php echo esc_attr($slug); ?>" id="cat-<?php echo esc_attr(str_replace('_', '-', $slug)); ?>">
                                                <label class="form-check-label" for="cat-<?php echo esc_attr(str_replace('_', '-', $slug)); ?>">
                                                    <?php echo esc_html($label); ?>
                                                </label>
                                            </div>
                                        <?php endforeach;
                                    } else {
                                        echo '<div class="text-muted small">No categories available</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Sort Options -->
                        <div class="col-md-3">
                            <label for="sortBy" class="form-label fw-bold">Sort By</label>
                            <select class="form-select" id="sortBy">
                                <option value="name-asc">Name (A-Z)</option>
                                <option value="name-desc">Name (Z-A)</option>
                                <option value="date-desc">Newest First</option>
                                <option value="date-asc">Oldest First</option>
                            </select>
                        </div>

                        <!-- Reset Button -->
                        <div class="col-md-2">
                            <button class="btn btn-outline-secondary w-100" id="resetFilters">Reset Filters</button>
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
jQuery(document).ready(function($) {
    let allIngredients = [];
    let filteredIngredients = [];
    let currentView = 'grid'; // Track current view mode

    // Category mapping for display
    const categoryLabels = <?php echo json_encode(get_ingredient_categories()); ?>;

    // Fetch all ingredients
    function fetchIngredients() {
        $('#loadingSpinner').show();
        $('#ingredientsGrid').hide();

        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {
                action: 'get_ingredients_filter_demo'
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
        const selectedCategories = $('.category-filter:checked').map(function() {
            return $(this).val();
        }).get();
        const sortBy = $('#sortBy').val();

        // Filter by search
        filteredIngredients = allIngredients.filter(function(ingredient) {
            const matchesSearch = !searchTerm ||
                ingredient.title.toLowerCase().includes(searchTerm) ||
                (ingredient.description && ingredient.description.toLowerCase().includes(searchTerm)) ||
                (ingredient.excerpt && ingredient.excerpt.toLowerCase().includes(searchTerm));

            const matchesCategory = selectedCategories.length === 0 ||
                ingredient.categories.some(cat => selectedCategories.includes(cat));

            return matchesSearch && matchesCategory;
        });

        // Sort
        filteredIngredients.sort(function(a, b) {
            switch(sortBy) {
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
            // Get readable category names
            const categoryBadges = ingredient.categories
                .filter(cat => categoryLabels[cat])
                .map(cat => categoryLabels[cat])
                .slice(0, 3); // Limit to 3 categories for display

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
                                ${categoryBadges.length > 0 ? `
                                    <div class="mb-2">
                                        ${categoryBadges.map(cat => `<span class="badge bg-secondary">${cat}</span>`).join(' ')}
                                        ${ingredient.categories.length > 3 ? `<span class="badge bg-secondary">+${ingredient.categories.length - 3} more</span>` : ''}
                                    </div>
                                ` : ''}
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="${ingredient.link}" class="btn btn-primary btn-sm w-100">View Details</a>
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
                                                ${categoryBadges.length > 0 ? `
                                                    <div class="mb-2">
                                                        <strong class="text-muted small">Categories: </strong>
                                                        ${categoryBadges.map(cat => `<span class="badge bg-secondary">${cat}</span>`).join(' ')}
                                                        ${ingredient.categories.length > 3 ? `<span class="badge bg-secondary">+${ingredient.categories.length - 3} more</span>` : ''}
                                                    </div>
                                                ` : ''}
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

    $('.category-filter').on('change', function() {
        applyFilters();
        updateCategoryLabel();
    });

    $('#sortBy').on('change', function() {
        applyFilters();
    });

    $('#resetFilters').on('click', function() {
        $('#ingredientSearch').val('');
        $('.category-filter').prop('checked', false);
        $('#sortBy').val('name-asc');
        updateCategoryLabel();
        applyFilters();
    });

    // Update category dropdown label
    function updateCategoryLabel() {
        const selectedCount = $('.category-filter:checked').length;
        if (selectedCount === 0) {
            $('#categoryLabel').text('All Categories');
        } else if (selectedCount === 1) {
            $('#categoryLabel').text('1 Category Selected');
        } else {
            $('#categoryLabel').text(selectedCount + ' Categories Selected');
        }
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
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
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

#categoryDropdown {
    text-align: left;
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
</style>

<?php get_footer(); ?>
