# MiniCreative Web Base

WebBase is a collection of fundamental SCSS & JS for new MiniCreative development projects. It includes several third party libraries, including jQuery and php-sass. It is configured to work out of the box for new WordPress and ProcessWire projects.

The following files / directories are specifically included:
* js/main.js (base / reusable JavaScript functions)
* scss/main.scss (base / reusable CSS styles)
* plugins (3rd party libraries and plugins)
* sass_compiler (PHP SASS compiler library)
* wp_base and wp_includes (abstract WordPress files)
* pw_base and pw_includes (abstract ProcessWire files)

## ProcessWire

## WordPress

### Installation

*Install the following plugins:*  
advanced-custom-fields-pro (for custom fields)
better-search-replace (for site migration)
contact-form-7 (for contact forms)
wordpress-seo (Yoast for SEO)

### Sample WPCF7 Template
```
<div class="columns">
<div class="column half"> <label>First Name*</label> [text* first-name] </div>
<div class="column half"> <label>Last Name*</label> [text* last-name] </div>
<div class="column half"> <label>Email*</label> [email* email] </div>
<div class="column half"> <label>Phone*</label> [tel* tel] </div>
<div class="column full"> <label>Message</label> [textarea message] </div>
</div>
[submit "Send"]
```