<?php

/*
MiniCreative WordPress Theme
Parent Theme functions
*/

// Basics ====================================================================

// Support post thumbnails
add_theme_support('post-thumbnails');

// Don't style galleries
add_filter('use_default_gallery_style', '__return_false'); 

// Supress ACF Pro update notifications
function filter_plugin_updates( $value ) {
    unset($value->response['advanced-custom-fields-pro/acf.php']);
    return $value;
}
add_filter('site_transient_update_plugins', 'filter_plugin_updates');

// Disable outdated WordPress jQuery include
wp_deregister_script('jquery'); 
wp_register_script('jquery', '', '', '', true);

// Move Yoast to bottom
function yoasttobottom() {
	return 'low';
}
add_filter('wpseo_metabox_prio', 'yoasttobottom');

// Set excerpt length to 30
add_filter('excerpt_length', function($length) {
    return 30;
});

// Sitemap Generator ======================================================
function create_sitemap() {

    $postsForSitemap = get_posts(array(
        'numberposts' => -1,
        'orderby' => 'modified',
        'post_type'  => array( 'post', 'page', 'event' ),
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

// Generate sitemap whenever a post is saved
add_action('save_post', 'create_sitemap');

// Helper Functions ==========================================================
function get_bg_image ($image) {
	return "background-image:url('".$image."');"
}
function print_bg_image ($image) {
	echo get_bg_image($image);
}

function close_tags($text) {
    $patt_open    = "%((?<!</)(?<=<)[\s]*[^/!>\s]+(?=>|[\s]+[^>]*[^/]>)(?!/>))%";
    $patt_close    = "%((?<=</)([^>]+)(?=>))%";
    if (preg_match_all($patt_open,$text,$matches))
    {
        $m_open = $matches[1];
        if(!empty($m_open))
        {
            preg_match_all($patt_close,$text,$matches2);
            $m_close = $matches2[1];
            if (count($m_open) > count($m_close))
            {
                $m_open = array_reverse($m_open);
                foreach ($m_close as $tag) $c_tags[$tag]++;
                foreach ($m_open as $k => $tag)    if ($c_tags[$tag]--<=0) $text.='</'.$tag.'>';
            }
        }
    }
    return $text;
}
function print_event_date($id) {
	$start_date = new DateTime(get_field('start_date', $id));
	$end_date = new DateTime(get_field('end_date', $id));
	if ($start_date == $end_date)
		$date_output = $start_date->format('F j, Y');
	else $date_output = $start_date->format('F j')." - ".$end_date->format('F j, Y');
	echo $date_output;
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

// Print HTML Title: allows override by Yoast by default
if (!function_exists('print_html_title')) {
	function print_html_title () {

		// Detect if Yoast is installed, hand off title functionality to WordPress
		if (in_array('wordpress-seo/wp-seo.php', apply_filters('active_plugins', get_option('active_plugins')))){ 
			wp_title('');
		}
		
		// Otherwise, use custom settings
		else {
			if (is_front_page()) {
				echo get_bloginfo('name').": ".get_bloginfo('description');
			}
			else echo get_the_title()." - ".get_bloginfo('name');
		}
	}
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

// Print Post Title: displays post title
if (!function_exists('print_post_title')) {
	function print_post_title() {
		if (get_post_type() == "post") {
			echo get_the_title(get_option('page_for_posts'));
		}
		else echo get_the_title();
	}
}

// Get Page Header Style
if (!function_exists('get_page_header_style')) {
	function get_page_header_style () {}
}

// Print Below Content
if (!function_exists('print_below_content')) {
	function print_below_content () {}
}

// Print Site Footer
if (!function_exists('print_site_footer')) {
	function print_site_footer () {
		include("wp_includes/site-footer.php");
	}
}

// Basic Content Classes
function basic_content_classes () {
	// Setup array for classes
	$classes = [];

	// Front page
	if (is_front_page()) array_push($classes, "front-page");

	// Posts page
	if (is_home()) array_push($classes, "blog");

	// Post type
	array_push($classes, get_post_type());

	return implode(" ", $classes);
}

// Get Content Class: returns class for content div based on current page
if (!function_exists('get_content_class')) {
	function get_content_class () {
		return basic_content_classes();
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

// Print Blog Categories
if (!function_exists('print_blog_categories')) {
	function print_blog_categories () {

		// Get list of categories
		$categories = get_categories();

		// Print link to all posts
		echo "<a href='".get_permalink(get_option('page_for_posts'))."'";
		if (is_home()) echo " class='active'"; 
		echo ">All</a>";

		// Print individual categories
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

// Print Post Categories: displays a list of categories for a given post
if (!function_exists('print_post_categories')) {
	function print_post_categories () {

		// Get list of categories for post
		$categories = wp_get_post_categories(get_the_ID());

		// Print list of categories
		if (count($categories)) {
			echo "<div class='post-categories'>Posted in ";
			$index = 0;
			foreach($categories as $cat) {
				$index++;
				$category = get_category($cat);
				echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
				if ($index < count($categories)) echo ", ";
			}
			echo "</div>";
		}
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

// Get Social Networks: returns FA icon based on Customizer links
if (!function_exists('get_social_networks')) {
	function get_social_networks() {
		$socials = array(
			'facebook' => 'minicreative_contact_facebook',
			'twitter' => 'minicreative_contact_twitter',
			'instagram' => 'minicreative_contact_instagram',
			'linkedin-in' => 'minicreative_contact_linkedin',
			'youtube' => 'minicreative_contact_youtube',
			'google-plus-g' => 'minicreative_contact_googleplus'
		);
		$html = "";
		$html .= "<div class='social'>";
		foreach ($socials as $name => $customizekey) {
			if (get_theme_mod($customizekey)) {
				$html .= "<a href='".get_theme_mod($customizekey)."'><span class='fab fa-{$name}'></span></a>";
			}
		}
		$html .= "</div>";
		return $html;
	}
}

// Print Social Networks: displays FA icon based on Customizer links
if (!function_exists('print_social_networks')) {
	function print_social_networks() {
		echo get_social_networks();
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
        return "<a href='{$atts['link']}' class='button {$atts['class']}'>{$content}</a>";
    }
    add_shortcode('button', 'button_shortcode');
}
add_action('init', 'register_button_shortcode');

// Alt Logo
function register_alt_logo_shortcode() {
    function alt_logo_shortcode($atts, $content) {
        return "<img class='logo-alt' src='".get_theme_mod('minicreative_logo_alt')."' />";
    }
    add_shortcode('alternate-logo', 'alt_logo_shortcode');
}
add_action('init', 'register_alt_logo_shortcode');

// Contact Variables
function register_contact_shortcodes() {

	// Google Map
	function google_map_shortcode($atts, $content) {
        return "<div class='google-map'>".get_theme_mod('minicreative_map_embed')."</div>";
    }
	add_shortcode('google-map', 'google_map_shortcode');
	add_shortcode('google_map', 'google_map_shortcode');
	
	// Phone
	function phone_shortcode($atts, $content) {
		return "<span class='phone'>".get_theme_mod('minicreative_contact_phone')."</span>";
	}
	add_shortcode('phone', 'phone_shortcode');

	// Email
	function email_shortcode($atts, $content) {
		return "<span class='email'><a href='mailto:".get_theme_mod('minicreative_contact_email')."'>"
			.get_theme_mod('minicreative_contact_email')."</a></span>";
	}
	add_shortcode('email', 'email_shortcode');

	// Address 
	function address_shortcode($atts, $content) {
		return "<span class='address'>".get_theme_mod('minicreative_contact_address1')."<br />"
			.get_theme_mod('minicreative_contact_address2')."</span>";
	}
	add_shortcode('address', 'address_shortcode');

	// Address Line 1
	function address1_shortcode($atts, $content) {
		return "<span class='address1'>".get_theme_mod('minicreative_contact_address1')."</span>";
	}
	add_shortcode('address-line-1', 'address1_shortcode');

	// Address Line 1
	function address2_shortcode($atts, $content) {
		return "<span class='address2'>".get_theme_mod('minicreative_contact_address2')."</span>";
	}
	add_shortcode('address-line-2', 'address2_shortcode');

	// Social Networks
	function social_networks_shortcode($atts, $content) {
		return get_social_networks();
	}
	add_shortcode('social-networks', 'social_networks_shortcode');
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

// Setup Customizer
include("wp_includes/customizer.php");