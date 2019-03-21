<?php

// Site Function Includes
if (file_exists('pw_site/functions.php')) include('pw_site/functions.php');

// Base Function Includes
include('pw_includes/functions.php');

?>

<!DOCTYPE html>
<html>
<head>

	<!-- SEO Information -->
	<title><?= getPageTitle($pages, $page) ?></title>
	<meta name="description" content="<?= getPageSeoDescription($pages, $page) ?> " />

	<!-- META -->
	<meta http-equiv="content-language" content="en">
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->

	<!-- Base Libraries -->
	<link rel="stylesheet" type="text/css" href="<?= $config->urls->templates; ?>plugins/fontawesome/css/all.min.css" />
	<script src="<?= $config->urls->templates; ?>plugins/jquery.min.js" type="text/javascript"></script>

	<!-- Site CSS (includes Base CSS) -->
	<link rel="stylesheet" type="text/css" href="<?= $config->urls->templates?>sass_compiler/server.php/site.scss" />

	<!-- Base JS -->
	<script src="<?= $config->urls->templates; ?>js/main.js" type="text/javascript"></script>

	<!-- Site Includes -->
	<?php include("pw_site/head.php"); ?>

</head>
<body class="<?= getBodyClass($page) ?>">

	<!-- Site Header -->
	<?php include("pw_site/site-header.php"); ?>