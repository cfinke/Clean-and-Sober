<?php

/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to clean_and_sober_comment() which is
 * located in the functions.php file.
 */

?>
<div id="comments" class="comments-area">
	<?php if ( post_password_required() ) { ?>
			<p class="nopassword"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'clean-and-sober' ); ?></p>
		</div>
		<?php

		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	}

	?>
	<?php if ( have_comments() ) { ?>
		<h2 class="comments-title">
			<?php

			printf(
				esc_html( _n( 'One reply to &ldquo;%2$s&rdquo;', '%1$s replies to &ldquo;%2$s&rdquo;', get_comments_number(), 'clean-and-sober' ) ),
				number_format_i18n( get_comments_number() ),
				'<span>' . get_the_title() . '</span>'
			);

			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // There are comments to navigate through ?>
			<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
				<h1 class="assistive-text"><?php esc_html_e( 'Comment navigation', 'clean-and-sober' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'clean-and-sober' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'clean-and-sober' ) ); ?></div>
			</nav>
		<?php } ?>

		<ol class="commentlist">
			<?php

			wp_list_comments( array( 'callback' => 'clean_and_sober_comment' ) );

			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
				<h1 class="assistive-text"><?php esc_html_e( 'Comment navigation', 'clean-and-sober' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'clean-and-sober' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'clean-and-sober' ) ); ?></div>
			</nav>
		<?php } ?>
	<?php } ?>

	<?php comment_form(); ?>
</div>