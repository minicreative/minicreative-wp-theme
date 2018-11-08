<?php

/*
MiniCreative WordPress Theme
Parent Theme functions
*/

// Theme Display Functions ===================================================

// Print Head Includes: includes content in HTML head
if (!function_exists('print_head_includes')) {
	function print_head_includes () {}
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

	// Footer widget area
	register_sidebar( array(
		'name'          => 'Primary Sidebar',
		'id'            => 'primary-sidebar',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
	));

	// Footer widget area
	register_sidebar( array(
		'name'          => 'Footer',
		'id'            => 'footer-sidebar',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
	));
}
add_action('widgets_init', 'minicreative_register_sidebars');

// Setup Customizer
include("customizer.php");