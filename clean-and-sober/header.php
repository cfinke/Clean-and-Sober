<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<title><?php

			global $page, $paged;

			wp_title( '|', true, 'right' );

			// Add the blog name.
			bloginfo( 'name' );

			// Add the blog description for the home/front page.
			$site_description = get_bloginfo( 'description', 'display' );

			if ( $site_description && ( is_home() || is_front_page() ) )
				echo " | $site_description";

			// Add a page number if necessary:
			if ( $paged >= 2 || $page >= 2 )
				echo ' | ' . sprintf( esc_html( __( 'Page %s', 'clean-and-sober' ) ), max( $paged, $page ) );

			?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div id="page" class="hfeed site">
			<?php do_action( 'before' ); ?>

			<header id="masthead" class="site-header" role="banner">
				<hgroup>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>

				<?php if ( ! is_singular() ) { ?>
					<?php get_template_part( 'bio' ); ?>
				<?php } ?>
				
				<?php
				
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'fallback_cb' => false,
					'class' => 'nav-menu',
					'container_class' => 'main-navigation'

				) );
				
				?>
			</header>

			<div id="main">