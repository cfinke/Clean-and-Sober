<?php get_header(); ?>
<div id="primary" class="site-content">
	<div id="content" role="main">
		<?php while ( have_posts() ) { the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>
			<?php get_template_part( 'bio' ); ?>
			<?php comments_template( '', true ); ?>
		<?php } ?>
	</div>
</div>
<?php get_footer(); ?>