<?php

/*
MiniCreative WordPress Theme
Parent Theme functions
*/

// Basics ====================================================================
add_theme_support('post-thumbnails');
add_filter('use_default_gallery_style', '__return_false'); 

// Supress ACF Pro Update Notifications
function filter_plugin_updates( $value ) {
    unset($value->response['advanced-custom-fields-pro/acf.php']);
    return $value;
}
add_filter('site_transient_update_plugins', 'filter_plugin_updates');

// Disable outdated WordPress jQuery include
wp_deregister_script('jquery'); 
wp_register_script('jquery', '', '', '', true);

// Add admin style
function minicreative_admin_style() {
	wp_enqueue_style('admin-styles', get_template_directory_uri().'/sass_compiler/server.php/admin.scss');
}
add_action('admin_enqueue_scripts', 'minicreative_admin_style');

// Theme Header Functions ====================================================

if (!function_exists('get_seo_title')) {
	function get_seo_title() {
		$title = "";
		if (!is_front_page()) $title .= wp_title('-', false, 'right');
		$title .= get_bloginfo('title');
		if (is_front_page()) $title .= ": ".get_bloginfo('description');
		return $title;
	}
}

if (!function_exists('get_seo_description')) {
	function get_seo_description() {
		$post_seo_description = get_post_meta(get_the_ID(), 'seo_description', true);
		if (strlen($post_seo_description))
			return $post_seo_description;
		return get_theme_mod('minicreative_seo_description');
	}
}

if (!function_exists('print_analytics')) {
	function print_analytics() {
		if (get_theme_mod('minicreative_seo_ga'))
			include("includes/analytics.php");
	}
}

// Theme Display Functions ===================================================

// Print Head Includes: includes content in HTML head
if (!function_exists('print_head_includes')) {
	function print_head_includes () {}
}

// Print Site Header
if (!function_exists('print_site_header')) {
	function print_site_header () {
		include("includes/site-header.php");
	}
}

// Print After Header: includes content after <header>
if (!function_exists('print_page_header')) {
	function print_page_header () {
		if (!is_front_page()) include("includes/page-header.php");
	}
}

// Get Page Header Style
if (!function_exists('get_page_header_style')) {
	function get_page_header_style () {}
}

// Print Below Contact
if (!function_exists('print_below_content')) {
	function print_below_content () {}
}

// Print Site Footer
if (!function_exists('print_site_footer')) {
	function print_site_footer () {
		include("includes/site-footer.php");
	}
}

// Get Content Class: returns class for content div based on current page
if (!function_exists('get_content_class')) {
	function get_content_class () {

		// Posts page
		if (is_home()) {
			return "blog";
		}

		if (get_post_type() == "post") {
			return "post";
		}

		// Default (post slug)
		return get_post_field('post_name', get_post());
	}
}

// Get Content Style: returns style for content div based on current page
if (!function_exists('get_content_style')) {
	function get_content_style () {
		return "";
	}
}

// Print Logo: displays wrapped, linked logo
if (!function_exists('print_logo')) {
	function print_logo () {
		echo "<div class='logo'>";
		echo "<a href='".get_home_url()."'>";
		if (get_theme_mod('minicreative_logo')) 
			echo "<img src='".get_theme_mod('minicreative_logo')."' alt='".get_bloginfo('name')."' />";
		else 
			echo "<h1>".get_bloginfo('name')."</h1>";
		echo "</a>";
		echo "</div>";
	}
}

// Print Navigation: displays header-menu or default nav menu (depth 2)
if (!function_exists('print_navigation')) {
	function print_navigation () {
		$headerMenuConfig = array(
			'depth' => 2,
			'container' => 'div',
			'container_class' => 'navigation'
		);
		if (has_nav_menu('header-menu')) {
			$headerMenuConfig['theme_location'] = 'header-menu';
		}	
		wp_nav_menu($headerMenuConfig); 
	}
}

// Print Post Title: displays post title
if (!function_exists('print_post_title')) {
	function print_post_title() {
		if (get_post_type() == "post") {
			echo get_the_title(get_option('page_for_posts'));
		}
		else wp_title('');
	}
}

// Print Post List: displays list of post previews
if (!function_exists('print_post_list')) {
	function print_post_list () {
		include("includes/post-list.php");
	}
}

// Print Post Preview: displays post preview for post in loop
if (!function_exists('print_post_preview')) {
	function print_post_preview () {
		include("includes/post-preview.php");
	}
}

