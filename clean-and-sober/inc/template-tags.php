<?php

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 */

if ( ! function_exists( 'clean_and_sober_content_nav' ) ) {
	/**
	 * Display navigation to next/previous pages when applicable
	 */
	function clean_and_sober_content_nav( $nav_id ) {
		global $wp_query;

		if ( 'nav-above' == $nav_id && !get_previous_posts_link() )
			return;

		$nav_class = 'site-navigation paging-navigation';

		if ( is_single() )
			$nav_class = 'site-navigation post-navigation';

		?>
		<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
			<h1 class="assistive-text"><?php _e( 'Post navigation', 'clean-and-sober' ); ?></h1>

			<?php if ( is_single() ) { ?>
				<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'clean-and-sober' ) . '</span> %title' ); ?>
				<?php get_search_form(); ?>
				<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'clean-and-sober' ) . '</span>' ); ?>
			<?php } elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) { // navigation links for home, archive, and search pages ?>
				<?php if ( get_next_posts_link() ) { ?>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'clean-and-sober' ) ); ?></div>
				<?php } ?>
				<?php get_search_form(); ?>
				<div class="nav-next">
					<?php if ( get_previous_posts_link() ) { ?>
						<?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'clean-and-sober' ) ); ?>
					<?php } ?>
				</div>
			<?php } ?>
		</nav>
	<?php }
}

if ( ! function_exists( 'clean_and_sober_comment' ) ) {
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 */
	function clean_and_sober_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) {
			case 'pingback':
			case 'trackback':
				?>
				<li class="post pingback">
					<p><?php esc_html_e( 'Pingback:', 'clean-and-sober' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'clean-and-sober' ), ' ' ); ?></p>
				<?php
			break;
			default:
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment">
						<footer>
							<div class="comment-author vcard">
								<?php echo get_avatar( $comment, 40 ); ?>
								<?php printf( __( '%s <span class="says">says:</span>', 'clean-and-sober' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
							</div>
							<?php if ( $comment->comment_approved == '0' ) { ?>
								<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'clean-and-sober' ); ?></em>
								<br />
							<?php } ?>

							<div class="comment-meta commentmetadata">
								<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
								<?php
									/* translators: 1: date, 2: time */
									printf( esc_html( __( '%1$s at %2$s', 'clean-and-sober' ) ), get_comment_date(), get_comment_time() ); ?>
								</time></a>
								<?php edit_comment_link( __( '(Edit)', 'clean-and-sober' ), ' ' ); ?>
							</div>
						</footer>

						<div class="comment-content"><?php comment_text(); ?></div>

						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div>
					</article>
				<?php
			break;
		}
	}
}

if ( ! function_exists( 'clean_and_sober_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function clean_and_sober_posted_on() {
		printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'clean-and-sober' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'clean-and-sober' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);
	}
}

/**
 * Returns true if a blog has more than 1 category
 *
 * @since Clean and Sober 1.0
 */
function clean_and_sober_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so clean_and_sober_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so clean_and_sober_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in clean_and_sober_categorized_blog
 *
 * @since Clean and Sober 1.0
 */
function clean_and_sober_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}

add_action( 'edit_category', 'clean_and_sober_category_transient_flusher' );
add_action( 'save_post', 'clean_and_sober_category_transient_flusher' );