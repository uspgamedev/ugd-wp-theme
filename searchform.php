<?php global $cat_query; ?>
	
<div class="searchbar">
	<div class="col-xs-12">
		<div class="search-form">
			<input
				class="search-form-input form-control small black-text"
				type="text" 
				name="s"
				category-id="<?php echo $section_content; ?>"
				placeholder="Buscar por <?php echo $sections->post->post_title; ?>..."
				>
			<i class="search-icon black-text text-center glyphicon glyphicon-search icon"></i>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="search-results text-left row">
			<header class="search-title visible-xs-block intro-font big page-header">
				<?php echo get_category($section_content)->name; ?>
			</header>
		</div>
	</div>
</div>