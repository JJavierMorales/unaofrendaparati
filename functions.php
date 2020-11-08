<?php
/*
 * This is the child theme for Photo Journal theme, generated with Generate Child Theme plugin by catchthemes.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action( 'wp_enqueue_scripts', 'music_journal_enqueue_styles' );
function music_journal_enqueue_styles() {
    wp_enqueue_style( 'photo-journal-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'music-journal-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('photo-journal-style')
    );
}
/*
 * Your code goes below
 */

/**
 * Add an HTML class to MediaElement.js container elements to aid styling.
 *
 * Extends the core _wpmejsSettings object to add a new feature via the
 * MediaElement.js plugin API.
 */
function music_journal_mejs_add_container_class() {
	if ( ! wp_script_is( 'mediaelement', 'done' ) ) {
		return;
	}

	$next_track_text   = esc_attr__( 'Next Track', 'music-journal' );
	$prev_track_text   = esc_attr__( 'Previous Track', 'music-journal' );
	$toggle_text       = esc_attr__( 'Toggle Playlist', 'music-journal' );

	$next_track_icon = photo_journal_get_svg( array(
		'icon'     => 'next',
		'fallback' => true,
	) );

	$prev_track_icon = photo_journal_get_svg( array(
		'icon'     => 'prev',
		'fallback' => true,
	) );

	$toggle_icon = photo_journal_get_svg( array(
		'icon'     => 'playlist',
		'fallback' => true,
	) );

	$toggle_close = photo_journal_get_svg( array(
		'icon'     => 'close',
		'fallback' => true,
	) );

 	?>
	<script>
	(function() {
		var settings = window._wpmejsSettings || {};

		settings.features = settings.features || mejs.MepDefaults.features;

		settings.features.push( 'photo_journal_class' );

		MediaElementPlayer.prototype.buildphoto_journal_class = function(player, controls, layers, media) {
			if ( ! player.isVideo ) {
				var container = player.container[0] || player.container;

				container.style.height = '';
				container.style.width = '';
				player.options.setDimensions = false;
			}

			if ( jQuery( '#' + player.id ).parents('#sticky-playlist-section').length ) {
				player.container.addClass( 'mejs-container mejs-sticky-playlist-container' );

				jQuery( '#' + player.id ).parent().children('.wp-playlist-tracks').addClass('displaynone');

				var volume_slider = controls[0].children[5];

				if ( jQuery( '#' + player.id ).parent().children('.wp-playlist-tracks').length > 0) {
					var playlist_button =
					jQuery('<div class="mejs-playlist-button mejs-toggle-playlist ">' +
						'<button type="button" aria-controls="mep_0" title="<?php echo esc_attr( $toggle_text ); ?>"><?php echo $toggle_icon; ?><?php echo $toggle_close; ?>
						</button>' +
					'</div>')

					// append it to the toolbar
					.appendTo( jQuery( '#' + player.id ) )

					// add a click toggle event
					.click(function() {
						jQuery( '#' + player.id ).parent().children('.wp-playlist-tracks').slideToggle();
						jQuery( this ).toggleClass('is-open')
					});

					var play_button = controls[0].children[0];

					// Add next button after volume slider
					var next_button =
					jQuery('<div class="mejs-next-button mejs-next">' +
						'<button type="button" aria-controls="' + player.id
						+ '" title="<?php echo esc_attr( $next_track_text ); ?>"><?php echo $next_track_icon; ?></button>' +
					'</div>')

					// insert after volume slider
					.insertAfter(play_button)

					// add a click toggle event
					.click(function() {
						jQuery( '#' + player.id ).parent().find( '.wp-playlist-next').trigger('click');
					});

					// Add prev button after volume slider
					var previous_button =
					jQuery('<div class="mejs-previous-button mejs-previous">' +
						'<button type="button" aria-controls="' + player.id
						+ '" title="<?php echo esc_attr( $prev_track_text ); ?>"><?php echo $prev_track_icon; ?></button>' +
					'</div>')

					// insert after volume slider
					.insertBefore( play_button )

					// add a click toggle event
					.click(function() {
						jQuery( '#' + player.id ).parent().find( '.wp-playlist-prev').trigger('click');
					});
				}
			} else {
				player.container.addClass( 'mejs-container' );

				if ( jQuery( '#' + player.id ).parent().children('.wp-playlist-tracks').length > 0) {
					var play_button = controls[0].children[0];

					// Add next button after volume slider
					var next_button =
					jQuery('<div class="mejs-next-button mejs-next">' +
						'<button type="button" aria-controls="' + player.id
						+ '" title="<?php echo esc_attr( $next_track_text ); ?>"><?php echo $next_track_icon; ?></button>' +
					'</div>')

					// insert after volume slider
					.insertAfter(play_button)

					// add a click toggle event
					.click(function() {
						jQuery( '#' + player.id ).parent().find( '.wp-playlist-next').trigger('click');
					});

					// Add prev button after volume slider
					var previous_button =
					jQuery('<div class="mejs-previous-button mejs-previous">' +
						'<button type="button" aria-controls="' + player.id
						+ '" title="<?php echo esc_attr( $prev_track_text ); ?>"><?php echo $prev_track_icon; ?></button>' +
					'</div>')

					// insert after volume slider
					.insertBefore( play_button )

					// add a click toggle event
					.click(function() {
						jQuery( '#' + player.id ).parent().find( '.wp-playlist-prev').trigger('click');
					});
				}
			}
		}
	})();
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'music_journal_mejs_add_container_class' );

function music_journal_custom_header_and_background() {
	$default_background_color = '#000000';
	$default_text_color       = '#ffffff';

	/**
	 * Filter the arguments used when adding 'custom-background' support in Persona.
	 *
	 * @since Photo Journal 0.1
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'photo_journal_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );

	/**
	 * Filter the arguments used when adding 'custom-header' support in Persona.
	 *
	 * @since Photo Journal 0.1
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1200.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'photo_journal_custom_header_args', array(
		'default-image'      	 => get_stylesheet_directory_uri() . '/assets/images/header-image.jpg',
		'default-text-color'     => $default_text_color,
		'width'                  => 1920,
		'height'                 => 1080,
		'flex-height'            => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'photo_journal_header_style',
		'video'                  => true,
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/images/header-image.jpg',
			'thumbnail_url' => '%s/assets/images/header-image-275x155.jpg',
			'description'   => esc_html__( 'Default Header Image', 'music-journal' ),
		),
	) );
}
add_action( 'after_setup_theme', 'music_journal_custom_header_and_background' );

/**
 * Load the parent rtl.css file
 */
function music_journal_child_enqueue_rtl_style() {
	// Dynamically get version number of the parent stylesheet
	$theme   = wp_get_theme( 'photo-journal' );
	$version = $theme->get( 'version' );
	// Load the stylesheet
	if ( is_rtl() ) {
		wp_enqueue_style( 'photo-journal-rtl', get_template_directory_uri() . '/rtl.css', array('photo-journal-style'), $version );
	}
	
}
add_action( 'wp_enqueue_scripts', 'music_journal_child_enqueue_rtl_style' );

/**
 * Load Customizer Options
 */
require trailingslashit( get_stylesheet_directory() ) . 'inc/customizer/customizer.php';

/**
 * Override Parent 
 */
require trailingslashit( get_stylesheet_directory() ) . 'inc/override-parent.php';
