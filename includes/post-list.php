<?php
	$posts_layout = get_theme_mod('minicreative_posts_layout');
	$columns = !($posts_layout == "default");
	$masonry = ($posts_layout == "masonry");
	if ($columns) {
		echo "<div class='columns stacked";
		if ($masonry) echo " bricks";
		echo "'>";
	}
	while (have_posts()) {
		the_post();
		if ($columns) echo "<div class='column third'>";
			print_post_preview();
		if ($columns) echo "</div>";
	}
	if ($columns) echo "</div>";

	if ($posts_layout == "masonry") {
		initialize_bricks();
	}
?>