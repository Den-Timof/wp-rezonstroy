<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package rezonstroy
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function rezonstroy_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'rezonstroy_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function rezonstroy_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'rezonstroy_pingback_header' );



// *********************************************

/**
 * add-featured-thumbnail-to-admin-post-page-columns
 */
if (function_exists( 'add_theme_support' )){
	add_filter('manage_posts_columns', 'posts_columns', 5);
	add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
	add_filter('manage_pages_columns', 'posts_columns', 5);
	add_action('manage_pages_custom_column', 'posts_custom_columns', 5, 2);
}

function posts_columns($columns){
	$my_columns = [
		'thumb' => 'Миниатюра',
	];

	return array_slice( $columns, 1, 1 ) + $my_columns + $columns;
}

function posts_custom_columns($column_name, $id){
	if($column_name === 'thumb'){
		echo the_post_thumbnail( 'thumbnail' );
	}
}

// Добавляем стили для зарегистрированных колонок. Необязательно.
add_action( 'admin_print_footer_scripts-edit.php', function () {
	?>
	<style>
		.column-thumb {
			width: 150px;
		}

		.column-thumb img {
			max-width: 100%;
			height: auto;
		}
	</style>
	<?php
} );