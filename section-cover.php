<?php

// COVER SECTION

?>
<div class="vert-algn">
	<div class="entry-thumb">
		<div class="img logo" style="background-image: url('<?php header_image(); ?>');"></div>
	</div>
</div>
<footer id="colophon" class="white-text">
	<div class="container">
		<div class="row text-center small">
			<div class="col-xs-12">
				<ul class="list-unstyled">
					<li><?php echo sprintf( __( '%1$s %2$s %3$s. All Rights Reserved.', 'UGD' ), '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); ?></li>
					<li><?php echo sprintf( __( ' Theme By: %1$s.', 'UGD' ), '<a class="greenlue-text" href="http://github.com/orenjiakira">W. Akira</a>' ); ?></li>
				</ul>
			</div>
		</div>
	</div>
</footer>