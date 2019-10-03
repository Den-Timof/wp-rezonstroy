<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rezonstroy
 */

?>

<?php
	$page_contacts = 39;
?>


<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if( is_home() ) { $bg = '__opacity-bg'; } ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
			<?php echo do_shortcode('[contact-form-7 id="5" title="Давайте поговорим"]'); ?>
    </div>
  </div>
</div>

<header class="fixed-head <?php echo $bg; ?>">
	<div class="container">
		<div class="row">
		<?php if( !is_home() ) { ?>
			<div class="col-lg-3 col-xl-3 logotype d-flex justify-content-start align-items-center">
				<a class="logotype__link" href="<?php echo site_url(); ?>">
					<picture class="logotype__src">
						<source type="image/webp" srcset="<?php echo carbon_get_theme_option( 'logotype' ) . '.webp' ?>">
						<source type="image/png" srcset="<?php echo carbon_get_theme_option( 'logotype' ) ?>">
						<img data-src="<?php echo carbon_get_theme_option( 'logotype' ) ?>" src="#" alt="" title="">
					</picture>
				</a>
			</div>
		<?php } ?>
		
		<?php if( !is_home() ) { ?>
			<div class="col-6 menu d-flex align-items-center">
		<?php } else { ?>
			<div class="col menu d-flex align-items-center">
		<?php } ?>
				<?php 
					$args = array(
						'theme_location'  => '',
						'menu'            => 'Фиксированное', 
						'container'       => 'div', 
						'container_class' => '', 
						'container_id'    => '',
						'menu_class'      => 'menu d-flex', 
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 0,
						'walker'          => '',
					);
					wp_nav_menu( $args ); 
				?>
			</div>

			<div class="d-lg-none d-xl-block col-auto"></div>

			<div class="col-lg-3 col-xl-2 contact-phone d-flex justify-content-end align-items-center">
				<a id="phone-company" class="link-2 td-none" href="tel:+"><?php echo carbon_get_post_meta( $page_contacts, 'phone' ); ?></a>
			</div>

		</div>
		<div class="row d-none hidden-rows">
			<div class="col-12">
				<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' / '); ?>
			</div>
			<div class="col-12">
				<a class="logotype__link" href="<?php echo site_url(); ?>">
					<picture class="logotype__src">
						<source type="image/webp" srcset="<?php echo carbon_get_theme_option( 'logotype' ) . '.webp' ?>">
						<source type="image/png" srcset="<?php echo carbon_get_theme_option( 'logotype' ) ?>">
						<img data-src="<?php echo carbon_get_theme_option( 'logotype' ) ?>" src="#" alt="" title="">
					</picture>
				</a>
			</div>
		</div>
	</div>
</header>


<div id="page" class="site">
	<div id="content" class="site-content">
