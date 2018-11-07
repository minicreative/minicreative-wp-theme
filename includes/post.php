<div class="post">
	<h2>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>
	<div class="info">
		<?php the_time('F jS, Y'); ?> by <?php the_author_posts_link(); ?>
	</div>
	<div class="body">
		<?php the_content(); ?>
	</div>
	<div class="meta">
		Posted in <?php the_category( ', ' ); ?>
	</div>
</div>