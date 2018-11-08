<div class="navigation">
	<?php 
		$headerMenuConfig = array(
			'depth' => 2,
			'container' => ''
		);
		if (has_nav_menu('header-menu'))
			$headerMenuConfig['theme_location'] = 'header-menu';
		wp_nav_menu($headerMenuConfig); 
	?>
</div>