<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'clean-and-sober' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) { ?>
			<div class="entry-meta">
				<?php clean_and_sober_posted_on(); ?>
			</div>
		<?php } ?>
	</header>

	<?php if ( is_search() ) { // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	<?php } else { ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'clean-and-sober' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'clean-and-sober' ), 'after' => '</div>' ) ); ?>
		</div>
	<?php } ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) { // Hide category and tag text for pages on Search ?>
			<?php

			/* Translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'clean-and-sober' ) );
			if ( $categories_list && clean_and_sober_categorized_blog() ) {
				?>
				<span class="cat-links">
					<?php printf( esc_html( __( 'Posted in %1$s', 'clean-and-sober' ) ), $categories_list ); ?>
				</span>
				<span class="sep"> | </span>
			<?php }

			/* Translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'clean-and-sober' ) );
			if ( $tags_list ) {
				?>
				<span class="tag-links">
					<?php printf( esc_html( __( 'Tagged %1$s', 'clean-and-sober' ) ), $tags_list ); ?>
				</span>
				<span class="sep"> | </span>
			<?php } ?>
		<?php } ?>

		<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) { ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'clean-and-sober' ), __( '1 Comment', 'clean-and-sober' ), __( '% Comments', 'clean-and-sober' ) ); ?></span>
			<span class="sep"> | </span>
		<?php } ?>

		<?php edit_post_link( __( 'Edit', 'clean-and-sober' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
</article>