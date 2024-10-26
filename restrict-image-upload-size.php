<?php
/**
 * Plugin Name: Restrict Image Upload Size
 * Description: Prevents users from uploading images smaller than a specified dimension.
 * Version:     1.0
 * Author:      Savvas
 * Author URI:  https://profiles.wordpress.org/savvasha/
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: restrict-image-upload-size
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Add custom settings to the Media Settings page.
 */
function rius_add_media_settings_fields() {
    add_settings_section(
        'rius_settings_section', // ID
        __( 'Image Upload Restrictions', 'restrict-image-upload-size' ), // Title
        '__return_false', // Callback
        'media' // Page
    );

    add_settings_field(
        'rius_min_width',
        __( 'Minimum Image Width (px)', 'restrict-image-upload-size' ),
        'rius_render_min_width_field',
        'media',
        'rius_settings_section'
    );

    add_settings_field(
        'rius_min_height',
        __( 'Minimum Image Height (px)', 'restrict-image-upload-size' ),
        'rius_render_min_height_field',
        'media',
        'rius_settings_section'
    );

    // Set default values to 1000 for width and 650 for height
    register_setting( 'media', 'rius_min_width', array( 'type' => 'number', 'default' => 1000 ) );
    register_setting( 'media', 'rius_min_height', array( 'type' => 'number', 'default' => 650 ) );
}
add_action( 'admin_init', 'rius_add_media_settings_fields' );

/**
 * Render the Minimum Width Field
 */
function rius_render_min_width_field() {
    $min_width = get_option( 'rius_min_width', 1000 );
    echo '<input type="number" name="rius_min_width" value="' . esc_attr( $min_width ) . '" min="1" />';
}

/**
 * Render the Minimum Height Field
 */
function rius_render_min_height_field() {
    $min_height = get_option( 'rius_min_height', 650 );
    echo '<input type="number" name="rius_min_height" value="' . esc_attr( $min_height ) . '" min="1" />';
}

/**
 * Restrict image uploads below a minimum size.
 *
 * Prevents users from uploading images smaller than specified dimensions.
 * Verifies file type with Fileinfo and checks dimensions using getimagesize().
 *
 * @param array $file An array of file attributes for the uploaded file.
 * @return array Modified file array with error if size is below minimum.
 */
function rius_restrict_image_upload_size( $file ) {
    // Get minimum width and height from options, with defaults if not set
    $min_width  = get_option( 'rius_min_width', 1000 );
    $min_height = get_option( 'rius_min_height', 650 );

    // Verify the MIME type of the file to confirm it's an image
    $finfo = finfo_open( FILEINFO_MIME_TYPE );
    $mime_type = finfo_file( $finfo, $file['tmp_name'] );
    finfo_close( $finfo );

    // Check if the file is an image based on MIME type
    if ( strpos( $mime_type, 'image/' ) === 0 ) {
        // Get image dimensions
        $image_size = getimagesize( $file['tmp_name'] );
        $width  = $image_size[0];
        $height = $image_size[1];

        // Check if the image meets the minimum size requirements
        if ( $width < $min_width || $height < $min_height ) {
            $settings_url = admin_url( 'options-media.php' );
            $file['error'] = sprintf(
				// translators: %1$s is the minimum width, and %2$s is the minimum height required for images.
                __( 'Image dimensions are too small. Minimum size is %1$s x %2$s pixels. Please adjust the criteria in <a href="%3$s">Media Settings</a>.', 'restrict-image-upload-size' ),
                $min_width,
                $min_height,
                esc_url( $settings_url )
            );
        }
    }

    return $file;
}
add_filter( 'wp_handle_upload_prefilter', 'rius_restrict_image_upload_size' );