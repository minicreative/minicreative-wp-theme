<div class="post-preview">
	<?php 
		if (has_post_thumbnail()) the_post_thumbnail();
	?>
	<h2>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>
	<div class="info">
		<?php the_time('F jS, Y'); ?>
	</div>
	<div class="excerpt">
		<?php the_excerpt(); ?>
	</div>
	<a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
	<div class="categories">
		<?php
			$categories = wp_get_post_categories(get_the_ID());
			foreach($categories as $cat) {
				$category = get_category($cat);
			   echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
			}
		?>
	</div>
</div>