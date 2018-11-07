<!DOCTYPE html>
<html lang="en">
	
<head>

	<!-- META -->
	<meta charset="UTF-8" />
	<meta http-equiv="content-language" content="en">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- SEO -->
	<title><?php echo get_bloginfo('name'); ?></title>
	<meta name="description" content="" />
	<meta name="author" content="" />

	<!-- Base CSS -->
	<link href="<?php echo get_bloginfo('template_directory'); ?>/sass_compiler/server.php/main.scss" rel="stylesheet" type="text/css" />

	<!-- Base JS -->
	<script src="" type="text-javascript"></script>

	<!-- Library Imports -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->

	<!-- WordPress Header -->
	<?php wp_head();?>

</head>

<body>

	<!-- Site Header -->
	<header>
		<div class="container">
		
			<!-- Logo -->
			<?php
				if (get_theme_mod('minicreative_logo')) 
					echo "<img src='".get_theme_mod('minicreative_logo')."' alt='".get_bloginfo('name')."' />";
				else 
					echo "<h1>".get_bloginfo('name')."</h1>";
			?>

			<!-- Navigation -->
			<?php 
				$headerMenuConfig = array(
					'depth' => 2
				);
				if (has_nav_menu('header-menu'))
					$headerMenuConfig['theme_location'] = 'header-menu';
				wp_nav_menu($headerMenuConfig); 
			?>

		</div>
	</header>