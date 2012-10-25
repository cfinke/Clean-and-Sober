<?php
/**
 * The template for displaying Archive pages.
 *
 * @see http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>
<section id="primary" class="site-content">
	<div id="content" role="main">

	<?php if ( have_posts() ) { ?>
		<header class="page-header">
			<h1 class="page-title">
				<?php

				if ( is_category() ) {
					printf( esc_html( __( 'Category Archives: %s', 'clean-and-sober' ) ), '<span>' . single_cat_title( '', false ) . '</span>' );
				} elseif ( is_tag() ) {
					printf( esc_html( __( 'Tag Archives: %s', 'clean-and-sober' ) ), '<span>' . single_tag_title( '', false ) . '</span>' );
				} elseif ( is_author() ) {
					/* Queue the first post, that way we know
					 * what author we're dealing with (if that is the case).
					*/
					the_post();

					printf( esc_html( __( 'Author Archives: %s', 'clean-and-sober' ) ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );

					/* Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();
				} elseif ( is_day() ) {
					printf( esc_html( __( 'Daily Archives: %s', 'clean-and-sober' ) ), '<span>' . get_the_date() . '</span>' );
				} elseif ( is_month() ) {
					printf( esc_html( __( 'Monthly Archives: %s', 'clean-and-sober' ) ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
				} elseif ( is_year() ) {
					printf( esc_html( __( 'Yearly Archives: %s', 'clean-and-sober' ) ), '<span>' . get_the_date( 'Y' ) . '</span>' );
				} else {
					esc_html_e( 'Archives', 'clean-and-sober' );
				}

				?>
			</h1>
			<?php

			if ( is_category() ) {
				// show an optional category description
				$category_description = category_description();

				if ( ! empty( $category_description ) )
					echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );
			} elseif ( is_tag() ) {
				// show an optional tag description
				$tag_description = tag_description();

				if ( ! empty( $tag_description ) )
					echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
			}

			?>
		</header>

		<?php rewind_posts(); ?>

		<div class="tiles">
			<?php while ( have_posts() ) { the_post(); ?>
				<div <?php post_class( 'tile' ); ?>>
					<p class="timestamp"><?php the_time('F jS, Y') ?></p>
					<h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					<?php if ( ! empty( $post->post_excerpt ) ) { ?>
						<p class="body"><?php echo get_the_excerpt(); ?></p>
					<? } ?>
				</div>
			<?php } ?>
		</div>

		<?php clean_and_sober_content_nav( 'nav-below' ); ?>
	<?php } else { ?>
		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'clean-and-sober' ); ?></h1>
			</header>

			<div class="entry-content">
				<p><?php esc_html_e( "It seems we can't find what you're looking for. Perhaps searching can help.", 'clean-and-sober' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</article>
	<?php } ?>

	</div>
</section>
<?php

get_footer();