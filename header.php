<!DOCTYPE html>
<html>
<head>
	
	<title><?php wp_title( ' | ', true, 'right' ); ?></title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/_assets/fonts/intro_webfont/stylesheet.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,900,900italic' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/_assets/css/normalize.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/_assets/libs/bootstrap/css/bootstrap.min.css">	
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
	<div id="wrapper" class="transition dark black-xs white-text">
		<!-- Navbar -->
		<?php get_template_part('navbar'); ?>

		<!-- Content -->
		<div id="content" class="transition dark">