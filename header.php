<!DOCTYPE html>
<html>
<head>
	
	<title><?php wp_title( ' | ', true, 'right' ); ?></title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="shortcut icon" href="https://uspgamedev.org/media/logo_favicon.png" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/_assets/fonts/intro_webfont/stylesheet.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,900,900italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/_assets/css/normalize.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/_assets/libs/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">

	<!--[if IE]>
      	<style type="text/css">
			
	        @media (max-width: 767px) {
				#masthead {
					filter: Alpha(opacity=0);
	         		background: none !important;
				}
				#masthead a {
					filter: unset !important;
	         		background: transparent !important;
				}
			}

        </style>
    <![endif]-->

	<?php wp_head(); ?>
</head>
<body class="<?php foreach( get_body_class( array('black') ) as $class ) echo $class . ' '; ?>" >
	<div id="wrapper" class="transition black white-text">
		<!-- Navbar -->
		<?php get_template_part('navbar'); ?>

		<!-- Content -->
		<div id="content" class="transition dark">
