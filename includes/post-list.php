<?php
	while (have_posts()) {
		the_post();
		include("post-preview.php");
	}
?>