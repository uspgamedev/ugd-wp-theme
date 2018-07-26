<!DOCTYPE html>
<html>
<head>
	
	<title><?php wp_title( ' | ', true, 'right' ); ?></title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="shortcut icon" href="https://uspgamedev.org/media/logo_favicon.png" />

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
