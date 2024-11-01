<?php

 /**
 * Plugin Name: Simple Schema Reviews
 * Description: A lightweight plugin that implements simple schema.org review markup.
 * Plugin URI: https://pwd.com.au/schema-reviews-plugin/
 * Version: 1.0.0
 * Author: perthweb, seoperth
 * Author URI: https://pwd.com.au
 */

require_once 'simple-markup.php';

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'Schema_Review_Options' ) ) {

	class Schema_Review_Options {

		/**
		 * Start things up
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// We only need to register the admin panel on the back-end
			if ( is_admin() ) {
				add_action( 'admin_menu', array( 'Schema_Review_Options', 'add_admin_menu' ) );
				add_action( 'admin_init', array( 'Schema_Review_Options', 'register_settings' ) );
			}

		}

		/**
		 * Returns all Schema Reviews
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_options() {
			return get_option( 'theme_options' );
		}

		/**
		 * Returns single theme option
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_option( $id ) {
			$options = self::get_theme_options();
			if ( isset( $options[$id] ) ) {
				return $options[$id];
			}
		}

		/**
		 * Add sub menu page
		 *
		 * @since 1.0.0
		 */
		public static function add_admin_menu() {
			add_menu_page(
				esc_html__( 'Schema Reviews', 'text-domain' ),
				esc_html__( 'Schema Reviews', 'text-domain' ),
				'manage_options',
				'theme-settings',
				array( 'Schema_Review_Options', 'create_admin_page' )
			);
		}

		/**
		 * Register a setting and its sanitization callback.
		 *
		 * We are only registering 1 setting so we can store all options in a single option as
		 * an array. You could, however, register a new setting for each option
		 *
		 * @since 1.0.0
		 */
		public static function register_settings() {
			register_setting( 'theme_options', 'theme_options', array( 'Schema_Review_Options', 'sanitize' ) );
		}

		/**
		 * Sanitization callback
		 *
		 * @since 1.0.0
		 */
		public static function sanitize( $options ) {

			// If we have options lets sanitize them
			if ( $options ) {

				// Checkbox
				if ( ! empty( $options['enable_checkbox'] ) ) {
					$options['enable_checkbox'] = 'on';
				} else {
					unset( $options['enable_checkbox'] ); // Remove from options if not checked
				}

				// Description Input
				if ( ! empty( $options['desc_input'] ) ) {
					$options['desc_input'] = sanitize_text_field( $options['desc_input'] );
				} else {
					unset( $options['desc_input'] ); // Remove from options if empty
				}

				// Phone Input
				if ( ! empty( $options['phone_input'] ) ) {
					$options['phone_input'] = sanitize_text_field( $options['phone_input'] );
				} else {
					unset( $options['phone_input'] ); // Remove from options if empty
				}

				// Address Input
				if ( ! empty( $options['address_input'] ) ) {
					$options['address_input'] = sanitize_text_field( $options['address_input'] );
				} else {
					unset( $options['address_input'] ); // Remove from options if empty
				}

				// Price Range Input
				if ( ! empty( $options['price_range_input'] ) ) {
					$options['price_range_input'] = sanitize_text_field( $options['price_range_input'] );
				} else {
					unset( $options['price_range_input'] ); // Remove from options if empty
				}

				// Rating Input
				if ( ! empty( $options['rating_input'] ) ) {
					$options['rating_input'] = sanitize_text_field( $options['rating_input'] );
				} else {
					unset( $options['rating_input'] ); // Remove from options if empty
				}

				// Rating Count Input
				if ( ! empty( $options['rating_count_input'] ) ) {
					$options['rating_count_input'] = sanitize_text_field( $options['rating_count_input'] );
				} else {
					unset( $options['rating_count_input'] ); // Remove from options if empty
				}

			}

			// Return sanitized options
			return $options;

		}

		/**
		 * Settings page output
		 *
		 * @since 1.0.0
		 */
		public static function create_admin_page() { ?>

			<div class="wrap">

				<h1><?php esc_html_e( 'Schema Reviews', 'text-domain' ); ?></h1>

				<form method="post" action="options.php">

					<?php settings_fields( 'theme_options' ); ?>

					<table class="form-table wpex-custom-admin-login-table">

					<?php // Description Input ?>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Description', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'desc_input' ); ?>
								<input type="text" name="theme_options[desc_input]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>

						<?php // Phone Input ?>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Phone Number', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'phone_input' ); ?>
								<input type="text" name="theme_options[phone_input]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>

						<?php // Address Input ?>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Address', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'address_input' ); ?>
								<input type="text" name="theme_options[address_input]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>

						<?php // Price Range Input ?>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Price Range ($ to $$$)', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'price_range_input' ); ?>
								<input type="text" name="theme_options[price_range_input]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>

						<?php // Rating Input ?>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Rating', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'rating_input' ); ?>
								<input type="text" name="theme_options[rating_input]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>

						<?php // Rating Count Input ?>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Rating Count', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'rating_count_input' ); ?>
								<input type="text" name="theme_options[rating_count_input]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>

						

					</table>

					<?php submit_button(); ?>

				</form>

			</div><!-- .wrap -->
		<?php }

	}
}
new Schema_Review_Options();

// Helper function to use in your theme to return a theme option value
function ss_get_theme_option( $id = '' ) {
	return Schema_Review_Options::get_theme_option( $id );
}