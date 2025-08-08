<?php
/**
 * circuitwise functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package circuitwise
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function circuitwise_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on circuitwise, use a find and replace
		* to change 'circuitwise' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'circuitwise', get_template_directory() . '/languages' );

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
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'circuitwise' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'circuitwise_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'circuitwise_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function circuitwise_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'circuitwise_content_width', 640 );
}
add_action( 'after_setup_theme', 'circuitwise_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function circuitwise_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'circuitwise' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'circuitwise' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'circuitwise_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function circuitwise_scripts() {
	wp_enqueue_style( 'circuitwise-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'font-style', get_template_directory_uri() . '/css/font.css', array(), _S_VERSION );
	wp_enqueue_style( 'slick-slider', get_template_directory_uri() . '/css/slick.css', array(), _S_VERSION );
	wp_enqueue_style( 'slick-nav', get_template_directory_uri() . '/css/slicknav.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/all.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/custom.css', array(), _S_VERSION );
	wp_style_add_data( 'circuitwise-style', 'rtl', 'replace' );

	wp_enqueue_script( 'jquery' );
	
	wp_enqueue_script( 'slick-slider', get_template_directory_uri() . '/js/slick.min.js', array( 'jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'slick-nav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array( 'jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'customizer-js', get_template_directory_uri() . '/js/customizer.js', array( 'jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'circuitwise-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'circuitwise_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function custom_style_formats( $init_array ) {
	// remove H1 from block format
	$init_array['block_formats'] = 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6; Preformatted=pre';

	return $init_array;
}
add_filter( 'tiny_mce_before_init', 'custom_style_formats' );

// Create custom post types
function create_custom_post_type() {

	// Resources
	$labels_resources = array(
		'name'                  => __('Resources', 'circuitwise'),
		'singular_name'         => __('Resource', 'circuitwise'),
		'menu_name'             => __('Resources', 'circuitwise'),
		'name_admin_bar'        => __('Resource', 'circuitwise'),
		'add_new'               => __('Add New', 'circuitwise'),
		'add_new_item'          => __('Add New Resource', 'circuitwise'),
		'new_item'              => __('New Resource', 'circuitwise'),
		'edit_item'             => __('Edit Resource', 'circuitwise'),
		'view_item'             => __('View Resource', 'circuitwise'),
		'all_items'             => __('All Resources', 'circuitwise'),
		'search_items'          => __('Search Resources', 'circuitwise'),
		'parent_item_colon'     => __('Parent Resources:', 'circuitwise'),
		'not_found'             => __('No resources found.', 'circuitwise'),
		'not_found_in_trash'    => __('No resources found in Trash.', 'circuitwise')
	);

	$args = array(
		'labels'                => $labels_resources,
		'public'                => true,
		'publicly_queryable'    => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_rest'          => true,
		'has_archive'           => false,
		'rewrite'               => array('slug' => 'resources'),
		'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
		'exclude_from_search'   => false,
		'menu_icon'             => 'dashicons-feedback',
		'taxonomies'            => array('resource_category'),
	);

	register_post_type('resources', $args);

	// Register 'resource_category' taxonomy
	register_taxonomy('resource_category', 'resources', array(
		'labels' => array(
			'name'              => __('Resource Categories', 'circuitwise'),
			'singular_name'     => __('Resource Category', 'circuitwise'),
			'search_items'      => __('Search Categories', 'circuitwise'),
			'all_items'         => __('All Categories', 'circuitwise'),
			'parent_item'       => __('Parent Category', 'circuitwise'),
			'parent_item_colon' => __('Parent Category:', 'circuitwise'),
			'edit_item'         => __('Edit Category', 'circuitwise'),
			'update_item'       => __('Update Category', 'circuitwise'),
			'add_new_item'      => __('Add New Category', 'circuitwise'),
			'new_item_name'     => __('New Category Name', 'circuitwise'),
			'menu_name'         => __('Categories', 'circuitwise'),
		),
		'hierarchical' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'resource-category'),
	));

}

add_action('init', 'create_custom_post_type');

function register_acf_block_types() {

	// Hero Block
	acf_register_block_type(array(
		'name'              => 'hero',
		'title'             => __('Hero Block'),
		'description'       => __('A custom hero block. This block is designed to be used only once per page to maintain proper SEO structure and prevent multiple H1 headings on the same page.'),
		'category'          => 'common',
		'icon'              => 'heading',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/hero/hero.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/hero/hero.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true,
			'multiple' => false
		),
		'keywords'          => array('title', 'headline', 'hero'),
	));

	// Split Content Block
	acf_register_block_type(array(
		'name'              => 'split-content',
		'title'             => __('Split Content Block'),
		'description'       => __('A split content block.'),
		'category'          => 'common',
		'icon'              => 'embed-photo',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/split-content/split-content.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/split-content/split-content.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true
		),
		'keywords'          => array('split', 'content', 'half'),
	));

	// Icon List Block
	acf_register_block_type(array(
		'name'              => 'icon-list',
		'title'             => __('Icon List Block'),
		'description'       => __('An icon list block.'),
		'category'          => 'common',
		'icon'              => 'ellipsis',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/icon-list/icon-list.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/icon-list/icon-list.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true
		),
		'keywords'          => array('icon', 'list'),
	));

	// Logo Slider Block
	acf_register_block_type(array(
		'name'              => 'logo-slider',
		'title'             => __('Logo Slider Block'),
		'description'       => __('A logo slider block.'),
		'category'          => 'common',
		'icon'              => 'slides',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/logo-slider/logo-slider.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/logo-slider/logo-slider.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true
		),
		'keywords'          => array('icon', 'logo', 'slider', 'carousel'),
	));

	// Two Column Grid Block
	acf_register_block_type(array(
		'name'              => 'twocol-grid',
		'title'             => __('Two Column Grid Block'),
		'description'       => __('A two column grid block.'),
		'category'          => 'common',
		'icon'              => 'grid-view',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/twocol-grid/twocol-grid.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/twocol-grid/twocol-grid.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true
		),
		'keywords'          => array('grid', '2x2', 'two'),
	));

	// Certificates Block
	acf_register_block_type(array(
		'name'              => 'certificates',
		'title'             => __('Certificates Block'),
		'description'       => __('A certificates block.'),
		'category'          => 'common',
		'icon'              => 'awards',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/certificates/certificates.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/certificates/certificates.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true
		),
		'keywords'          => array('awards', 'certificates', 'ISO'),
	));

	// Form Block
	acf_register_block_type(array(
		'name'              => 'form',
		'title'             => __('Form Block'),
		'description'       => __('A form block.'),
		'category'          => 'common',
		'icon'              => 'forms',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/form/form.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/form/form.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true
		),
		'keywords'          => array('form', 'contact'),
	));

	// CTA Block
	acf_register_block_type(array(
		'name'              => 'cta',
		'title'             => __('CTA Block'),
		'description'       => __('A cta block.'),
		'category'          => 'common',
		'icon'              => 'button',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/cta/cta.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/cta/cta.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true
		),
		'keywords'          => array('cta', 'button'),
	));

	// Image Cards Block
	acf_register_block_type(array(
		'name'              => 'image-cards',
		'title'             => __('Image Cards Block'),
		'description'       => __('An image cards block.'),
		'category'          => 'common',
		'icon'              => 'index-card',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/image-cards/image-cards.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/image-cards/image-cards.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true
		),
		'keywords'          => array('image', 'cards'),
	));

	// WYSIWYG Block
	acf_register_block_type(array(
		'name'              => 'wysiwyg',
		'title'             => __('WYSIWYG Block'),
		'description'       => __('A WYSIWYG block.'),
		'category'          => 'common',
		'icon'              => 'text',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/wysiwyg/wysiwyg.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/wysiwyg/wysiwyg.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true
		),
		'keywords'          => array('wysiwyg', 'content', 'text', 'paragraphs'),
	));

	// Logo Cards Block
	acf_register_block_type(array(
		'name'              => 'logo-cards',
		'title'             => __('Logo Cards Block'),
		'description'       => __('A logo cards block.'),
		'category'          => 'common',
		'icon'              => 'images-alt',
		'mode'              => 'edit',
		'render_template'   => get_template_directory() . '/template-parts/blocks/logo-cards/logo-cards.php',
		'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/logo-cards/logo-cards.css',
		'supports'          => array(
			'align'  => true,
			'anchor' => true,
			'mode'   => false,
			'jsx'    => true
		),
		'keywords'          => array('logo', 'cards'),
	));
}

if ( function_exists('acf_register_block_type') ) {
	add_action('acf/init', 'register_acf_block_types');
}

add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Enforce only one featured post for the "resources" custom post type.
 *
 * This function listens for ACF's save event and checks if the current post
 * has the 'is_featured' field set to true. If so, it finds all other 
 * 'resources' posts marked as featured and unsets their 'is_featured' field.
 *
 * This ensures that only one "resources" post can be marked as featured 
 * at any time.
 *
 * Requirements:
 * - ACF field named 'is_featured' (True/False field)
 * - Applied only to the 'resources' custom post type
 */
