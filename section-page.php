<?php

// PAGE SECTION
$page = get_post( $section_content );

?>
<div class="h-100-md">
	
	<div class="page-container">
		<article class="content-height">
			<div class="col-xs-12 img-col">
				<div class="page-img "> 
					<figure id="page-<?php echo $page->ID; ?>-img" class="img"></figure>
					<style>
						<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($page->ID), 'medium' );
						$thumburl = $thumb['0']; ?>
						#page-<?php echo $page->ID; ?>-img {
							background-image:url('<?php echo $thumburl; ?>')
						}
						<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($page->ID), 'large' );
						$thumburl = $thumb['0']; ?>
						@media (min-width: 600px) {
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
			<div class="col-xs-12 page-entry">
				<div class="container-fluid post-grid">
					<header class="page-header intro-font">
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