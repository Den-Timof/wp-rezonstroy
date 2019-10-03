<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rezonstroy
 */

?>

<?php
	$page_contacts = 39;
?>

	</div><!-- #content -->

</div><!-- #page -->

<footer class="footer" style="background-image:url('<?php echo carbon_get_theme_option('bg_footer_section'); ?>');">

		<div class="footer-layer-bg"></div>

		<div class="container footer-container">
			<div class="row footer-row">
				<div class="order-2 order-lg-1 col-lg-4 col-xl-6 footer-col-left">
					<a class="logotype__link" href="<?php echo site_url(); ?>">
						<picture class="logotype__src">
							<source type="image/webp" srcset="<?php echo carbon_get_theme_option( 'logotype' ) . '.webp' ?>">
							<source type="image/png" srcset="<?php echo carbon_get_theme_option( 'logotype' ) ?>">
							<img data-src="<?php echo carbon_get_theme_option( 'logotype' ) ?>" src="#" alt="" title="">
						</picture>
					</a>
					<p class="site-description _text-white"><?php echo get_bloginfo('description'); ?></p>
				</div>
				<div class="order-1 order-lg-2 col-lg-4 d-xl-none d-flex footer-feedback position-relative justify-content-center align-items-center flex-column text-center">
					<p class="_text-white feedback-title">Остались вопросы?</p>
					<p class="_text-white feedback-text">Наш менеджер ответит на них в течение одного часа</p>
					<button class="btn btn-general" data-toggle="modal" data-target="#exampleModal">Бесплатная консультация</button>
				</div>
				<div class="order-3 order-lg-3 col-lg-4 col-xl-6 footer-col-right justify-content-lg-start justify-content-xl-center">
					<p class="address-wrap">
						<?php echo carbon_get_post_meta( $page_contacts, 'address' ); ?>
					</p>
					<a class="text-right link-2 td-none" href="tel:+"><?php echo carbon_get_post_meta( $page_contacts, 'phone' ); ?></a>
				</div>
			</div>
		</div>
		
		<div class="line"></div>

		<div class="container">
			<div class="row footer-row _2">
				<div class="col-12 col-lg-6"><p><?php echo carbon_get_theme_option('text_footer_under_line_1'); ?></p></div>
				<div class="col-12 col-lg-6">
					<a href="<?php echo carbon_get_theme_option('text_footer_develop_link'); ?>" target="_blank" class="float-right text-center text-lg-right"><?php echo carbon_get_theme_option('text_footer_under_line_2'); ?></a>
				</div>
			</div>
		</div>

		<div class=" d-none d-xl-flex footer-feedback justify-content-center align-items-center flex-column text-center" style="background-image:url('<?php echo carbon_get_theme_option('bg_footer_section'); ?>');">
			<div class="footer-layer-bg"></div>
			<p class="_text-white feedback-title"><?php echo carbon_get_theme_option('footer_title_form'); ?></p>
			<p class="_text-white feedback-text"><?php echo carbon_get_theme_option('footer_text_form'); ?></p>
			<button class="btn btn-general" data-toggle="modal" data-target="#exampleModal">
				<?php echo carbon_get_theme_option('footer_btntext_form'); ?>
			</button>
		</div>

	</footer>

	<input type="hidden" name="siteUrl" value="<?php echo site_url(); ?>">

<?php wp_footer(); ?>

</body>
</html>
