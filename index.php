<?php get_header(); ?>

<div class="content <?= get_post_field('post_name', get_post()); ?>">
	<div class="container">
			
	<?php
		if (have_posts()) {
			while (have_posts()) {
				the_post();
				the_content();
			}
		} else {
			echo "<p>Sorry, no posts matched your criteria.</p>";
		}
	?>

	</div>
</div>

<?php get_footer(); ?>