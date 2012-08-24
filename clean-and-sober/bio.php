<?php

global $authordata;

if ( ( ! is_singular() || ! isset( $authordata ) ) ) {
	$old_authordata = $authordata;
	$authordata = null;
	
	if ( get_option( 'clean_and_sober_default_author_id' ) ) {
		$authordata = get_userdata( get_option( 'clean_and_sober_default_author_id' ) );
	}
}

if ( $authordata && get_the_author_meta( 'description' ) ) {
	?>
	<div class="bio">
		<p>
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
			<?php the_author_meta( 'description' ); ?> 
		</p>
		<div>
			<p>
				<?php
		
				$contact_links = array();
		
				for ( $i = 1; $i <= 3; $i++ ) {
					$contact_link = wp_kses( get_the_author_meta( 'cas_contact_' . $i ), array( 'a' => array( 'href' => array() ) ) );
			
					if ( $contact_link )
						$contact_links[] = $contact_link;
				}
		
				unset( $contact_link );
		
				if ( ! empty( $contact_links ) )
					echo join( '<br />', $contact_links );
		
				unset( $contact_links );
		
				?>
			</p>
		</div>
	</div>
	<?php
}

if ( isset( $old_authordata ) ) {
	$authordata = $old_authordata;
	unset( $old_authordata );
}

?>