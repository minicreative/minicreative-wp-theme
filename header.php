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
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->

	<!-- CSS (Parent and Child, if applicable) -->
	<?php if (is_child_theme()): ?>
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/sass_compiler/server.php/main.scss" rel="stylesheet" type="text/css" />
	<?php else: ?>
	<link href="<?php echo get_template_directory_uri(); ?>/sass_compiler/server.php/main.scss" rel="stylesheet" type="text/css" />
	<?php endif; ?>

	<!-- Libraries (Parent) -->
	<script src="<?php echo get_template_directory_uri(); ?>/plugins/jquery.min.js"></script>
	<link href="<?php echo get_template_directory_uri(); ?>/plugins/fontawesome/css/all.min.css" rel="stylesheet" type="text/css" />

	<!-- JS (Parent) -->
	<script src="<?php echo get_template_directory_uri(); ?>/js/main.js" type="text/javascript"></script>

	<!-- Extra Imports (if applicable) -->
	<?php print_head_includes(); ?>

	<!-- WordPress Header -->
	<?php wp_head();?>

</head>

<body>

	<?php print_site_header(); ?>

	<?php print_page_header(); ?>