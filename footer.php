	
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

	<!-- WordPress Footer -->
	<?php wp_footer(); ?> 

</body>
</html>