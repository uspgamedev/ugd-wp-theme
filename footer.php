	</div><!-- #content -->
	<div id="loading" class="transition" >
		<i class="rotation glyphicon glyphicon-cog"></i>
	</div>
</div><!-- #wrapper -->
<?php wp_footer(); ?>
<script>
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
</body>
</html>
