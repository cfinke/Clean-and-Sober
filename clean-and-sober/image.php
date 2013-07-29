<?php get_header(); ?>
<div id="primary" class="site-content">
	<div id="content" role="main">
		<?php while ( have_posts() ) { the_post(); ?>
			<?php clean_and_sober_content_nav( 'nav-above' ); ?>
			<?php get_template_part( 'content', 'image' ); ?>
			<?php get_template_part( 'bio' ); ?>
			<?php clean_and_sober_content_nav( 'nav-below' ); ?>
			<?php

			if ( comments_open() || '0' != get_comments_number() )
				comments_template( '', true );

			?>
		<?php } ?>
	</div>
</div>
<?php get_footer(); ?>