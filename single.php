<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rezonstroy
 */

get_header();
?>

<?php $bg_banner_page = carbon_get_the_post_meta('bg_banner_page'); ?>

<section class="section-first-screen" style="background-image:url('<?php echo $bg_banner_page; ?>');">
		<div class="container-fluid p-0">
			
			<span class="bg-layout"></span>

			<div class="first-screen-content">
				<div class="title-row">
					<div class="container-fluid title-line">
						<div class="row">
							<div class="col-4 col p-0">
								<div class="line"></div>
							</div>
						</div>
					</div>
					<div class="container title-container">
						<div class="row">
							<div class="col-12">
								<h1 class="entry-title"><?php echo wp_title(''); ?></h1>
							</div>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="text_under_title">
								<?php echo wpautop( carbon_get_the_post_meta( 'text_under_title' ) ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
	</section>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container content-container">
				<div class="row">
					<div class="col-12 col-lg-5 content-block">
						<?php 
							if ( have_posts() ) {
								while ( have_posts() ) {
									the_post();
									the_content();
								}
							}
						?>
					</div>
					<div class="col-12 col-lg-7 slider-block">
						<div class="slider-for">
							<?php
								$project_portfolio_gallery = carbon_get_the_post_meta('project_portfolio_gallery');
								$project_portfolio_gallery_video = carbon_get_the_post_meta('project_portfolio_gallery_video');

								if ( ! empty( $project_portfolio_gallery_video ) ): ?>
									<?php foreach ( $project_portfolio_gallery_video as $tr ): ?>
										<div class="slide video-slide">
											<td><?php echo $tr['project_video_link'] ?></td>
										</div>
									<?php endforeach; ?>
								<?php endif;
								
								foreach( $project_portfolio_gallery as $project_image_id ) {
									?>
										<div class="slide">
											<picture>
												<source type="image/webp" srcset="<?php echo wp_get_attachment_image_src( $project_image_id, 'full' )[0] . '.webp' ?>">
												<source type="image/png" srcset="<?php echo wp_get_attachment_image_src( $project_image_id, 'full' )[0] ?>">
												<img data-src="<?php echo wp_get_attachment_image_src( $project_image_id, 'full' )[0] ?>" src="#" alt="" title="">
											</picture>
										</div>
									<?php
								}
							?>
						</div>

					</div>
				</div>
			</div>

			<div class="container-fluid slider-nav-container">
				<div class="row">
					<div class="col-12">
						<div class="slider-nav">
							<?php if ( ! empty( $project_portfolio_gallery_video ) ): ?>
								<?php foreach ( $project_portfolio_gallery_video as $tr ): ?>
									<div class="slide">
										<td><?php echo $tr['project_video_link'] ?></td>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
							
							<?php
								$project_portfolio_gallery = carbon_get_the_post_meta('project_portfolio_gallery');
							
								foreach( $project_portfolio_gallery as $project_image_id ) {
									?>
										<div class="slide">
											<picture>
												<source type="image/webp" srcset="<?php echo wp_get_attachment_image_src( $project_image_id, 'full' )[0] . '.webp' ?>">
												<source type="image/png" srcset="<?php echo wp_get_attachment_image_src( $project_image_id, 'full' )[0] ?>">
												<img data-src="<?php echo wp_get_attachment_image_src( $project_image_id, 'full' )[0] ?>" src="#" alt="" title="">
											</picture>
										</div>
									<?php
								}
							?>
						</div>
					</div>
				</div>
			</div>

			<div class="container post-navigation-container">
				<div class="row">
					<div class="col-12">
						<?php

							$prev_post = get_previous_post();
							$next_post = get_next_post();

							// След./Пред. Пост.
							$post_nav = get_the_post_navigation( array(
								'screen_reader_text'	=> '<span>Все работы</span>',
								'next_text' => '<span class="meta-nav" aria-hidden="true">Следующий проект<span class="post-title">' . $next_post->post_title . '</span></span>',
								'prev_text' => '<span class="meta-nav" aria-hidden="true">Предыдущий проект<span class="post-title">' . $prev_post->post_title . '</span></span>',
								'in_same_term' => true,
								'taxonomy ' => 'category',
							) );
							echo $post_nav;
						?>
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
