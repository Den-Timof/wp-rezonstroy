<?php
/*
 * Template Name: Услуги (архив)
 * Template Post Type: page
 */
  
 get_header();  ?>

<section class="section-first-screen" style="background-image:url('<?php echo carbon_get_the_post_meta( 'bg_banner_page' ); ?>');">


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

	<section class="container">
		<div class="row">
			<div class="offset-lg-0 offset-xl-1"></div>

			<div class="col-lg-12 col-xl-10">
				<div class="excerpt-page-block">
					<?php echo wpautop( carbon_get_post_meta( get_queried_object_id(), 'page_excerpt' ) ); ?>
				</div>
			</div>
			<div class="offset-lg-0 offset-xl-1"></div>
		</div>
	</section>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">

				<div class="row">
					<?php 
						// Получаем все страницы, по которым будет проходить поиск.
						$my_wp_query = new WP_Query();

						$services_children = $my_wp_query->query(
							array(
								'post_type' => 'page',
								'posts_per_page'	=>	'-1',
								'post_parent'	=>	get_queried_object_id()
							)
						);

						foreach( $services_children as $post ) {

							$excerpt = carbon_get_the_post_meta( 'page_excerpt' );
						?>
						
						<div class="col-12 col-sm-6 col-xl-4">

							<article id="post-<?php echo $post->ID; ?>" class="post">
								<a href="<?php echo get_permalink($post->ID); ?>">
									<?php echo get_the_post_thumbnail( $post->ID, 'thumbnail2' ); ?>
									<span class="entry-content">
										<span><?php echo $post->post_title; ?></span>
										<?php if( !empty($excerpt) ) { ?><span class="service-excerpt"><?php echo $excerpt; ?></span><?php } ?>
									</span><!-- .entry-content -->
								</a>
							</article><!-- #post-<?php echo $post->ID; ?> -->
						</div>

						<?php

						}

					?>
				</div>

				<div class="row">
					<div class="offset-lg-0 offset-xl-1"></div>
					<div class="col-lg-12 col-xl-10 content-block">
						<?php 
							if ( have_posts() ) {
								while ( have_posts() ) {
									the_post();
									the_content();
								}
							}
						?>
					</div>
					<div class="offset-lg-0 offset-xl-1"></div>
				</div>

			</div>
		</main><!-- #main -->
	</div><!-- #primary -->



<?php
get_footer();