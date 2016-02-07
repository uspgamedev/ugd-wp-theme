<div id="searchbar" class="searchbar black">
	<div class="col-sm-6">
		<form class="search-form">
			<input class="form-control small black-text" type="text" name="s" placeholder="Buscar por...">
			<i class="search-icon black-text text-center glyphicon glyphicon-search icon"></i>
		</form>
	</div>
	<div class="col-sm-6">
		<div class="search-results text-center">
			<span class="inline-block"><?php echo __('Found', 'UGD' ) . ': ' . $cat_query->found_posts; ?> post(s)</span>
		</div>
	</div>
</div>