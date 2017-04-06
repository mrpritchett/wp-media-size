<?php
/**
 * Plugin Name:     WP Media Size
 * Plugin URI:        http://pritchett.media/wp-media-size
 * Description:       Adds a column to the WordPress Media Gallery with the file size.
 * Version:           0.1.0
 * Author:            Matthew Pritchett
 * Author URI:        http://pritchett.media
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-media-size
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The plugin bootstrap file
 *
 * @since             0.1.0
 * @param             array $columns Array of columns for the admin.
 */
function wp_media_size_add_column_file_size( $columns ) {
	$columns['filesize'] = 'File Size';
	return $columns;
}
add_filter( 'manage_upload_columns', 'wp_media_size_add_column_file_size' );

/**
 * The plugin bootstrap file
 *
 * @since             0.1.0
 * @param             array $column_name Array of columns for the admin.
 * @param             array $media_item Array of columns for the admin.
 */
function wp_media_size_column_file_size( $column_name, $media_item ) {
	if ( 'filesize' !== $column_name || ! wp_attachment_is_image( $media_item ) ) {
		return;
	}
	$filesize = filesize( get_attached_file( $media_item ) );
	$filesize = size_format( $filesize, 2 );
	esc_html_e( $filesize );
}


add_action( 'manage_media_custom_column', 'wp_media_size_column_file_size', 10, 2 );
