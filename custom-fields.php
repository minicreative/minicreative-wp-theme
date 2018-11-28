<?php

// This file is under development
// https://www.smashingmagazine.com/2011/10/create-custom-post-meta-boxes-wordpress/

// Add Meta Boxes
add_action('add_meta_boxes', 'minicreative_add_meta_boxes');
function minicreative_add_meta_boxes () {

	// SEO
	add_meta_box(
		'minicreative_seo',
		'SEO',
		'minicreative_seo_meta_box',
		array('post', 'page'),
		'side',
		'high'
	  );
}

// Meta Box Callbacks
function minicreative_seo_meta_box ($post) { 
	wp_nonce_field( basename( __FILE__ ), 'smashing_post_class_nonce' );
	?>
	<p>
		<div class="title">SEO Description</div>
		<textarea name="minicreative_seo_description">
			<?php echo get_post_meta( $post->ID, 'minicreative_seo_description', true ) ?>
		</textarea>
		<div class="instructions">100-170 characters</div>
	</p>
	<?php 
}

// Meta Box Save Functions
function smashing_save_post_class_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['smashing_post_class_nonce'] ) || !wp_verify_nonce( $_POST['smashing_post_class_nonce'], basename( __FILE__ ) ) )
	  return $post_id;
  
	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );
  
	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
	  return $post_id;
  
	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['smashing-post-class'] ) ? sanitize_html_class( $_POST['smashing-post-class'] ) : ’ );
  
	/* Get the meta key. */
	$meta_key = 'minicreative_seo';
  
	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );
	if ( $new_meta_value && ’ == $meta_value )
	  add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
	  update_post_meta( $post_id, $meta_key, $new_meta_value );
	elseif ( ’ == $new_meta_value && $meta_value )
	  delete_post_meta( $post_id, $meta_key, $meta_value );
  }