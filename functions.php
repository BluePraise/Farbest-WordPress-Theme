<?php
/**
 * farbest functions and definitions
 *
 * @package farbest
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'farbest_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function farbest_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on farbest, use a find and replace
	 * to change 'farbest' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'farbest', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'farbest' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'farbest_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // farbest_setup
add_action( 'after_setup_theme', 'farbest_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function farbest_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'farbest' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'farbest_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function farbest_scripts() {
	wp_enqueue_style( 'farbest-style', get_stylesheet_uri() );

	wp_enqueue_script( 'farbest-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'farbest-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'farbest_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


// Fix 28px Admin Bar problem
/*
function hide_wp_admin_bar(){ return false; }
add_filter( 'show_admin_bar' , 'hide_wp_admin_bar');
*/

// widgets

function jquery_accordion_widgets_init() {

	register_sidebar( array(
		'name'          => 'JQuery Accordion Menu',
		'id'            => 'ingredient_menu_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'jquery_accordion_widgets_init' );

function footer_widget1_init() {

	register_sidebar( array(
		'name'          => 'Footer Left',
		'id'            => 'footer_left',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
	) );

}
add_action( 'widgets_init', 'footer_widget1_init' );

function footer_widget2_init() {

	register_sidebar( array(
		'name'          => 'Footer Center',
		'id'            => 'footer_center',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
	) );

}
add_action( 'widgets_init', 'footer_widget2_init' );

function footer_widget3_init() {

	register_sidebar( array(
		'name'          => 'Footer Right',
		'id'            => 'footer_right',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
	) );

}
add_action( 'widgets_init', 'footer_widget3_init' );

//year format shortcode
function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');

// CPTS

// FARBEST PRODUCTS
function wpt_product_posttype() {
	register_post_type( 'products',
		array(
			'labels' => array(
				'name' => __( 'Products' ),
				'singular_name' => __( 'Product' ),
				'add_new' => __( 'Add New Product' ),
				'add_new_item' => __( 'Add New Product' ),
				'edit_item' => __( 'Edit Product' ),
				'new_item' => __( 'Add New Product' ),
				'view_item' => __( 'View Product' ),
				'search_items' => __( 'Search Product' ),
				'not_found' => __( 'No products found' ),
				'not_found_in_trash' => __( 'No products found in trash' )
			),
			'public' => true,
			'supports' => array( 'title','tags'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "products"), // Permalinks format
			'menu_position' => 100,
			'menu_icon' => 'dashicons-book-alt'
		)
	);
}
add_action( 'init', 'wpt_product_posttype' );
// Add the Meta Box
function add_products_meta_box() {
    add_meta_box(
        'products_meta_box', // $id
        'Products Meta Box', // $title 
        'show_products_meta_box', // $callback
        'products', // $page
        'normal', // $context
        'high'); // $priority
}
add_action('add_meta_boxes', 'add_products_meta_box');
// Field Array
$prefix = 'products_';
$products_meta_fields = array(
     array(
        'label'=> 'Description',
        'desc'  => 'Product description.',
        'id'    => $prefix.'description',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Categories',
        'desc'  => 'The category of the product.',
        'id'    => $prefix.'categories',
        'type'  => 'checkbox_group',
        'options' => array (
			'1' => array (
				'label' => 'Ascorbic Acid',
				'value' => 'ascorbic_acid'),
			'2' => array (
				'label' => 'Beta-carotene',
				'value' => 'beta_carotene'),
			'3' => array (
				'label' => 'Calcium Ascorbate',
				'value' => 'calcium_ascorbate'),	
			'4' => array (
				'label' => 'Calcium Caseinate',
				'value' => 'calcium_caseinate'),	
			'5' => array (
				'label' => 'Calcium d-Pantothenate',
				'value' => 'calcium_d_pantothenate	'),
			'6' => array (
				'label' => 'Casein',
				'value' => 'caseinonly'),	
			'7' => array (
				'label' => 'Colostrum',
				'value' => 'colostrum'),
			'8' => array (
				'label' => 'Crystalline Fructose',
				'value' => 'crystalline_fructose'),
			'9' => array (
				'label' => 'Cyanocobalamin',
				'value' => 'cyanocobalamin'),
			'10' => array (
				'label' => 'd-Biotin',
				'value' => 'd_biotin'),
			'11 '=> array (
				'label' => 'Fibers - Organic',
				'value' => 'fibers'),
			'12' => array (
				'label' => 'Food Ingredients - Organic',
				'value' => 'food_ingredients'),
			'13' => array (
				'label' => 'Folic Acid',
				'value' => 'folic_acid'),
			'14' => array (
				'label' => 'Fruits & Fruit Powders',
				'value' => 'fruits_&_fruit_powders'),
			'15' => array (
				'label' => 'Gum Acacia',
				'value' => 'gum_acaciaonly'),
			'16' => array (
				'label' => 'Gum Acacia - Organic',
				'value' => 'gum_acacia_organic'),
			'17' => array (
				'label' => 'Hydrolysates',
				'value' => 'hydrolysates'),
			'18' => array (
				'label' => 'Juice & Concentrates - Organic',
				'value' => 'juice_&_concentrates'),
			'19' => array (
				'label' => 'Lactoferrin',
				'value' => 'lactoferrin'),
			'20' => array (
				'label' => 'Lactoperoxidase',
				'value' => 'lactoperoxidase'),
			'21' => array (
				'label' => 'Lutein',
				'value' => 'lutein'),
			'22' => array (
				'label' => 'Lycopene',
				'value' => 'lycopene'),
			'23'=> array (
				'label' => 'Methylcobalamin',
				'value' => 'methylcobalamin'),
			'24' => array (
				'label' => 'Milk Protein',
				'value' => 'milk_protein'),
			'25' => array (
				'label' => 'Monk Fruit',
				'value' => 'monk_fruit'),
			'26' => array (
				'label' => 'Niacin',
				'value' => 'niacinonly'),
			'27' => array (
				'label' => 'Niacinamide',
				'value' => 'niacinamide'),
			'28' => array (
				'label' => 'Nutrient Premixes & Blends',
				'value' => 'nutrient_premixes_&_blends'),
			'29' => array (
				'label' => 'Pea Protein',
				'value' => 'pea_protein'),
			'30' => array (
				'label' => 'Plant Proteins - Organic',
				'value' => 'plant_proteins'),
			'31' => array (
				'label' => 'Polydextrose',
				'value' => 'polydextrose'),
			'32' => array (
				'label' => 'Pyridoxine',
				'value' => 'pyridoxine'),
			'33' => array (
				'label' => 'Riboflavin',
				'value' => 'riboflavin'),
			'34' => array (
				'label' => 'Rice Protein',
				'value' => 'rice_protein'),
			'35' => array (
				'label' => 'Sodium Ascorbate',
				'value' => 'sodium_ascorbate'),
			'36' => array (
				'label' => 'Sodium Caseinate',
				'value' => 'sodium_caseinate'),
			'37' => array (
				'label' => 'Soy Protein',
				'value' => 'soy_protein'),
			'38' => array (
				'label' => 'Specialty Caseinate',
				'value' => 'specialty'),
			'39' => array (
				'label' => 'Supplements',
				'value' => 'supplements'),
			'40' => array (
				'label' => 'Sweeteners',
				'value' => 'sweeteners'),
			'41' => array (
				'label' => 'Thiamine',
				'value' => 'thiamine'),
			'42' => array (
				'label' => 'Vitamin A',
				'value' => 'vitamin_a'),
			'43' => array (
				'label' => 'Vitamin D',
				'value' => 'vitamin_d'),
			'44' => array (
				'label' => 'Vitamin E',
				'value' => 'vitamin_e'),
			'45' => array (
				'label' => 'Vitamin K',
				'value' => 'vitamin_k'),
			'46' => array (
				'label' => 'Whey Protein',
				'value' => 'whey_protein'),
			'47' => array (
				'label' => 'Weighting Agents',
				'value' => 'weighting_agents'),
			'48' => array (
				'label' => 'Pea Protein NGPV',
				'value' => 'pea_protein_ngpv'),
			'49' => array (
				'label'	=> 'Gum Acacia NGPV',
				'value' => 'gum_acacia_ngpv'),
			'50' => array (
				'label' => 'Soy Protein NGPV',
				'value' => 'soy_protein_ngpv'),
			'51' => array (
				'label'	=> 'Lecithin NGPV',
				'value' => 'lecithins_ngpv'),
			'52' => array (
				'label'	=> 'Sweeteners NGPV',
				'value' => 'sweeteners_ngpv'),
			'53' => array (
				'label'	=> 'Fiber NGPV',
				'value' => 'fiber_ngpv'),
			'54' => array (
				'label'	=> 'Dairy Protein NGPV',
				'value' => 'dairy_protein_ngpv'),
			'55' => array (
				'label'	=> 'Omega-3 Fish Oil',
				'value' => 'omega_3_fish_oil'),
			'56' => array (
				'label'	=> 'Lecithin',
				'value' => 'lecithin'),
			'57' => array (
				'label'	=> 'Sweeteners Organic',
				'value' => 'sweeteners_organic')
        )
    ),
    array(
        'label'=> 'Applications',
        'desc'  => 'Proven applications separated by "|" symbols.',
        'id'    => $prefix.'applications',
        'type'  => 'textarea'
    ),
    array(
        'label'=> 'Packaging',
        'desc'  => 'Packaging details.',
        'id'    => $prefix.'packaging',
        'type'  => 'textarea'
    ),
    array(
        'label'=> 'Order',
        'desc'  => 'Display order on category page.',
        'id'    => $prefix.'order',
        'type'  => 'text'
    )
);
// The Callback
function show_products_meta_box() {
global $products_meta_fields, $post;
// Use nonce for verification
echo '<input type="hidden" name="products_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
// Begin the field table and loop
    echo '<table class="form-table">';
    foreach ($products_meta_fields as $field) {
        // get value of this field if it exists for this post
        $meta = get_post_meta($post->ID, $field['id'], true);
        // begin a table row with
        echo '<tr>
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                <td>';
                switch($field['type']) {
                    // case items will go here
                    // text
				case 'text':
					echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
						<br /><span class="description">'.$field['desc'].'</span>';
				break;   
					// checkbox_group
				case 'checkbox_group':
					echo '<table style="width:100%"><tr><td style="width:50%">';
					$i = 1;
					foreach ($field['options'] as $option) {
						echo '<input type="checkbox" value="'.$option['value'].'" name="'.$field['id'].'[]" id="'.$option['value'].'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' /> 
								<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
						if ($i == 21) {echo '</td><td style="width:50%">';}
						$i++;
					}
					echo '</td></tr></table>';
					echo '<span class="description">'.$field['desc'].'</span>';
				break;
				// textarea
				case 'textarea':
					echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
						<br /><span class="description">'.$field['desc'].'</span>';
				break;
								} //end switch
						echo '</td></tr>';
					} // end foreach
					echo '</table>'; // end table
				}
// Save the Data
function save_products_meta($post_id) {
    global $products_meta_fields;     
    // verify nonce
if (!isset($_POST['products_meta_box_nonce']) || !wp_verify_nonce($_POST['products_meta_box_nonce'], basename(__FILE__))) 
        return $post_id;
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
    }
         // loop through fields and save the data
    foreach ($products_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach
}
add_action('save_post', 'save_products_meta');

// TAXONOMIES

add_action( 'init', 'create_product_taxonomies', 0 );

function create_product_taxonomies() {
	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Claims', 'taxonomy general name' ),
		'singular_name'              => _x( 'Label Claim', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Claims' ),
		'popular_items'              => __( 'Popular Claims' ),
		'all_items'                  => __( 'All Claims' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Claim' ),
		'update_item'                => __( 'Update Claim' ),
		'add_new_item'               => __( 'Add New Claim' ),
		'new_item_name'              => __( 'New Claim Name' ),
		'separate_items_with_commas' => __( 'Separate claims with commas' ),
		'add_or_remove_items'        => __( 'Add or remove claims' ),
		'choose_from_most_used'      => __( 'Choose from the most used claim' ),
		'not_found'                  => __( 'No claims found.' ),
		'menu_name'                  => __( 'Claims' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'claim' ),
		'meta_box_cb'		=> false,
	);

	register_taxonomy( 'claim', 'products', $args );

	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Certifications', 'taxonomy general name' ),
		'singular_name'              => _x( 'Certification', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Certifications' ),
		'popular_items'              => __( 'Popular Certifications' ),
		'all_items'                  => __( 'All Certifications' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Certification' ),
		'update_item'                => __( 'Update Certification' ),
		'add_new_item'               => __( 'Add New Certification' ),
		'new_item_name'              => __( 'New Certification Name' ),
		'separate_items_with_commas' => __( 'Separate certifications with commas' ),
		'add_or_remove_items'        => __( 'Add or remove certifications' ),
		'choose_from_most_used'      => __( 'Choose from the most used certifications' ),
		'not_found'                  => __( 'No certifications found.' ),
		'menu_name'                  => __( 'Certifications' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'certification' ),
		'meta_box_cb'		=> false,
	);

	register_taxonomy( 'certification', 'products', $args );
}

// HOMEPAGE
function wpt_homepage_posttype() {
	register_post_type( 'homepage',
		array(
			'labels' => array(
				'name' => __( 'Homepage' ),
				'singular_name' => __( 'Homepage' ),
				'add_new' => __( 'Add New Homepage' ),
				'add_new_item' => __( 'Add New Homepage' ),
				'edit_item' => __( 'Edit Homepage' ),
				'new_item' => __( 'Add New Homepage' ),
				'view_item' => __( 'View Homepage' ),
				'search_items' => __( 'Search Homepage' ),
				'not_found' => __( 'No homepage found' ),
				'not_found_in_trash' => __( 'No homepage found in trash' )
			),
			'public' => true,
			'supports' => array( 'title','tags'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "homepage"), // Permalinks format
			'menu_position' => 100,
			'menu_icon' => 'dashicons-book-alt'
		)
	);
}
add_action( 'init', 'wpt_homepage_posttype' );
// Add the Meta Box
function add_homepage_meta_box() {
    add_meta_box(
        'homepage_meta_box', // $id
        'Homepage Meta Box', // $title 
        'show_homepage_meta_box', // $callback
        'homepage', // $page
        'normal', // $context
        'high'); // $priority
}
add_action('add_meta_boxes', 'add_homepage_meta_box');
// Field Array
$prefix = 'homepage_';
$homepage_meta_fields = array(
     array(
        'label'=> 'Logo',
        'desc'  => 'Logo at top of homepage',
        'id'    => $prefix.'logo',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Header Image',
        'desc'  => 'Image in header background',
        'id'    => $prefix.'bkgd_img',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Headline',
        'desc'  => 'Image in header background',
        'id'    => $prefix.'headline',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'First Blue Block Headline',
        'desc'  => 'First blue block headline',
        'id'    => $prefix.'fbb_headline',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'First Blue Block Content',
        'desc'  => 'First blue block content',
        'id'    => $prefix.'fbb_content',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'First Blue Block Button',
        'desc'  => 'First blue block button',
        'id'    => $prefix.'fbb_button',
        'type'  => 'text'
    ),
     array(
        'label'=> 'First Blue Block Button Link',
        'desc'  => 'First blue block button link',
        'id'    => $prefix.'fbb_button_link',
        'type'  => 'text'
    ),
     array(
        'label'=> 'First CTA Headline',
        'desc'  => 'First CTA headline',
        'id'    => $prefix.'fcta_headline',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'First CTA Content',
        'desc'  => 'First CTA content',
        'id'    => $prefix.'fcta_content',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'First CTA Footnote',
        'desc'  => 'First CTA footnote',
        'id'    => $prefix.'fcta_footnote',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'First CTA Button',
        'desc'  => 'First CTA button',
        'id'    => $prefix.'fcta_button',
        'type'  => 'text'
    ),
     array(
        'label'=> 'First CTA Button Link',
        'desc'  => 'First CTA button link',
        'id'    => $prefix.'fcta_button_link',
        'type'  => 'text'
    ),
    array(
        'label'=> 'Second Blue Block Headline',
        'desc'  => 'Second blue block headline',
        'id'    => $prefix.'sbb_headline',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Second Blue Block Content',
        'desc'  => 'Second blue block content',
        'id'    => $prefix.'sbb_content',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Second Blue Block Left Button',
        'desc'  => 'Second blue block button',
        'id'    => $prefix.'sbbl_button',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Second Blue Block Left Content',
        'desc'  => 'Second blue block content',
        'id'    => $prefix.'sbbl_content',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Second Blue Block Center Button',
        'desc'  => 'Second blue block center button',
        'id'    => $prefix.'sbbc_button',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Second Blue Block Center Content',
        'desc'  => 'Second blue block center content',
        'id'    => $prefix.'sbbc_content',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Second Blue Block Right Button',
        'desc'  => 'Second blue block right button',
        'id'    => $prefix.'sbbr_button',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Second Blue Block Right Content',
        'desc'  => 'Second blue block right content',
        'id'    => $prefix.'sbbr_content',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Second CTA Headline',
        'desc'  => 'Second CTA headline',
        'id'    => $prefix.'scta_headline',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Second CTA Content',
        'desc'  => 'Second CTA content',
        'id'    => $prefix.'scta_content',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Second CTA Button',
        'desc'  => 'Second CTA button',
        'id'    => $prefix.'scta_button',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Second CTA Button Link',
        'desc'  => 'Second CTA button link',
        'id'    => $prefix.'scta_button_link',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Partners Headline',
        'desc'  => 'Partners headline',
        'id'    => $prefix.'partners_headline',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Partners Content',
        'desc'  => 'Partners content',
        'id'    => $prefix.'partners_content',
        'type'  => 'textarea'
    )
);
// The Callback
function show_homepage_meta_box() {
global $homepage_meta_fields, $post;
// Use nonce for verification
echo '<input type="hidden" name="homepage_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
// Begin the field table and loop
    echo '<table class="form-table">';
    foreach ($homepage_meta_fields as $field) {
        // get value of this field if it exists for this post
        $meta = get_post_meta($post->ID, $field['id'], true);
        // begin a table row with
        echo '<tr>
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                <td>';
                switch($field['type']) {
                    // case items will go here
                    // text
				case 'text':
					echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
						<br /><span class="description">'.$field['desc'].'</span>';
				break;   
					// textarea
				case 'textarea':
					echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
						<br /><span class="description">'.$field['desc'].'</span>';
				break;
								} //end switch
						echo '</td></tr>';
					} // end foreach
					echo '</table>'; // end table
				}
// Save the Data
function save_homepage_meta($post_id) {
    global $homepage_meta_fields;     
    // verify nonce
if (!isset($_POST['homepage_meta_box_nonce']) || !wp_verify_nonce($_POST['homepage_meta_box_nonce'], basename(__FILE__))) 
        return $post_id;
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
    }
         // loop through fields and save the data
    foreach ($homepage_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach
}
add_action('save_post', 'save_homepage_meta');

// WAREHOUSING
function wpt_warehousing_posttype() {
	register_post_type( 'warehousing',
		array(
			'labels' => array(
				'name' => __( 'Warehousing' ),
				'singular_name' => __( 'Warehousing' ),
				'add_new' => __( 'Add New Warehousing' ),
				'add_new_item' => __( 'Add New Warehousing' ),
				'edit_item' => __( 'Edit Warehousing' ),
				'new_item' => __( 'Add New Warehousing' ),
				'view_item' => __( 'View Warehousing' ),
				'search_items' => __( 'Search Warehousing' ),
				'not_found' => __( 'No warehousing found' ),
				'not_found_in_trash' => __( 'No warehousing found in trash' )
			),
			'public' => true,
			'supports' => array( 'title','tags'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "warehousing"), // Permalinks format
			'menu_position' => 100,
			'menu_icon' => 'dashicons-book-alt'
		)
	);
}
add_action( 'init', 'wpt_warehousing_posttype' );
// Add the Meta Box
function add_warehousing_meta_box() {
    add_meta_box(
        'warehousing_meta_box', // $id
        'Warehousing Meta Box', // $title 
        'show_warehousing_meta_box', // $callback
        'warehousing', // $page
        'normal', // $context
        'high'); // $priority
}
add_action('add_meta_boxes', 'add_warehousing_meta_box');
// Field Array
$prefix = 'warehousing_';
$warehousing_meta_fields = array(
     array(
        'label'=> 'Logo',
        'desc'  => 'Logo at top of Warehousing Page',
        'id'    => $prefix.'logo',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Header Image',
        'desc'  => 'Image in header background',
        'id'    => $prefix.'bkgd_img',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Headline',
        'desc'  => 'Image in header background',
        'id'    => $prefix.'headline',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'First White Row Headline',
        'desc'  => 'First white row headline',
        'id'    => $prefix.'fwr_headline',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'First White Row Content',
        'desc'  => 'First white row content',
        'id'    => $prefix.'fwr_content',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Second White Row Headline',
        'desc'  => 'Second white row headline',
        'id'    => $prefix.'swr_headline',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Second White Row Content',
        'desc'  => 'Second white row content',
        'id'    => $prefix.'swr_content',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Left Box Headline',
        'desc'  => 'Left box headline',
        'id'    => $prefix.'lb_headline',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Left Box Content',
        'desc'  => 'Left box content',
        'id'    => $prefix.'lb_content',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Center Box Headline',
        'desc'  => 'Center box headline',
        'id'    => $prefix.'cb_headline',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Center Box Content',
        'desc'  => 'Center box content',
        'id'    => $prefix.'cb_content',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Right Box Headline',
        'desc'  => 'Right box headline',
        'id'    => $prefix.'rb_headline',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Right Box Content',
        'desc'  => 'Right box content',
        'id'    => $prefix.'rb_content',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'CTA Headline',
        'desc'  => 'CTA headline',
        'id'    => $prefix.'cta_headline',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'CTA Content',
        'desc'  => 'CTA content',
        'id'    => $prefix.'cta_content',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'CTA Button',
        'desc'  => 'CTA button',
        'id'    => $prefix.'cta_button',
        'type'  => 'text'
    ),
     array(
        'label'=> 'CTA Button Link',
        'desc'  => 'CTA button link',
        'id'    => $prefix.'cta_button_link',
        'type'  => 'text'
    )
);
// The Callback
function show_warehousing_meta_box() {
global $warehousing_meta_fields, $post;
// Use nonce for verification
echo '<input type="hidden" name="warehousing_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
// Begin the field table and loop
    echo '<table class="form-table">';
    foreach ($warehousing_meta_fields as $field) {
        // get value of this field if it exists for this post
        $meta = get_post_meta($post->ID, $field['id'], true);
        // begin a table row with
        echo '<tr>
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                <td>';
                switch($field['type']) {
                    // case items will go here
                    // text
				case 'text':
					echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
						<br /><span class="description">'.$field['desc'].'</span>';
				break;   
					// textarea
				case 'textarea':
					echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
						<br /><span class="description">'.$field['desc'].'</span>';
				break;
								} //end switch
						echo '</td></tr>';
					} // end foreach
					echo '</table>'; // end table
				}
// Save the Data
function save_warehousing_meta($post_id) {
    global $warehousing_meta_fields;     
    // verify nonce
if (!isset($_POST['warehousing_meta_box_nonce']) || !wp_verify_nonce($_POST['warehousing_meta_box_nonce'], basename(__FILE__))) 
        return $post_id;
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
    }
         // loop through fields and save the data
    foreach ($warehousing_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach
}
add_action('save_post', 'save_warehousing_meta');

// STAFF
function wpt_staff_posttype() {
	register_post_type( 'staff',
		array(
			'labels' => array(
				'name' => __( 'Staff' ),
				'singular_name' => __( 'Staff' ),
				'add_new' => __( 'Add New Staff' ),
				'add_new_item' => __( 'Add New Staff' ),
				'edit_item' => __( 'Edit Staff' ),
				'new_item' => __( 'Add New Staff' ),
				'view_item' => __( 'View Staff' ),
				'search_items' => __( 'Search Staff' ),
				'not_found' => __( 'No staff found' ),
				'not_found_in_trash' => __( 'No staff found in trash' )
			),
			'public' => true,
			'supports' => array( 'title','tags'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "staff"), // Permalinks format
			'menu_position' => 100,
			'menu_icon' => 'dashicons-book-alt'
		)
	);
}
add_action( 'init', 'wpt_staff_posttype' );
// Add the Meta Box
function add_staff_meta_box() {
    add_meta_box(
        'staff_meta_box', // $id
        'Staff Meta Box', // $title 
        'show_staff_meta_box', // $callback
        'staff', // $page
        'normal', // $context
        'high'); // $priority
}
add_action('add_meta_boxes', 'add_staff_meta_box');
// Field Array
$prefix = 'staff_';
$staff_meta_fields = array(
     array(
        'label'=> 'Sort Order',
        'desc'  => 'Team member position',
        'id'    => $prefix.'order',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Image',
        'desc'  => 'Team member photo',
        'id'    => $prefix.'image',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Phone',
        'desc'  => 'Team member phone (format: xxx-xxx-xxxx)',
        'id'    => $prefix.'phone',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Email',
        'desc'  => 'Team member email',
        'id'    => $prefix.'email',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Linkedin',
        'desc'  => 'Team member LinkedIn ID (eg. 79743046)',
        'id'    => $prefix.'linkedin',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Fullname',
        'desc'  => 'Team member full name',
        'id'    => $prefix.'fullname',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Title',
        'desc'  => 'Team member title',
        'id'    => $prefix.'title',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Quote',
        'desc'  => 'Team member quote (no quotation marks... already there)',
        'id'    => $prefix.'quote',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Bio',
        'desc'  => 'Team member bio',
        'id'    => $prefix.'bio',
        'type'  => 'textarea'
    )
);
// The Callback
function show_staff_meta_box() {
global $staff_meta_fields, $post;
// Use nonce for verification
echo '<input type="hidden" name="staff_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
// Begin the field table and loop
    echo '<table class="form-table">';
    foreach ($staff_meta_fields as $field) {
        // get value of this field if it exists for this post
        $meta = get_post_meta($post->ID, $field['id'], true);
        // begin a table row with
        echo '<tr>
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                <td>';
                switch($field['type']) {
                    // case items will go here
                    // text
				case 'text':
					echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
						<br /><span class="description">'.$field['desc'].'</span>';
				break;   
					// textarea
				case 'textarea':
					echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
						<br /><span class="description">'.$field['desc'].'</span>';
				break;
								} //end switch
						echo '</td></tr>';
					} // end foreach
					echo '</table>'; // end table
				}
// Save the Data
function save_staff_meta($post_id) {
    global $staff_meta_fields;     
    // verify nonce
if (!isset($_POST['staff_meta_box_nonce']) || !wp_verify_nonce($_POST['staff_meta_box_nonce'], basename(__FILE__))) 
        return $post_id;
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
    }
         // loop through fields and save the data
    foreach ($staff_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach
}
add_action('save_post', 'save_staff_meta');

// PARTNERS
function wpt_partners_posttype() {
	register_post_type( 'partners',
		array(
			'labels' => array(
				'name' => __( 'Partners' ),
				'singular_name' => __( 'Partners' ),
				'add_new' => __( 'Add New Partners' ),
				'add_new_item' => __( 'Add New Partners' ),
				'edit_item' => __( 'Edit Partners' ),
				'new_item' => __( 'Add New Partners' ),
				'view_item' => __( 'View Partners' ),
				'search_items' => __( 'Search Partners' ),
				'not_found' => __( 'No partners found' ),
				'not_found_in_trash' => __( 'No partners found in trash' )
			),
			'public' => true,
			'supports' => array( 'title','tags'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "partners"), // Permalinks format
			'menu_position' => 100,
			'menu_icon' => 'dashicons-book-alt'
		)
	);
}
add_action( 'init', 'wpt_partners_posttype' );
// Add the Meta Box
function add_partners_meta_box() {
    add_meta_box(
        'partners_meta_box', // $id
        'Partners Meta Box', // $title 
        'show_partners_meta_box', // $callback
        'partners', // $page
        'normal', // $context
        'high'); // $priority
}
add_action('add_meta_boxes', 'add_partners_meta_box');
// Field Array
$prefix = 'partners_';
$partners_meta_fields = array(
     array(
        'label'=> 'Sort Order',
        'desc'  => 'Partner position',
        'id'    => $prefix.'order',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Logo',
        'desc'  => 'Partner logo',
        'id'    => $prefix.'logo',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Company',
        'desc'  => 'Partner compnay name',
        'id'    => $prefix.'company',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Description',
        'desc'  => 'Partner compnay description',
        'id'    => $prefix.'desc',
        'type'  => 'textarea'
    ),
     array(
        'label'=> 'Link',
        'desc'  => 'Link to partner comapny website',
        'id'    => $prefix.'website',
        'type'  => 'text'
    )
);
// The Callback
function show_partners_meta_box() {
global $partners_meta_fields, $post;
// Use nonce for verification
echo '<input type="hidden" name="partners_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
// Begin the field table and loop
    echo '<table class="form-table">';
    foreach ($partners_meta_fields as $field) {
        // get value of this field if it exists for this post
        $meta = get_post_meta($post->ID, $field['id'], true);
        // begin a table row with
        echo '<tr>
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                <td>';
                switch($field['type']) {
                    // case items will go here
                    // text
				case 'text':
					echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
						<br /><span class="description">'.$field['desc'].'</span>';
				break;   
					// textarea
				case 'textarea':
					echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
						<br /><span class="description">'.$field['desc'].'</span>';
				break;
								} //end switch
						echo '</td></tr>';
					} // end foreach
					echo '</table>'; // end table
				}
// Save the Data
function save_partners_meta($post_id) {
    global $partners_meta_fields;     
    // verify nonce
if (!isset($_POST['partners_meta_box_nonce']) || !wp_verify_nonce($_POST['partners_meta_box_nonce'], basename(__FILE__))) 
        return $post_id;
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
    }
         // loop through fields and save the data
    foreach ($partners_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach
}
add_action('save_post', 'save_partners_meta');

// CHANGE ENTER TITLE HERE

function wpb_change_title_text( $title ){
     $screen = get_current_screen();
 
     if  ( 'products' == $screen->post_type ) {
          $title = 'Enter product name';
     }
 
     return $title;
}
 
add_filter( 'enter_title_here', 'wpb_change_title_text' );

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return '<div style="text-align:center"><a class="moretag" style="color:#5f9732;" href="'. get_permalink($post->ID) . '"> [... more]</a></div>';
}
add_filter('excerpt_more', 'new_excerpt_more');

//sort taxonomy archives

add_action( 'pre_get_posts', 'my_change_sort_order'); 
    function my_change_sort_order($query){
        if(is_archive()):
         //If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
           //Set the order ASC or DESC
           $query->set( 'order', 'ASC' );
           //Set the orderby
           $query->set( 'orderby', 'title' );
        endif;    
    };
    
// custom post nav to stay in category

function custom_nav(){
	$navigation = '';
	$previous   = get_previous_post_link( '<div class="nav-previous">HERE%link</div>', '%title', true );
	$next       = get_next_post_link( '<div class="nav-next">%link</div>', '%title', true );

	// Only add markup if there's somewhere to navigate to.
	if ( $previous || $next ) {
		$navigation = _navigation_markup( $previous . $next, 'post-navigation' );
	}

	echo $navigation;
}

add_filter('pre_get_posts', 'posts_in_category');

function posts_in_category($query){
    if ($query->is_category) {
        if (is_category(18)) {
            $query->set('posts_per_page', 4);
        }
    }
}
/***
 * ACF CUSTOMIZATION
 */

function my_acf_json_save_point($path)
{
	// update path
	$path = get_stylesheet_directory() . '/acf-json';

	// return
	return $path;
}

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
/**/