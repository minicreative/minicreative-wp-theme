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

// Shorten excerpt length
add_filter('excerpt_length', function($length) {
    return 30;
});

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

		// Default (post slug)
		return get_post_field('post_name', get_post());
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

// Print Post List: displays list of post previews
if (!function_exists('print_post_list')) {
	function print_post_list () {
		include("includes/post-list.php");
	}
}

// Initialize Bricks: initializes Bricks.js
if (!function_exists('initialize_bricks')) {
	function initialize_bricks () {
		include("includes/bricks.php");
	}
}

// Print Post Preview: displays post preview for post in loop
if (!function_exists('print_post_preview')) {
	function print_post_preview () {
		include("includes/post-preview.php");
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

// Setup Customizer
include("customizer.php");