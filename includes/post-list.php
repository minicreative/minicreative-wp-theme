<?php
	echo "<div class='columns'>";
	while (have_posts()) {
		the_post();
		echo "<div class='column third'>";
			include("post-preview.php");
		echo "</div>";
	}
	echo "</div>";
?>