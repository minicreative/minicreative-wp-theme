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

// Sitemap Generator ======================================================

add_action('publish_post', 'create_sitemap');
function create_sitemap() {

    $postsForSitemap = get_posts(array(
        'numberposts' => -1,
        'orderby' => 'modified',
        'post_type'  => array( 'post', 'page' ),
        'order'    => 'DESC'
    ));

    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
    $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    foreach( $postsForSitemap as $post ) {
        setup_postdata( $post );

        $postdate = explode( " ", $post->post_modified );

        $sitemap .= '<url>'.
          '<loc>' . get_permalink( $post->ID ) . '</loc>' .
          '<lastmod>' . $postdate[0] . '</lastmod>' .
          '<changefreq>monthly</changefreq>' .
         '</url>';
      }

    $sitemap .= '</urlset>';

    $fp = fopen( ABSPATH . 'sitemap.xml', 'w' );

    fwrite( $fp, $sitemap );
    fclose( $fp );
}

// Helper Functions ==========================================================
function print_bg_image ($image) {
	echo "background-image:url('".$image."');";
}

// Theme Header Functions ====================================================

if (!function_exists('print_analytics')) {
	function print_analytics() {
		if (get_theme_mod('minicreative_ga'))
			include("wp_includes/analytics.php");
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
		include("wp_includes/site-header.php");
	}
}

// Print Extra Header Content
if (!function_exists('print_extra_header_content')) {
	function print_extra_header_content () {}
}

// Print Page Header
if (!function_exists('print_page_header')) {
	function print_page_header () {
		if (!is_front_page()) include("wp_includes/page-header.php");
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
		include("wp_includes/site-footer.php");
	}
}

// Get Content Class: returns class for content div based on current page
if (!function_exists('get_content_class')) {
	function get_content_class () {

		// Front page
		if (is_front_page()) {
			return "front-page";
		}

		// Posts page
		if (is_home()) {
			return "blog";
		}

		// Post page
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
		else echo get_the_title();
	}
}

// Print Blog Categories
if (!function_exists('print_blog_categories')) {
	function print_blog_categories () {
		$categories = get_categories();
		echo "<a href='".get_permalink(get_option('page_for_posts'))."'";
		if (is_home()) echo " class='active'"; 
		echo ">All</a>";
		foreach ($categories as $category) {
			echo "<a href='".get_term_link($category)."'";
			if (get_queried_object() == $category) echo " class='active'";
			echo ">{$category->name}</a>";
		}
	}
}

// Print Post List: displays list of post previews
if (!function_exists('print_post_list')) {
	function print_post_list () {
		include("wp_includes/post-list.php");
	}
}

// Print Post Preview: displays post preview for post in loop
if (!function_exists('print_post_preview')) {
	function print_post_preview () {
		include("wp_includes/post-preview.php");
	}
}

// Print Content: displays the content for the post
if (!function_exists('print_content')) {
	function print_content () {
		if (get_post_type() == "post") {
			include("wp_includes/post-content.php");
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
			'linkedin-in' => 'minicreative_contact_linkedin',
			'youtube' => 'minicreative_contact_youtube',
			'google-plus-g' => 'minicreative_contact_googleplus'
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

// Contact Variables
function register_contact_shortcodes() {

	// Google Map
	function google_map_shortcode($atts, $content) {
        return "<div class='google-map'>".get_theme_mod('minicreative_map_embed')."</div>";
    }
	add_shortcode('google_map', 'google_map_shortcode');
	
	// Phone
	function phone_shortcode($atts, $content) {
		return "<span class='phone'>".get_theme_mod('minicreative_contact_phone')."</span>";
	}
	add_shortcode('phone', 'phone_shortcode');

	// Address 
	function address_shortcode($atts, $content) {
		return "<span class='address'>".get_theme_mod('minicreative_contact_address1')."<br />"
			.get_theme_mod('minicreative_contact_address2')."</span>";
	}
	add_shortcode('address', 'address_shortcode');
}
add_action('init', 'register_contact_shortcodes');

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
include("wp_includes/customizer.php");