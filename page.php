<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rezonstroy
 */

get_header();
?>

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

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<div class="row">
					<?php if ( $parent_id = wp_get_post_parent_id( get_queried_object_id() ) ) { ?>

						<div class="d-none d-lg-block col-5 sidebar-col">
							<ul class="list-child-page">
								<?php dynamic_sidebar( 'Sidebar 2' ); ?>
							</ul>
						</div>
						<div class="d-none d-xl-block col-1"></div>
						<div class="col-12 col-lg-7 col-xl-6 content-block">

					<?php } else { ?>
						<div class="col-12 content-block">
					<?php } ?>
						<?php 
							if ( have_posts() ) {
								while ( have_posts() ) {
									the_post();
									the_content();
								}
							}
						?>
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php 
		$feedback_display = carbon_get_the_post_meta( 'feedback_display' );
		$feedback_display_2 = carbon_get_the_post_meta( 'feedback_display_2' );
		
		if( $feedback_display && !$feedback_display_2 ) { 
	?>

		<?php require get_template_directory() . '/template-parts/feedback-form-1.php'; ?>

	<?php } else if( $feedback_display && $feedback_display_2 ) { ?>

		<?php require get_template_directory() . '/template-parts/feedback-form-2.php'; ?>

	<?php } ?>

<?php
get_footer();
