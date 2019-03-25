<!-- Post Title -->
<h1><?php the_title(); ?></h1>

<!-- Post Meta -->
<div class="meta">Posted <?php the_time('F jS, Y'); ?></div>

<!-- Post Thumbnail -->
<?php if (has_post_thumbnail()) {

// Print thumbnail
echo "<a href='".get_the_permalink()."'>"
	.get_the_post_thumbnail(null, "full", ['class' => 'featured-image'])
	."</a>";
} ?>

<!-- Post Content -->
<?php the_content() ?>
<div class="clear"></div>