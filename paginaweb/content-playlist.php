<?php
/**
 * The template used for displaying playlist
 *
 * @package Music_Journal
 */
?>

<?php
$enable_section = get_theme_mod( 'photo_journal_playlist_visibility', 'disabled' );

if ( ! photo_journal_check_section( $enable_section ) ) {
	// Bail if playlist is not enabled
	return;
}

$photo_journal_id = get_theme_mod( 'photo_journal_playlist' );
$args['page_id'] = absint( $photo_journal_id );

// If $args is empty return false
if ( empty( $args ) ) {
	return;
}

// Create a new WP_Query using the argument previously created
$playlist_query = new WP_Query( $args );
if ( $playlist_query->have_posts() ) :
	while ( $playlist_query->have_posts() ) :
		$playlist_query->the_post();

		?>
		<div id="playlist-section" class="playlist-section section content-position-right">
			<div class="wrapper">

				<div class="section-content-wrapper playlist-content-wrapper layout-one">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="hentry-inner">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="post-thumbnail-background" style="background-image: url('<?php the_post_thumbnail_url(); ?>')">
									<a class="cover-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									</a>
								</div>
							<?php endif; 

							if ( has_post_thumbnail() ) : ?>
							    <div class="entry-container">
							<?php else : ?>
								<div class="entry-container full-width">
							<?php endif; ?>

							<header class="entry-header">
							    <h2 class="entry-title">
							        <a href="<?php the_permalink(); ?>">
							            <?php the_title(); ?>
							        </a>
							    </h2>
							</header><!-- .entry-header -->

							<div class="entry-content">
								<?php the_content(); ?>
							</div><!-- .entry-content -->

							<?php if ( get_edit_post_link() ) : ?>
								<footer class="entry-footer">
									<div class="entry-meta">
										<?php
											edit_post_link(
												sprintf(
													/* translators: %s: Name of current post */
													esc_html__( 'Edit %s', 'music-journal' ),
													the_title( '<span class="screen-reader-text">"', '"</span>', false )
												),
												'<span class="edit-link">',
												'</span>'
											);
										?>
									</div>
								</footer><!-- .entry-footer -->
							<?php endif; ?>
							</div><!-- .entry-container -->
						</div><!-- .hentry-inner -->
					</article><!-- #post-## -->
				</div><!-- .wrapper -->
			</div><!-- .section-content -->
		</div><!-- #playlist-section -->
	<?php
	endwhile;

	wp_reset_postdata();
endif;
