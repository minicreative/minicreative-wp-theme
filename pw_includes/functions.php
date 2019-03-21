<?php 

// Reusable Variables Variables
$homepage = $pages->get('/');
$settings = $pages->get('/settings/');

// Helper Functions ==============================================

// Not Empty: tests string variable existence
function notEmpty($var) {
	if ($var == null) return false;
	if (strlen($var) < 1) return false;
	return true;
}

function getExcerpt($content, $length) {
	if (!$length) $length = 30;
	$text = strip_tags($content);
	$words = explode(" ",$text);
	if (sizeof($words) > $length) {
		return implode(" ",array_slice($words,0,$length))."...";
	} else {
		return $text;
	}
}

// Template Functions ============================================

// Get Page Title: returns title for page
function getPageTitle($pages, $page) {
	$output = "";
    if ($page !== $pages->get("/")) $output .= $page->title . ' - ';
    $output .= $pages->get("/settings/")->site_title;
	if ($page == $pages->get("/")) $output .= ": " . $pages->get("/settings/")->site_tagline;
	return $output;
}

// Get Page SEO Description: returns SEO description for page
function getPageSeoDescription($pages, $page) {
	$output = "";
	if (count($page->_description)) $output .= $page->seo_description;
	elseif ($page->template !== 'home' and count($page->parent->seo_description)) 
		$output .= $page->parent->seo_description;
	else $output .= $pages->get("/settings/")->seo_description;
	return $output;
}

// Get Header Image URL: returns URL for single header image
function getHeaderImageURL($page, $settings) {
	if ($page->header_image) {
		return $page->header_image->url;
	}
	return $settings->header_image->url;
}

// Display Navigation: prints leveled navigation
function displayNavigation($pages, $page, $includeHome) {

	echo "<ul>";

	// Print link to homepage if necessary
	if ($includeHome) {
		echo "<li";
    	if ($page == $pages->get("/")) echo " class='active'";
    	echo "><a href='{$pages->get("/")->url}'>{$pages->get('/')->title}</a></li>";
	}

	// Print visible children
	foreach ($pages->get("/")->children as $child) {

		// Determine if page has children
		$createsub = $child->numChildren > 0;

		// Open nav li
		echo "<li";
		if ($child == $page or ($child == $page->parent and $page->parent !== $pages->get('/'))) 
			echo " class='active'";
		echo ">";

		// Create child link
		echo "<a href='{$child->url}'>{$child->title}</a>";

		// Create subnavigation
		if ($createsub) {
			echo "<ul class='sub-menu'>";

			// Create links for children of child
			foreach ($child->children as $sub) {
				echo "<li><a href='{$sub->url}' class='sublink'>{$sub->title}</a></li>";
			}
			echo "</ul>";
		}
		
		// Close nav li
		echo "</li>";
	}

	echo "</ul>";
}

// Display Social Networking: prints social networking links
function displaySocialNetworks ($settings) {
	foreach ($settings->site_social as $network) {
		echo "<a href='{$network->link}'><i class='fab fa-{$network->icon}'></i><span>{$network->title}</span></a>";
	}
}

// Display Contact Information: prints social networking links
function displayContactInformation ($settings) {
	if ($settings->site_contact->address) {
		echo "<div class='contact-item'>";
			echo "<div class='icon fas fa-map-marker-alt'></div>";
			echo "<div class='title'>Address</div>";
			echo "<div class='value'>{$settings->site_contact->address1}<br />{$settings->site_contact->address2}</div>";
		echo "</div>";
	}
	if ($settings->site_contact->email) {
		echo "<div class='contact-item'>";
			echo "<div class='icon fas fa-envelope'></div>";
			echo "<div class='title'>Email</div>";
			echo "<div class='value'><a href='mailto:{$settings->site_contact->email}'>{$settings->site_contact->email}</a></div>";
		echo "</div>";
	}
	if ($settings->site_contact->phone) {
		echo "<div class='contact-item'>";
			echo "<div class='icon fas fa-phone'></div>";
			echo "<div class='title'>Phone</div>";
			echo "<div class='value'>{$settings->site_contact->phone}</div>";
		echo "</div>";
	}
	if ($settings->site_contact->fax) {
		echo "<div class='contact-item'>";
			echo "<div class='icon fas fa-fax'></div>";
			echo "<div class='title'>Fax</div>";
			echo "<div class='value'>{$settings->site_contact->fax}</div>";
		echo "</div>";
	}
}

// Display Admin Links: prints admin links if user is logged in
function displayAdminLinks ($pages, $page, $config) {
	if ($page->editable()) {
		echo "<div id='processwire'>";
			echo "<a href='{$config->urls->admin}'>Admin</a><br />";
			echo "<a href='{$config->urls->admin}page/edit/?id={$pages->get('/settings/')->id}'>Settings</a><br />";
			echo "<a href='{$config->urls->admin}page/edit/?id={$page->id}'>Edit Page</a>";
		echo "</div>";
    }
}

?>