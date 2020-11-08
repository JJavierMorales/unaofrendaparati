<?php
/**
 * Playlist Options
 *
 * @package Music_Journal
 */

/**
 * Add sticky_playlist options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function photo_journal_sticky_playlist( $wp_customize ) {
	$wp_customize->add_section( 'photo_journal_sticky_playlist', array(
			'title' => esc_html__( 'Sticky Playlist', 'music-journal' ),
			'panel' => 'photo_journal_theme_options',
		)
	);

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_sticky_playlist_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'photo_journal_sanitize_select',
			'choices'           => photo_journal_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'music-journal' ),
			'section'           => 'photo_journal_sticky_playlist',
			'type'              => 'select',
		)
	);

	photo_journal_register_option( $wp_customize, array(
			'name'              => 'photo_journal_sticky_playlist',
			'default'           => '0',
			'sanitize_callback' => 'photo_journal_sanitize_post',
			'active_callback'   => 'photo_journal_is_sticky_playlist_active',
			'label'             => esc_html__( 'Page', 'music-journal' ),
			'section'           => 'photo_journal_sticky_playlist',
			'type'              => 'dropdown-pages',
		)
	);
}
add_action( 'customize_register', 'photo_journal_sticky_playlist', 12 );

/** Active Callback Functions **/
if ( ! function_exists( 'photo_journal_is_sticky_playlist_active' ) ) :
	/**
	* Return true if sticky_playlist is active
	*
	* @since 1.0
	*/
	function photo_journal_is_sticky_playlist_active( $control ) {
		$enable = $control->manager->get_setting( 'photo_journal_sticky_playlist_visibility' )->value();

		return photo_journal_check_section( $enable );
	}
endif;
