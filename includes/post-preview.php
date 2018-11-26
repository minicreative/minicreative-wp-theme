<div class="post-preview">
	<h2>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>
	<div class="info">
		<?php the_time('F jS, Y'); ?>
	</div>
	<div class="excerpt">
		<?php the_excerpt(); ?>
	</div>
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