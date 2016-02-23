	</div><!-- #content -->
	<div id="loading" class="transition" >
		<i class="rotation glyphicon glyphicon-cog"></i>
	</div>
</div><!-- #wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/_assets/libs/hammer/hammer.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/_assets/js/ugd.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var loading = document.getElementById('loading');
		loading.classList.add('juicy');
		var ugd_sections = SECTIONS();
		var ugd_query = QUERY();
		METAMENU();
		setTimeout(
			function() {
				loading.classList.add('hidden');
				ugd_sections.load();
				ugd_query.load();
				<?php if ( isset($_GET['section']) ) { ?>
					ugd_sections.set(<?php echo $_GET['section']; ?>);
				<?php } ?>
			},
			400
		);
	});
</script>
<?php wp_footer(); ?>
</body>
</html>