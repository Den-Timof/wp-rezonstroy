<?php
/**
 * rezonstroy functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rezonstroy
 */

if ( ! function_exists( 'rezonstroy_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rezonstroy_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on rezonstroy, use a find and replace
		 * to change 'rezonstroy' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'rezonstroy', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'rezonstroy' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/**
		 * New thumb size
		 */
		add_image_size( 'thumbnail2', 400, 400, true, array( 'center', 'center' ) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'rezonstroy_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'rezonstroy_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rezonstroy_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'rezonstroy_content_width', 640 );
}
add_action( 'after_setup_theme', 'rezonstroy_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rezonstroy_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'rezonstroy' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'rezonstroy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'rezonstroy_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function rezonstroy_scripts() {

	// plugins
	wp_enqueue_style('wp-pagenavi', plugins_url('wp-pagenavi/pagenavi-css.css'), false, '2.50', 'all');
	wp_enqueue_style( 'wp-block-library' );
	wp_enqueue_style('contact-form-7', plugins_url('contact-form-7/includes/css/styles.css'), false, '2.50', 'all');


	// themes
	// wp_enqueue_style( 'rezonstroy-style', get_stylesheet_uri() );
	wp_enqueue_style( 'rezonstroy-style', get_template_directory_uri() . '/style.min.css' );
	wp_enqueue_style( 'rezonstroy-libs', get_template_directory_uri() . '/assets/css/min/libs.min.css' );
	// wp_enqueue_style( 'rezonstroy-fonts', get_template_directory_uri() . '/assets/css/min/fonts.min.css' );

	// wp_enqueue_style( 'rezonstroy-bootstrap-custom', get_template_directory_uri() . '/assets/css/min/bootstrap-custom.min.css' );
	wp_enqueue_style( 'rezonstroy-bootstrap-grid', get_template_directory_uri() . '/assets/css/min/bootstrap-grid.min.css' );

	// wp_enqueue_style( 'rezonstroy-fancybox', get_template_directory_uri() . '/assets/plugins/fancybox/dist/jquery.fancybox.min.css' );
	// wp_enqueue_style( 'rezonstroy-slick', get_template_directory_uri() . '/assets/plugins/slick-carousel/slick/slick.min.css' );
	// wp_enqueue_style( 'rezonstroy-twentytwenty', get_template_directory_uri() . '/assets/plugins/twentytwenty-master/css/twentytwenty.min.css' );
	wp_enqueue_style( 'rezonstroy-cookcodesmenu', get_template_directory_uri() . '/assets/plugins/cookcodesmenu/Mobile-Multi-Level-Menu-jQuery-cookcodesmenu/cookcodesmenu.min.css' );

	wp_enqueue_style( 'rezonstroy-custom', get_template_directory_uri() . '/assets/css/min/custom.min.css' );

	wp_enqueue_script( 'rezonstroy-libs-js', get_template_directory_uri() . '/assets/js/libs.min.js', array(), null, true );
	// wp_enqueue_script( 'rezonstroy-util-js', get_template_directory_uri() . '/assets/js/util.min.js', array(), null, true );
	wp_enqueue_script( 'rezonstroy-modal-js', get_template_directory_uri() . '/assets/js/modal.min.js', array(), null, true );
	// wp_enqueue_script( 'rezonstroy-fancybox', get_template_directory_uri() . '/assets/plugins/fancybox/dist/jquery.fancybox.min.js', array(), null, true );
	wp_enqueue_script( 'rezonstroy-cookcodesmenu', get_template_directory_uri() . '/assets/plugins/cookcodesmenu/Mobile-Multi-Level-Menu-jQuery-cookcodesmenu/jquery.cookcodesmenu.min.js', array(), null, true );

	if( is_single() ) {
		wp_enqueue_script( 'rezonstroy-slick', get_template_directory_uri() . '/assets/plugins/slick-carousel/slick/slick.min.js', array(), null, true );
	}
	
	if( is_home() ) {
		// wp_enqueue_script( 'rezonstroy-sticky-kit', get_template_directory_uri() . '/assets/plugins/sticky-kit/dist/sticky-kit.min.js', array(), null, true );
		// wp_enqueue_script( 'rezonstroy-scrollIt', get_template_directory_uri() . '/assets/plugins/scrollIt/scrollIt.min.js', array(), null, true );
		wp_enqueue_script( 'rezonstroy-concat', get_template_directory_uri() . '/assets/js/concat.js', array(), null, true );
	}

	wp_enqueue_script( 'rezonstroy-main', get_template_directory_uri() . '/assets/js/main.min.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'rezonstroy_scripts' );

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

/**
 * Carbon Fields.
 */
require get_template_directory() . '/inc/carbon-fields.php';

/**
 * Breadcrumbs
 */
require get_template_directory() . '/inc/breadcrumbs.php';

// /**
//  * Ajax
//  */
require get_template_directory() . '/assets/ajax/ajax-btn-more/ajax-btn-more.php';

// Переносим jQuery в подвал
function starter_scripts() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
	wp_enqueue_script( 'jquery' );

	// wp_enqueue_style( 'starter-style', get_stylesheet_uri() );
	// wp_enqueue_script( 'includes', get_template_directory_uri() . '/js/min/includes.min.js', '', '', true );
}
add_action( 'wp_enqueue_scripts', 'starter_scripts' );

// Отключаем jquery-migrate.min.js
function isa_remove_jquery_migrate( &$scripts ) {
	if( !is_admin() ) {
		$scripts->remove( 'jquery' );
		$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.12.4' );
	}
}
add_filter( 'wp_default_scripts', 'isa_remove_jquery_migrate' );

// Отключаем файлы CSS
add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
function my_deregister_styles() {
	wp_deregister_style( 'wp-pagenavi' );
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'contact-form-7' );
}

// Регистрация jQuery
add_action( 'wp_enqueue_scripts', 'jquery_script_method' );
function jquery_script_method() {
	wp_deregister_script( 'apc_jquery_cookie' );
	wp_deregister_script( 'abc_script' );
	// wp_deregister_script( 'contact-form-7' );
} 


// Перемещаем все скрипты в подвал
// if(!is_admin()){
// 	remove_action('wp_head', 'wp_print_scripts');
// 	remove_action('wp_head', 'wp_print_head_scripts', 9);
// 	remove_action('wp_head', 'wp_enqueue_scripts', 1);
	
// 	add_action('wp_footer', 'wp_print_scripts', 5);
// 	add_action('wp_footer', 'wp_enqueue_scripts', 5);
// 	add_action('wp_footer', 'wp_print_head_scripts', 5);
// }