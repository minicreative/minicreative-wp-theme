<?php

/*
MiniCreative WordPress Theme
Parent Theme functions
*/

// Theme Display Functions ===================================================

if (!function_exists('print_logo')) {
	function print_logo () {
		include("includes/logo.php");
	}
}

if (!function_exists('print_navigation')) {
	function print_navigation () {
		include("includes/navigation.php");
	}
}

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