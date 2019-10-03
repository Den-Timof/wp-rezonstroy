<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package rezonstroy
 */

get_header();
?>

<section class="homepage-firstscreen section-first-screen" style="background-image:url('<?php echo carbon_get_theme_option('home_bg_banner'); ?>');">
		<div class="container-fluid p-0 first-screen-container">

			<span class="bg-layout"></span>

			<div class="first-screen-content" style="background-image:url('<?php echo get_template_directory_uri() . '/assets/img/line.png'; ?>');">
				<a class="logotype__link" href="<?php echo site_url(); ?>">
					<picture class="logotype__src">
						<source type="image/webp" srcset="<?php echo carbon_get_theme_option( 'logotype' ) . '.webp' ?>">
						<source type="image/png" srcset="<?php echo carbon_get_theme_option( 'logotype' ) ?>">
						<img data-src="<?php echo carbon_get_theme_option( 'logotype' ) ?>" src="#" alt="" title="">
					</picture>
				</a>
				<p class="site-description"><?= 'Ошибка 404. Страница не найдена' ?></p>
				<p class="promo-text"><?= 'Страница по Вашему запросу была не найдена' ?></p>
				<a href="<?php echo get_home_url(); ?>" class="btn btn-general" ><?= 'Главная страница' ?></a>
			</div>
		</div>
	</section>

<?php
get_footer();
