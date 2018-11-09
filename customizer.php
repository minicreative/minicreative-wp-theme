<?php

// Customize Register: updates the Customize API
function minicreative_customize_register ( $wp_customize ) {

	// Graphics =================================================================

	$wp_customize->add_section('minicreative_graphics', array(
		'title' => 'Graphics',
		'description' => 'Update your logos, background images, and other graphics',
		'priority' => 40
	));

	// Graphics: Add Logo
	$wp_customize->add_setting('minicreative_logo');
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'minicreative_logo', array(
		'label' => 'Logo',
		'section' => 'minicreative_graphics',
		'settings' => 'minicreative_logo',
	)));
	$wp_customize->add_setting('minicreative_logo_alt');
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'minicreative_logo_alt', array(
		'label' => 'Alternate Logo',
		'section' => 'minicreative_graphics',
		'settings' => 'minicreative_logo_alt',
	)));

	// Contact ================================================================

	$wp_customize->add_section('minicreative_contact', array(
		'title' => 'Contact & Social',
		'description' => 'Update your contact information and social networking profiles in one place',
		'priority' => 120
	));

	// Contact: add all settings
	$wp_customize->add_setting('minicreative_contact_email');
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'minicreative_contact_email', array(
		'label' => 'Email Address',
		'section' => 'minicreative_contact',
		'settings' => 'minicreative_contact_email'
	)));
	$wp_customize->add_setting('minicreative_contact_phone');
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'minicreative_contact_phone', array(
		'label' => 'Phone Number',
		'section' => 'minicreative_contact',
		'settings' => 'minicreative_contact_phone'
	)));
	$wp_customize->add_setting('minicreative_contact_fax');
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'minicreative_contact_fax', array(
		'label' => 'Fax Number',
		'section' => 'minicreative_contact',
		'settings' => 'minicreative_contact_fax'
	)));
	$wp_customize->add_setting('minicreative_contact_address1');
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'minicreative_contact_address1', array(
		'label' => 'Address (line 1)',
		'section' => 'minicreative_contact',
		'settings' => 'minicreative_contact_address1'
	)));
	$wp_customize->add_setting('minicreative_contact_address2');
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'minicreative_contact_address2', array(
		'label' => 'Address (line 2)',
		'section' => 'minicreative_contact',
		'settings' => 'minicreative_contact_address2'
	)));
	$wp_customize->add_setting('minicreative_contact_facebook');
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'minicreative_contact_facebook', array(
		'label' => 'Facebook Profile',
		'section' => 'minicreative_contact',
		'settings' => 'minicreative_contact_facebook'
	)));
	$wp_customize->add_setting('minicreative_contact_twitter');
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'minicreative_contact_twitter', array(
		'label' => 'Twitter Profile',
		'section' => 'minicreative_contact',
		'settings' => 'minicreative_contact_twitter'
	)));
	$wp_customize->add_setting('minicreative_contact_instagram');
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'minicreative_contact_instagram', array(
		'label' => 'Instagram Profile',
		'section' => 'minicreative_contact',
		'settings' => 'minicreative_contact_instagram'
	)));
	$wp_customize->add_setting('minicreative_contact_linkedin');
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'minicreative_contact_linkedin', array(
		'label' => 'LinkedIn Profile',
		'section' => 'minicreative_contact',
		'settings' => 'minicreative_contact_linkedin'
	)));
}

add_action('customize_register', 'minicreative_customize_register');