<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Clean and Sober
 * @since Clean and Sober 1.0
 */

get_header(); ?>

		<div id="primary" class="site-content">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php // clean_and_sober_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="tile">
						<p class="timestamp"><?php the_time('F jS, Y') ?></p>
						<h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
						<p class="body"><?php echo get_the_excerpt(); ?></p>
					</div>
				<?php endwhile; ?>

				<?php clean_and_sober_content_nav( 'nav-below' ); ?>

			<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'No posts to display', 'clean-and-sober' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'clean-and-sober' ), admin_url( 'post-new.php' ) ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>