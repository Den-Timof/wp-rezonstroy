<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rezonstroy
 */

if ( ! is_active_sidebar( 'ThemeWidgetExample' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'ThemeWidgetExample' ); ?>
</aside><!-- #secondary -->
