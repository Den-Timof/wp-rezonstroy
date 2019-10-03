<?php

if( !defined( 'ABSPATH' ) ) {
	exit;
}



add_action( 'wp_enqueue_scripts', 'my_scripts_method', 11 );
function my_scripts_method() {
	/**
	 * Enqueue ajax btn more
	 */
	if( is_archive() ) {
		wp_enqueue_script( 'ajax-btn-more', get_template_directory_uri() . '/assets/ajax/ajax-btn-more/ajax-btn-more.js', array(), null, true );
		wp_localize_script('ajax-btn-more', 'btn_more_ajax', array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('btn-more-nonce')
		));
	}
}

/**
 * Ajax query
 */
add_action('wp_ajax_btn_more_ajax', 'ajaxbtnmore_callback');
add_action('wp_ajax_nopriv_btn_more_ajax', 'ajaxbtnmore_callback');

function ajaxbtnmore_callback() {
	
	if(!wp_verify_nonce($_POST['nonce'], 'btn-more-nonce')) {
		wp_die('Данные отправлены с левого адреса');
	}

	ob_start();
	?>

	<?php

		if( !empty( $_POST['category'] ) ) {

			$terms = get_terms(array(
				'taxonomy'	=>	'category',
				'number'		=>	1,
				'name'			=>	$_POST['category'],
			));

			$category_slug = $terms[0]->slug;
			$category = get_category_by_slug( $terms[0]->slug );
			$count_post = $category->category_count;

			$diff_count = $category->category_count - $_POST['count']; 
			if( $diff_count == 0 ) {
				return false;
			}

			$archive_count = carbon_get_theme_option('archive_'.$category_slug.'_count');
			$query = new WP_Query(array(
				'category_name'		=> $terms[0]->slug,
				// 'orderby'					=> 'menu_order',
				// 'order'						=> 'ASC',
				'offset'					=> $_POST['count'],
				'posts_per_page'	=> $archive_count,
			));

			if( $query->have_posts() ) {
				while( $query->have_posts() ) {
					$query->the_post();

					?>
						<div class="col-4">
							<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
								<?php rezonstroy_post_thumbnail(); ?>
								<div class="entry-content">
									<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
								</div><!-- .entry-content -->
							</article><!-- #post-<?php the_ID(); ?> -->
						</div>
					<?php

				}
			}
			wp_reset_postdata();
		}
	?>

	<?php
	$data['btn_more'] = ob_get_clean();
	wp_send_json($data);
	wp_die();

}

