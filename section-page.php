<?php

// PAGE SECTION
$page = get_post( $section_content );

?>
<div class="h-100-md">
	
	<div class="page-container">
		<article class="content-height">
			<div class="col-md-6 img-col">
				<div class="page-img "> 
					<figure id="page-<?php echo $page->ID; ?>-img" class="img"></figure>
					<style>
						<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($page->ID), 'thumbnail' );
						$thumburl = $thumb['0']; ?>
						#page-<?php echo $page->ID; ?>-img {
							background-image:url('<?php echo $thumburl; ?>')
						}
						<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($page->ID), 'medium' );
						$thumburl = $thumb['0']; ?>
						@media (min-width: 768px) {
							#page-<?php echo $page->ID; ?>-img {
								background-image:url('<?php echo $thumburl; ?>')
							}
						}
						<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($page->ID), 'large' );
						$thumburl = $thumb['0']; ?>
						@media (min-width: 992px) {
							#page-<?php echo $page->ID; ?>-img {
								background-image:url('<?php echo $thumburl; ?>')
							}
						}
						<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($page->ID), 'full' );
						$thumburl = $thumb['0']; ?>
						@media (min-width: 1200px) {
							#page-<?php echo $page->ID; ?>-img {
								background-image:url('<?php echo $thumburl; ?>')
							}
						}
					</style>
				</div>
			</div>
			<div class="col-md-6 page-entry content-height scrollable">
				<div class="container-fluid">
					<header class="page-header intro">
						<h3><?php echo $page->post_title; ?></h3>
					</header>
					<div class="page-content">
						<?php echo $page->post_content; ?>
					</div>
				</div>
			</div>
		</article>
	</div>
</div>