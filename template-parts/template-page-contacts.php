<?php
/*
 * Template Name: Контакты
 * Template Post Type: page
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
						<div class="col-5">
							<div class="text_under_title">
								<?php echo carbon_get_the_post_meta( 'text_under_title' ); ?>
							</div>
						</div>
					</div>
					<div class="row contacts-data">
						<div class="col-12 col-md-9 col-lg-8 col-xl-6 mb-5">
							<a href="tel:+" class="phone"><?php echo carbon_get_the_post_meta( 'phone' ); ?></a>
						</div>
						<div class="col-md-3 col-lg-2 col-xl-2">
							<a href="#" class="contactus" data-toggle="modal" data-target="#exampleModal">Связаться <br> с нами</a>
						</div>
						<div class="d-none d-md-block offset-lg-1 offset-xl-4"></div>
						<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
							<span class="city-address"><?php echo carbon_get_the_post_meta( 'address' ); ?></span>
						</div>
						<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
							<span class="email"><?php echo carbon_get_the_post_meta( 'email' ); ?></span>
							<span class="worktime"><?php echo carbon_get_the_post_meta( 'worktime' ); ?></span>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>

	<div id="map"></div>

<?php
get_footer();

