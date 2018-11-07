<?php get_header(); ?>

	<div class="content">
		<div class="container">
			
			<?php 
				if (have_posts()) {
					while (have_posts()) {
						the_post();
						include('includes/post.php');
					}
				} else {
					echo "<p>Sorry, no posts matched your criteria.</p>";
				}
			?>

		</div>
	</div>

<?php get_footer(); ?>