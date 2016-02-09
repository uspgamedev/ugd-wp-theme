
<?php $category = get_category($section_content); ?>

<div class="post-grid">
	<div class="text-center">
		<header class="intro-font big page-header">
			<?php echo $category->name; ?>
		</header>
		<div class="half-width">
			<?php echo apply_filters('no_widow', $category->description, $category->ID ); ?>
		</div>
	</div>
</div>

<?php include(locate_template('searchform.php')); ?>

<div id="query-<?php echo $section_content; ?>" class="query-container">
	<?php section_setpage_nosearch($section_content); ?>
</div>