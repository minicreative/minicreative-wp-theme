<div class='logo'>
	<?php
		echo "<a href='".get_home_url()."'>";
		if (get_theme_mod('minicreative_logo')) 
			echo "<img src='".get_theme_mod('minicreative_logo')."' alt='".get_bloginfo('name')."' />";
		else 
			echo "<h1>".get_bloginfo('name')."</h1>";
		echo "</a>";
	?>
</div>