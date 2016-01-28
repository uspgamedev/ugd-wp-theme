	</div><!-- #content -->
	<footer id="colophon" class=" hidden grey-text white">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<ul class="list-unstyled">
						<li><?php echo sprintf( __( '%1$s %2$s %3$s. All Rights Reserved.', 'Horisec' ), '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); ?></li>
						<li><?php echo sprintf( __( ' Theme By: %1$s.', 'Horisec' ), '<a href="http://github.com/orenjiakira">W. Akira</a>' ); ?></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-4">

					<!-- Footer Menu -->
					<ul class="list-unstyled">
						<li><a>Forum</a></li>
						<li><a>Github</a></li>
					</ul>
					
				</div>
			</div>
		</div>
	</footer>
	<div id="loading" >
		<i class="rotation glyphicon glyphicon-cog"></i>
	</div>
</div><!-- #wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="wp-content/themes/horisec/_assets/libs/hammer/hammer.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/_assets/js/height_fix.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/_assets/js/horisec.js"></script>
<script type="text/javascript">

	$(document).ready(function() {

		// Dropdown Toggle Menu
		(function() {
			var togglers = document.getElementsByClassName('toggle-button');

			for (var i = 0; i < togglers.length; i++) {
				var togglee_class = togglers[i].getAttribute('toggle-target');
				var togglees = document.getElementsByClassName(togglee_class);

				for (var j = 0; j < togglees.length; j++) {
					(function (toggler,togglee) {
						toggler.addEventListener("click", function() {
							togglee.classList.toggle('displace');
							document.getElementById('content').classList.toggle('displace');
						});
					}(togglers[i],togglees[j]));
				};
			};

			document.getElementById('content').onclick = function() {
				document.getElementById('navigation-menu').classList.remove('displace');
				document.getElementById('content').classList.remove('displace');
			}
		}());
		jQuery('#loading').fadeOut(400);
		setTimeout(
			function() {
				horisec.setKeyControls();
				horisec.setAjaxPagination();
				horisec.update();
				fixHeight();
			},
			400);
	});
</script>
<?php wp_footer(); ?>
</body>
</html>