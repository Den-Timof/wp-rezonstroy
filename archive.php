<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rezonstroy
 */

get_header();
?>

	<section class="section-first-screen" style="background-image:url('<?php echo carbon_get_term_meta( get_queried_object_id(), 'bg_image_by_category' ); ?>');">
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
								<?php echo wpautop( carbon_get_term_meta( get_queried_object_id(), 'text_under_title_by_category' ) ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
	</section>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<div class="container archive-container">
			<?php

				$cat_name = get_cat_name( get_queried_object_id() );

				$terms = get_terms(array(
					'taxonomy'	=>	'category',
					'number'		=>	1,
					'name'			=>	$cat_name,
				));
	
				$category_slug = $terms[0]->slug;
				$category = get_category_by_slug( $category_slug );
				$category_id = $category->cat_ID;
				$count_post = $category->category_count;
				
				
			?>
			<div class="row archive-row" data-archivecount="<?php echo $count_post; ?>" data-archivename="<?php echo $cat_name; ?>">
				<?php
					$paged = get_query_var( 'paged', 1 );
					$archive_count = carbon_get_theme_option('archive_'.$category_slug.'_count');
					$query = new WP_Query(array(
						'category_name'		=> $category_slug,
						'posts_per_page'	=> $archive_count,
						'paged'						=> $paged,
					));
					// var_dump($query);
				?>
				<?php if ( have_posts() ) : ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

					// the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			</div>

			<div class="row pagination-row">
				<div class="col-12">
					<button class="btn-more-ajax m-auto btn btn-general _green _small">Смотреть ещё</button>
				</div>
			</div>
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
