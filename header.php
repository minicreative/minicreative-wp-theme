<!DOCTYPE html>
<html lang="en">
	
<head>

	<!-- META -->
	<meta charset="UTF-8" />
	<meta http-equiv="content-language" content="en">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- SEO -->
	<title><?php echo wp_title('-', false, 'right') . get_bloginfo('name'); ?></title>
	<meta name="description" content="" />
	<meta name="author" content="" />

	<!-- CSS (Parent & Child) -->
	<?php if (is_child_theme()): ?>
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/sass_compiler/server.php/main.scss" rel="stylesheet" type="text/css" />
	<?php else: ?>
	<link href="<?php echo get_template_directory_uri(); ?>/sass_compiler/server.php/main.scss" rel="stylesheet" type="text/css" />
	<?php endif; ?>

	<!-- JS (Parent & Child) -->
	<script src="<?php echo get_template_directory_uri(); ?>/js/main.js" type="text-javascript"></script>
	<?php if (is_child_theme()): ?>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/main.js" type="text-javascript"></script>
	<?php endif; ?>

	<!-- Library Imports -->
	<script src="<?php echo get_template_directory_uri(); ?>/plugins/jquery.min.js"></script>
	<!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->

	<!-- WordPress Header -->
	<?php wp_head();?>

</head>

<body>

	<!-- Site Header -->
	<header>
		<div class="container">
		
			<!-- Logo -->
			<?php print_logo(); ?>

			<!-- Navigation -->
			<?php print_navigation(); ?>

			<div class="clear"></div>
		</div>
	</header>