function enforce_single_featured_resource($post_id) {
	// Skip autosave and revisions
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	if (wp_is_post_revision($post_id)) return;

	// Only for the 'resources' post type
	if (get_post_type($post_id) !== 'resources') return;

	// If the current post is marked as featured
	if (get_field('is_featured', $post_id)) {
		// Find other featured posts (excluding the current one)
		$args = array(
			'post_type'      => 'resources',
			'post__not_in'   => array($post_id),
			'meta_key'       => 'is_featured',
			'meta_value'     => '1',
			'posts_per_page' => -1,
		);

		$featured_others = get_posts($args);

		// Unset 'is_featured' for all other posts
		foreach ($featured_others as $post) {
			update_field('is_featured', 0, $post->ID);
		}
	}
}
add_action('acf/save_post', 'enforce_single_featured_resource', 20);

// 1. Add a new column to the admin list
function add_featured_column_to_resources($columns) {
	$columns['is_featured'] = 'Featured';
	return $columns;
}
add_filter('manage_resources_posts_columns', 'add_featured_column_to_resources');

// 2. Populate the column content
function show_featured_column_value($column, $post_id) {
	if ($column === 'is_featured') {
		$is_featured = get_field('is_featured', $post_id); // ACF field

		if ($is_featured) {
			echo '<b style="color:red;">Yes</b>';
		} else {
			echo '<span style="color:gray;">No</span>';
		}
	}
}
add_action('manage_resources_posts_custom_column', 'show_featured_column_value', 10, 2);
