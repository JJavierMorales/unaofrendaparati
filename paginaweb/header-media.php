<?php
/**
 * Header Media Options
 *
 * @package Music_Journal
 */

function music_journal_header_media_options( $wp_customize ) {
	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_header_media_logo',
			'sanitize_callback' => 'esc_url_raw',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Header Media Logo', 'music-journal' ),
			'section'           => 'header_image',
		)
	);
}
add_action( 'customize_register', 'music_journal_header_media_options' );

