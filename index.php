<?php get_header(); ?>

<div class="content <?= get_post_field('post_name', get_post()); ?>">
	<div class="container">
			
	<?php
		if (have_posts()) {

			// Print singular post
			if (is_singular()) {
				while (have_posts()) {
					the_post();
					the_content();
				}
			} 
			
			// Print list of post previews
			else include("includes/post-list.php");

		} else {
			echo "<p>Sorry, no posts matched your criteria.</p>";
		}
	?>

	</div>
</div>

<?php get_footer(); ?>