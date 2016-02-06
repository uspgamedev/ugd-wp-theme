<?php

/*

This file requires the following variables to be set before inclusion:

$requested_post

*/

$post = get_post($requested_post);

?>

<div class="single-container row">
	<div class="single-gallery">
		<?php

		// Here we put some images
		// Don't ask me; I don't know shit
		
		?>
		<div class="img"></div>
	</div>
	<div class="single-content page-entry">
		<div class="container-fluid">
			<header class="page-header intro-font">
				<h3><?php echo $post->post_title; ?></h3>
			</header>
			<div class="page-content">
				<?php echo $post->post_content; ?>
			</div>
		</div>
	</div>
</div>