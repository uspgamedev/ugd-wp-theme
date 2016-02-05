<?php

$post = $cat_query->post;

?>

<article class="post col-xs-12 col-sm-6 col-md-4 h-50 ">
	<a href="<?php echo get_post_permalink( $post->ID ); ?>" class="post-permalink">
		<div class="post-thumb">
			<div class="sample-img img"></div>
			<div id="post-<?php echo $post->ID; ?>-thumbnail" class="img"></div>
			<style>

			<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
			$thumburl = $thumb['0']; ?>
			#post-<?php echo $post->ID; ?>-thumbnail {
				background-image:url('<?php echo $thumburl; ?>')
			}
			<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
			$thumburl = $thumb['0']; ?>
			@media (min-width: 768px) {
				#post-<?php echo $post->ID; ?>-thumbnail {
					background-image:url('<?php echo $thumburl; ?>')
				}
			}
			<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
			$thumburl = $thumb['0']; ?>
			@media (min-width: 992px) {
				#post-<?php echo $post->ID; ?>-thumbnail {
					background-image:url('<?php echo $thumburl; ?>')
				}
			}
			<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
			$thumburl = $thumb['0']; ?>
			@media (min-width: 1200px) {
				#post-<?php echo $post->ID; ?>-thumbnail {
					background-image:url('<?php echo $thumburl; ?>')
				}
			}

			</style>
		</div>
		<header class="post-header text-center h-10">
			<?php the_title(); ?>
		</header>
	</a>
</article>
