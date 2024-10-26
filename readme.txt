=== Restrict Image Upload Size ===
Contributors: savvasha
Donate link: https://bit.ly/3NLUtMh
Tags: image upload, restrict upload size, media settings, upload restrictions, image dimensions
Requires at least: 5.3
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Prevent users from uploading images smaller than specified dimensions. Set minimum width and height requirements from the Media Settings page.

== Description ==

**Restrict Image Upload Size** is a WordPress plugin that allows administrators to set minimum width and height requirements for uploaded images. Users are prevented from uploading images that don't meet these specified dimensions, which helps maintain quality standards across your site's media content.

Key features include:
* Set minimum width and height values for uploaded images.
* Custom error messages for invalid uploads.
* Easy to use.
* Configurable from the WordPress Media Settings page.

This plugin is ideal for websites that need to ensure consistent image quality, especially for portfolios, e-commerce sites, and blogs.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/restrict-image-upload-size` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Go to **Settings > Media** to set the minimum width and height for image uploads.

== Frequently Asked Questions ==

= What happens if an image doesn't meet the minimum dimensions? =
If an image is below the minimum specified width or height, the upload will be rejected, and an error message will inform the user of the requirements.

= Where can I set the minimum image dimensions? =
After activating the plugin, navigate to **Settings > Media** in your WordPress dashboard. You’ll find fields to set the minimum width and height for image uploads.

== Screenshots ==

1. **Media Settings** – Set the minimum image dimensions directly in the Media Settings page.
2. **Upload Error Message** – The error message shown when an image fails to meet the specified dimensions.

== Changelog ==

= 1.0 =
* Initial release.
* Added minimum width and height settings for images.
* Verification of file type to ensure only image files are accepted.
* Custom error messages for failed uploads.

== Upgrade Notice ==

= 1.0 =
Initial release. Ensure minimum image upload dimensions directly from your WordPress Media Settings page.
