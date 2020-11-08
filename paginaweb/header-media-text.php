<?php
/**
 * Display Header Media Text
 *
 * @package Photo_Journal
 */

$header_media_subtitle = get_theme_mod( 'photo_journal_header_media_subtitle' );
$header_media_title    = get_theme_mod( 'photo_journal_header_media_title', esc_html__( 'Header Media', 'music-journal' ) );
$header_media_text 	   = get_theme_mod( 'photo_journal_header_media_text', esc_html__( 'Photography', 'music-journal' ) );
$header_media_logo     = get_theme_mod( 'photo_journal_header_media_logo' );
$button_url  		   = get_theme_mod( 'photo_journal_header_media_url' );
$button_text 		   = get_theme_mod( 'photo_journal_header_media_url_text' );

if ( '' !== $header_media_title || '' !== $header_media_text ) : ?>
<div class="custom-header-content sections header-media-section">

	<?php if( $header_media_subtitle ) : ?>
		<div class="sub-title">
			<?php echo esc_html( $header_media_subtitle ); ?>
		</div>
	<?php endif; ?>

	<?php if ( '' !== $header_media_title ) : ?>
		<h2 class="entry-title"><?php echo wp_kses_post( $header_media_title ); ?></h2>
	<?php endif; ?>

	<?php if( $header_media_logo ) : ?>
		<div class="site-header-logo">
			<img src="<?php echo esc_url( $header_media_logo ); ?>" title="<?php echo esc_attr( home_url( '/' ) ); ?>" />
		</div><!-- .site-header-logo -->
	<?php endif; ?>

	<p class="site-header-text"><?php echo wp_kses_post( $header_media_text ); ?>
	<?php if ( $button_url || $button_text ) : ?><a class="more-link"  href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( get_theme_mod( 'photo_journal_header_url_target' ) ) ? '_blank' : '_self'; ?>"  > <span class="more-button"><?php echo esc_html( $button_text ); ?><span class="screen-reader-text"><?php echo wp_kses_post( $header_media_title ); ?><?php endif; ?></span></span></a></p>


</div>
<?php endif; ?>
