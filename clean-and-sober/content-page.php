<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Clean and Sober
 * @since Clean and Sober 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'clean-and-sober' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<footer class="entry-meta">
		<ol>
			<?php
		
			$categories_list = get_the_category_list( __( ', ', 'clean-and-sober' ) );
			
			if ( $categories_list && clean_and_sober_categorized_blog() ) {
				?>
				<li class="cat-links">
					<?php printf( __( 'Posted in %1$s', 'clean-and-sober' ), $categories_list ); ?>
				</li>
			<?php } ?>
			
			<?php
		
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'clean-and-sober' ) );
		
			if ( $tags_list ) {
				?>
				<li class="tag-links">
					<?php printf( __( 'Tagged %1$s', 'clean-and-sober' ), $tags_list ); ?>
				</li>
			<?php } ?>
			
			<?php edit_post_link( __( 'Edit', 'clean-and-sober' ), '<li class="edit-link">', '</li>' ); ?>
		</ol>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->
