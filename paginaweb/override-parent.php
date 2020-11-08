<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Photo_Journal
 */

/**
 * Display Sections on header and footer with respect to the section option set in music_journal_sections_sort
 */
function photo_journal_sections( $selector = 'header' ) {
	get_template_part( 'template-parts/header/header', 'media' );
	get_template_part( 'template-parts/header/site', 'branding' );
	get_template_part( 'template-parts/slider/content', 'slider' );
	get_template_part( 'template-parts/playlist/content-playlist' ); 
	get_template_part( 'template-parts/featured-content/display','featured' );
	get_template_part( 'template-parts/service/content','service' );
	get_template_part( 'template-parts/hero-content/content','hero' );
	get_template_part( 'template-parts/portfolio/display', 'portfolio' );
	get_template_part( 'template-parts/sticky-playlist/content-playlist' ); 
    get_template_part( 'template-parts/testimonial/display', 'testimonial' );
}