// Print Content: displays the content for the post
if (!function_exists('print_content')) {
	function print_content () {
		if (get_post_type() == "post") {
			include("includes/post-content.php");
		}
		else the_content();
	}
}

// Print Contact Info: displays contact information from customizer
if (!function_exists('print_contact_info')) {
	function print_contact_info () {
		if (get_theme_mod('minicreative_contact_email')) {
			echo "<div class='contact_item'>";
			echo "<a href='mailto:".get_theme_mod('minicreative_contact_email')."'>";
				echo get_theme_mod('minicreative_contact_email');
			echo "</a>";
			echo "</div>";
		}
		if (get_theme_mod('minicreative_contact_address1')) {
			echo "<div class='contact_item'>";
			echo get_theme_mod('minicreative_contact_address1');
			echo "<br />";
			echo get_theme_mod('minicreative_contact_address2');
			echo "</div>";
		}
		if (get_theme_mod('minicreative_contact_phone')) {
			echo "<div class='contact_item'>";
			echo "Phone: ";
			echo get_theme_mod('minicreative_contact_phone');
			echo "</div>";
		}
		if (get_theme_mod('minicreative_contact_fax')) {
			echo "<div class='contact_item'>";
			echo "Fax: ";
			echo get_theme_mod('minicreative_contact_fax');
			echo "</div>";
		}
	}
}

// Print Social Networks: displays FA icon based on Customizer links
if (!function_exists('print_social_networks')) {
	function print_social_networks () {
		$socials = array(
			'facebook' => 'minicreative_contact_facebook',
			'twitter' => 'minicreative_contact_twitter',
			'instagram' => 'minicreative_contact_instagram',
			'linkedin-in' => 'minicreative_contact_linkedin'
		);
		echo "<div class='social'>";
		foreach ($socials as $name => $customizekey) {
			if (get_theme_mod($customizekey)) {
				echo "<a href='".get_theme_mod($customizekey)."'><span class='fab fa-{$name}'></span></a>";
			}
		}
		echo "</div>";
	}
}

// Shortcodes ===============================================================

// Divider
function register_divider_shortcode() {
    function divider_shortcode($atts, $content) {
		if ($atts == "") {
			return "<div class='divider'></div>";
		}
		return "<div class='divider {$atts['type']}'></div>";
    }
    add_shortcode('divider', 'divider_shortcode');
}
add_action('init', 'register_divider_shortcode');

// Columns & Column
function register_columns_shortcode() {
    function columns_shortcode($atts, $content) {
        return "<div class='columns'>".do_shortcode($content)."</div>";
    }
    add_shortcode('columns', 'columns_shortcode');
}
add_action('init', 'register_columns_shortcode');
function register_column_shortcode() {
    function column_shortcode($atts, $content) {
        return "<div class='column {$atts['width']}'>".do_shortcode($content)."</div>";
    }
    add_shortcode('column', 'column_shortcode');
}
add_action('init', 'register_column_shortcode');

// Button
function register_button_shortcode() {
    function button_shortcode($atts, $content) {
        return "<a href='{$atts['link']}' class='button'>{$content}</a>";
    }
    add_shortcode('button', 'button_shortcode');
}
add_action('init', 'register_button_shortcode');

// Shortcode BR/P fix
function shortcode_empty_paragraph_fix($content) {
    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
        ']<br>'   => ']',
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'shortcode_empty_paragraph_fix');

// Theme Setup Functions =====================================================

// Register Menus: adds support for menus in header & footer
function minicreative_register_menus() {
	register_nav_menus(array(
		'header-menu' => 'Header Menu',
		'footer-menu' => 'Footer Menu'
	));
}
add_action('init', 'minicreative_register_menus');

// Register Sidebars: add support for sidebars & widgers
function minicreative_register_sidebars() {

	// Primary widget area
	register_sidebar( array(
		'name'          => 'Primary Sidebar',
		'id'            => 'primary-sidebar',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
	));
}
add_action('widgets_init', 'minicreative_register_sidebars');

// Setup Custom Fields
if (function_exists('acf_add_local_field_group')) {
	acf_add_local_field_group(array(
		'key' => 'group_5bfee9bf025aa',
		'title' => 'SEO',
		'fields' => array(
			array(
				'key' => 'field_5bfee9c2698ee',
				'label' => 'SEO Description',
				'name' => 'seo_description',
				'type' => 'textarea',
				'instructions' => 'Enter 100-170 characters',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
			),
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
		),
		'menu_order' => 20,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
}

// Setup Customizer
include("customizer.php");