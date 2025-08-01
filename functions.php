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
	wp_enqueue_style( 'slick-nav', get_template_directory_uri() . '/css/slicknav.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/all.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/custom.css', array(), _S_VERSION );
	wp_style_add_data( 'circuitwise-style', 'rtl', 'replace' );

	wp_enqueue_script( 'jquery' );
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
		'keywords'          => array('title', 'headline', 'header'),
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
		'keywords'          => array('title', 'headline', 'header'),
	));
}

if ( function_exists('acf_register_block_type') ) {
	add_action('acf/init', 'register_acf_block_types');
}