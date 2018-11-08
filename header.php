<!DOCTYPE html>
<html lang="en">
	
<head>

	<!-- SEO -->
	<title><?php echo wp_title('-', false, 'right') . get_bloginfo('name'); ?></title>
	<meta name="description" content="" />
	<meta name="author" content="" />

	<!-- META -->
	<meta charset="UTF-8" />
	<meta http-equiv="content-language" content="en">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->

	<!-- CSS (Parent and Child, if applicable) -->
	<?php if (is_child_theme()): ?>
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/sass_compiler/server.php/main.scss" rel="stylesheet" type="text/css" />
	<?php else: ?>
	<link href="<?php echo get_template_directory_uri(); ?>/sass_compiler/server.php/main.scss" rel="stylesheet" type="text/css" />
	<?php endif; ?>

	<!-- JS (Parent) -->
	<script src="<?php echo get_template_directory_uri(); ?>/js/main.js" type="text-javascript"></script>

	<!-- Libraries (Parent) -->
	<script src="<?php echo get_template_directory_uri(); ?>/plugins/jquery.min.js"></script>

	<!-- Extra Imports (if applicable) -->
	<?php print_head_includes(); ?>

	<!-- WordPress Header -->
	<?php wp_head();?>

</head>

<body>

	<!-- Header -->
	<header>
		<div class="container">
		
			<!-- Logo -->
			<?php print_logo(); ?>

			<!-- Navigation -->
			<?php print_navigation(); ?>

			<div class="clear"></div>
		</div>
	</header>

	<!-- After Header -->
	<?php print_after_header(); ?>