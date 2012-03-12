<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Clean and Sober
 * @since Clean and Sober 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'clean_and_sober_credits' ); ?>
			<p><a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'clean-and-sober' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'clean-and-sober' ), 'WordPress' ); ?></a></p>
		</div><!-- .site-info -->
	</footer><!-- .site-footer .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>