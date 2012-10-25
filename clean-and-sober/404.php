<?php get_header(); ?>
<div id="primary" class="site-content">
	<div id="content" role="main">

		<article id="post-0" class="post error404 not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php esc_html_e( "Oops! That page can't be found.", 'clean-and-sober' ); ?></h1>
			</header>

			<div class="entry-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'clean-and-sober' ); ?></p>
			</div>
		</article>

	</div>
</div>
<?php

get_footer();