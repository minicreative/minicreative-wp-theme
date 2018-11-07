<?php get_header(); ?>

	<div class="content">
		<div class="container">
			<h1><?php echo the_title(); ?></h1>
			<div class="body">
				<?php 
					$id= get_the_id(); 
					$post = get_post($id); 
					echo apply_filters('the_content', $post->post_content); 
				?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>