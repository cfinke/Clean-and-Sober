<?php get_header(); ?>
<div id="primary" class="site-content">
	<div id="content" role="main">

		<?php if ( have_posts() ) { ?>
			<div>
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

		<?php } elseif ( current_user_can( 'edit_posts' ) ) { ?>
			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'No posts to display', 'clean-and-sober' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'clean-and-sober' ), admin_url( 'post-new.php' ) ); ?></p>
				</div>
			</article>

		<?php } ?>

	</div>
</div>

<?php get_footer(); ?>