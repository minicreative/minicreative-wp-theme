<h1><?php wp_title(""); ?></h1>
<div class="info">Posted <?php the_time('F jS, Y'); ?></div>
<?php the_post_thumbnail(); ?>
<?php the_content() ?>
<div class="clear"></div>