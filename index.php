<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rezonstroy
 */

get_header();

?>

	<section class="homepage-firstscreen section-first-screen" style="background-image:url('<?php echo carbon_get_theme_option('home_bg_banner'); ?>');">
		<div class="container-fluid p-0 first-screen-container">

			<span class="bg-layout"></span>

			<a href="#sec-1" class="arrow-down s-arrow-down" data-scroll-nav="1"></a>

			<div class="first-screen-content">
				<a class="logotype__link" href="<?php echo site_url(); ?>">
					<picture class="logotype__src">
						<source type="image/webp" srcset="<?php echo carbon_get_theme_option( 'logotype' ) . '.webp' ?>">
						<source type="image/png" srcset="<?php echo carbon_get_theme_option( 'logotype' ) ?>">
						<img data-src="<?php echo carbon_get_theme_option( 'logotype' ) ?>" src="#" alt="" title="">
					</picture>
				</a>
				<p class="site-description"><?php echo get_bloginfo('description'); ?></p>
				<p class="promo-text"><?php echo carbon_get_theme_option('text_home_banner_under_description'); ?></p>
				<a href="<?php echo get_page_link(40); ?>" class="btn btn-general" ><?php echo carbon_get_theme_option('text_button_home_banner'); ?></a>
			</div>
		</div>
	</section>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<div id="fullPage">
			<section class="section-services sec-1" data-scroll-index="1">
				<div class="container section-services-container">
					<div class="row">
						<div class="title-padding col-12 d-flex justify-content-center">
							<h2 class="section-title"><?php echo carbon_get_theme_option('headers_home_1'); ?></h2>
						</div>
					</div>
					<?php
						$services_association = carbon_get_theme_option('services_association');

						foreach( $services_association as $service ) {
							$post = get_post( $service['id'] );
							$post_id = $post->ID;
							
					?>
					
						<div class="row service-row">
							<div class="col-12 col-lg-6 col-xl-7 service-col service-col-thumb">
								<span class="service_thumbnail">
									<picture>
										<source type="image/webp" srcset="<?php echo get_the_post_thumbnail_url( $post_id ) . '.webp' ?>">
										<source type="image/png" srcset="<?php echo get_the_post_thumbnail_url( $post_id ) ?>">
										<img data-src="<?php echo get_the_post_thumbnail_url( $post_id ) ?>" src="#" alt="" title="">
									</picture>
								</span>
							</div>
							<div class="col-12 col-lg-6 col-xl-5 service-col service-col-content">
								<a href="<?php echo get_permalink($post_id); ?>" class="service-title"><?php echo $post->post_title; ?></a>
								<div class="service-content content">
									<?php 
										$service_content = carbon_get_post_meta( $post_id, 'page_excerpt');
										echo wpautop( $service_content ); 
									?>
								</div>
								<a href="<?php echo get_permalink($post_id); ?>" class="mt-3 service-link _link service-title">Подробнее</a>
							</div>
						</div>

					<?php
						}
					?>
				</div>
			</section>

			<div data-scroll-index="2">
				<section class="section-advantages sec-2">
					<div class="container">
						<div class="row">
							<div class="col-12 d-flex justify-content-center ">
								<h2 class="section-title"><?php echo carbon_get_theme_option('headers_home_2'); ?></h2>
							</div>
						</div>
						<div class="row justify-content-center">
							<?php 
								$arr_rezon = carbon_get_theme_option('rezon-s'); 
							
								foreach( $arr_rezon as $rezon_block ) {
									?>
										<div class="col-xs-12 col-sm-6 col-lg-3">
											<div class="advantage-block">
												<p class="advantage-text-1">
													<?php echo $rezon_block['rezon-1'] ?>
												</p>
												<p class="advantage-text-2">
													<?php echo $rezon_block['rezon-2'] ?>
												</p>
											</div>
										</div>
									<?php
								}
							?>
						</div>
					</div>
				</section>

				<?php require get_template_directory() . '/template-parts/feedback-form-2.php'; ?>
				
			</div>

			<section class="section-steps sec-4" data-scroll-index="4">
				<div class="container">
					<div class="row">
						<div class="col-12 d-flex justify-content-center ">
							<h2 class="section-title"><?php echo carbon_get_theme_option('headers_home_3'); ?></h2>
						</div>
					</div>
					<div class="section-steps-content  row justify-content-center">
						<?php 
							$arr_steps = carbon_get_theme_option('steps-works'); 
						
							foreach( $arr_steps as $steps_block ) {
								?>
									<div class="col-12 col-sm-6 col-lg-3">
										<div class="step-block">
											<p class="step-img">
												<picture>
													<source type="image/webp" srcset="<?php echo wp_get_attachment_url( $steps_block['step-image'] ) . '.webp' ?>">
													<source type="image/png" srcset="<?php echo wp_get_attachment_url( $steps_block['step-image'] ) ?>">
													<img data-src="<?php echo wp_get_attachment_url( $steps_block['step-image'] ) ?>" src="#" alt="" title="">
												</picture>
											</p>
											<p class="step-text">
												<?php echo $steps_block['step-text'] ?>
											</p>
											<span class="step-length"></span>
										</div>
									</div>
								<?php
							}
						?>
					</div>
				</div>
			</section>

			<div data-scroll-index="5">

				<section class="section-projects sec-5">
					<div class="container">
						<div class="row">
							<div class="col-12 d-flex justify-content-center ">
								<h2 class="section-title"><?php echo carbon_get_theme_option('headers_home_4'); ?></h2>
							</div>
						</div>
						<div class="row">
								<div class="col-12">
									<div id="jcImgScroll-demo" class="jcImgScroll projects-slider twentytwenty-slider">
										<ul>
											<?php
												// задаем нужные нам критерии выборки данных из БД
												$args = array(
													'posts_per_page' => -1,
													'category_name' => 'portfolio'
												);
		
												$query = new WP_Query( $args );
		
												// Цикл
												if ( $query->have_posts() ) {
													while ( $query->have_posts() ) {
														$query->the_post();
														?>
															<li class="slide">
																<a href="#" path="<?php echo carbon_get_the_post_meta('project_portfolio_before'); ?>" data-path2="<?php echo carbon_get_the_post_meta('project_portfolio_after'); ?>" title=""></a>
															</li>
														<?php
													}
												} else {
													// Постов не найдено
												}
												// Возвращаем оригинальные данные поста. Сбрасываем $post.
												wp_reset_postdata();
											?>
										</ul>
									</div>

								</div>
						</div>
						<div class="row">
							<div class="d-none d-lg-block offset-8"></div>
							<div class="col-12 col-lg-4 d-flex justify-content-end">
								<a class="link-to" href="<?php echo get_term_link( 3 ); ?>"><?php echo carbon_get_theme_option('text_button_portfolio'); ?></a>
							</div>
						</div>
					</div>
				</section>
	
				<section class="section-gallery sec-6" data-scroll-index="6">
					<div class="container-fluid">
						<div class="row gallery-wrapper">
							<?php 
								$home_media_gallery = carbon_get_theme_option('home_media_gallery');

								foreach( $home_media_gallery as $key => $gallery_item_id ) {
									?>
										<div class="col-12 col-sm-6 col-lg-4  gallery-item-col">
											<a href="<?php echo wp_get_attachment_image_src( $gallery_item_id, 'full' )[0]; ?>" class="gallery-item" data-fancybox="gallery">
												<picture>
													<source type="image/webp" srcset="<?php echo wp_get_attachment_image_src( $gallery_item_id, 'full' )[0] . '.webp' ?>">
													<source type="image/png" srcset="<?php echo wp_get_attachment_image_src( $gallery_item_id, 'full' )[0] ?>">
													<img data-src="<?php echo wp_get_attachment_image_src( $gallery_item_id, 'full' )[0] ?>" src="#" alt="" title="">
												</picture>
											</a>
										</div>
									<?php
								}
							?>
						</div>
					</div>
				</section>

			</div>

			<?php require get_template_directory() .  '/template-parts/feedback-form-1.php'; ?>

			<ul class="d-none d-lg-block menu-section" id="menuFullPage">
				<li class="active" data-menuachor="sec-1"><a href="#sec-1" data-scroll-nav="1"><span>
					<?php echo carbon_get_theme_option('headers_home_1'); ?>
				</span></a></li>
				<li data-menuachor="sec-2"><a href="#sec-2" data-scroll-nav="2"><span>
					<?php echo carbon_get_theme_option('headers_home_2'); ?>
				</span></a></li>
				<li data-menuachor="sec-4"><a href="#sec-4" data-scroll-nav="4"><span>
					<?php echo carbon_get_theme_option('headers_home_3'); ?>
				</span></a></li>
				<li data-menuachor="sec-5"> <a href="#sec-5" data-scroll-nav="5"><span>
					<?php echo carbon_get_theme_option('headers_home_4'); ?>
				</span></a></li>
			</ul>
		</div>

		<section class="section-map">
			<div id="map"></div>
		</section>



		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
