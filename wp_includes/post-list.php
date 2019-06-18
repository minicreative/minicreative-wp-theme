<?php

	// Get posts layout from customizer
	$posts_layout = get_theme_mod('minicreative_posts_layout');

	// Open columns
	echo "<div class='columns";
	if ($posts_layout == "masonry") echo " bricks";
	else echo " stacked";
	echo "'>";

	// Loop posts
	while (have_posts()) {
		the_post();

		// Open column
		echo "<div class='column";
		if ($posts_layout == "default") echo " full";
		else echo " third";
		echo "'>";

		// Display post preview
		print_post_preview();

		// Close column
		echo "</div>";
	}

	// Close columns
	echo "</div>";

	// Print pagination
	echo get_custom_posts_pagination();
?>