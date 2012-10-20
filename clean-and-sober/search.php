<?php get_header(); ?>
<section id="primary" class="site-content">
	<div id="content" role="main">
		<?php if ( have_posts() ) { ?>
			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'clean-and-sober' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>

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
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'clean-and-sober' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'clean-and-sober' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</article>
		<?php } ?>
	</div>
</section>
<?php get_footer(); ?>