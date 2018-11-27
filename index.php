<?php get_header(); ?>

<div class="content <?= get_content_class(); ?>">
	<div class="container">
			
	<?php

		// Handle matching post or posts
		if (have_posts()) {

			// Print singular post
			if (is_singular()) {
				while (have_posts()) {
					the_post();
					the_content();
				}
			} 
			
			// Print list of post previews
			else print_post_list();

		} 
		
		// Handle empty query
		else {
			echo "<p>Sorry, nothing matches this query.</p>";
		}
	?>

	</div>
</div>

<?php get_footer(); ?>