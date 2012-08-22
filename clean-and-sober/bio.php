<div class="bio">
	<p>
		<?php echo get_avatar( get_the_author_meta('ID'), 100 ); ?>
		<?php the_author_description(); ?> 
	</p>
	<div>
		<p>
			<a href="mailto:<?php esc_attr_e( get_the_author_meta( 'user_email' ) ); ?>"><?php esc_html_e( get_the_author_meta( 'user_email' ) ); ?></a><br />
			Twitter: <a href="http://twitter.com/cfinke">@cfinke</a><br />
			GitHub: <a href="http://github.com/cfinke">cfinke</a>
		</p>
	</div>
</div>