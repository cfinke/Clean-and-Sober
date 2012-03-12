<?php
/**
 * @package Clean and Sober
 * @since Clean and Sober 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<p class="timestamp"><?php the_time('l, F jS, Y') ?></p>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <p class="body"><?php echo get_the_excerpt(); ?></p>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'clean-and-sober' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
