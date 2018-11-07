<?php

/*
MiniCreative WordPress Theme
Theme functions
*/

// Register Menus: adds support for menus in header & footer
function minicreative_register_menus() {
	register_nav_menus(array(
		'header-menu' => 'Header Menu',
		'footer-menu' => 'Footer Menu'
	));
}

// Customize Register: updates the Customize API
function minicreative_customize_register ( $wp_customize ) {

	// Header: Add Section
	$wp_customize->add_section('minicreative_header', array(
		'title' => 'Header',
		'description' => 'Update your logo, header background image, and other settings',
		'priority' => 40
	));

	// Header: Add Logo
	$wp_customize->add_setting('minicreative_logo');
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'minicreative_logo', array(
		'label' => 'Logo',
		'section' => 'minicreative_header',
		'settings' => 'minicreative_logo',
	)));

	// Header: Add Background Image
	$wp_customize->add_setting('minicreative_header_bg');
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'minicreative_header_bg', array(
		'label' => 'Header Background',
		'section' => 'minicreative_header',
		'settings' => 'minicreative_header_bg',
	)));
}

// Actions ======================================================================
add_action('customize_register', 'minicreative_customize_register');
add_action('init', 'minicreative_register_menus');