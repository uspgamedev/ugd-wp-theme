
<?php get_header(); ?>

<?php while ( have_posts() ) { the_post(); ?>
	<div class="section col-xs-12 h-100 transition juicy single" section-type="single">
		<div class="container-fluid h-100">
			<div class="row">
				<div id="single-<?php echo $post->ID; ?>-thumbnail" class="img single-img">
					<div class="sample-img img"></div>
					<style>
						<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
						$thumburl = $thumb['0']; ?>
						#single-<?php echo $post->ID; ?>-thumbnail {
							background-image:url('<?php echo $thumburl; ?>')
						}
						<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
						$thumburl = $thumb['0']; ?>
						@media (min-width: 768px) {
							#single-<?php echo $post->ID; ?>-thumbnail {
								background-image:url('<?php echo $thumburl; ?>')
							}
						}
						<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
						$thumburl = $thumb['0']; ?>
						@media (min-width: 992px) {
							#single-<?php echo $post->ID; ?>-thumbnail {
								background-image:url('<?php echo $thumburl; ?>')
							}
						}
						<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
						$thumburl = $thumb['0']; ?>
						@media (min-width: 1200px) {
							#single-<?php echo $post->ID; ?>-thumbnail {
								background-image:url('<?php echo $thumburl; ?>')
							}
						}
					</style>
				</div>
				<div class="single-container container">
					<div class="col-md-8">
						<header class="single-header">
							<h3>
								<span class="intro"><?php the_title(); ?></span>
								<small class="hidden-md hidden-lg inline-block">
									<a title="Pular Texto" class="grey-text" href="#bottom">
										[ Pular Texto <i class="icon-right glyphicon glyphicon-arrow-down"></i> ]
									</a>
								</small>
							</h3>
						</header>
						<div class="single-content">
							<?php the_content(); ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="single-meta border-left">
								<h4 class="bold text-uppercase"><?php echo get_post_meta($post->ID, 'meta_title', true); ?></h4>
								<ul class="list-unstyled">
									<?php foreach( get_post_meta($post->ID) as $key => $value ) { ?>
										<?php if ( stripos($key, "_") !== false ) continue; ?>
										<li>
											<span class="bold"><?php echo $key ?>:</span>
											<?php echo $value[0]; ?>
										</li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="bottom"></div>
		</div>
	</div>
<?php } ?>

<?php get_footer(); ?>