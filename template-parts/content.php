<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rezonstroy
 */

?>

<div class="col-12 col-sm-6 col-xl-4">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<a href="<?php echo get_permalink(); ?>">
			<picture>
				<source type="image/webp" srcset="<?php echo get_the_post_thumbnail_url() . '.webp' ?>">
				<source type="image/png" srcset="<?php echo get_the_post_thumbnail_url() ?>">
				<img src="#" data-src="<?php echo get_the_post_thumbnail_url() ?>" alt="" title="">
			</picture>
			<span class="entry-content">
				<span>
					<?php the_title(); ?>
				</span>
			</span><!-- .entry-content -->
		</a>
	

	</article><!-- #post-<?php the_ID(); ?> -->

</div>

