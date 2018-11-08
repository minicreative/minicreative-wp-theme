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

	<!-- Site Footer -->
	<footer>
		<div class="container">

			<!-- Contact Information -->
			<div class="column contact">
				<?php print_contact_info() ?>
			</div>
			
			<!-- Footer Widgets -->
			<?php dynamic_sidebar('footer-sidebar'); ?>

		</div>
	</footer>

<?php get_footer(); ?>