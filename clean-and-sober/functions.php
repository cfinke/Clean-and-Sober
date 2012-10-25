<?php

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Clean and Sober 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 760; /* pixels */

if ( ! function_exists( 'clean_and_sober_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function clean_and_sober_setup() {
		/**
		 * Custom template tags for this theme.
		 */
		require( get_template_directory() . '/inc/template-tags.php' );

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 */
		load_theme_textdomain( 'clean-and-sober', get_template_directory() . '/languages' );

		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Add support for the Aside and Gallery Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
		
		/**
		 * There's a menu available at the top of the page under the masthead.
		 */
		register_nav_menu( 'primary', __( 'Primary Menu', 'clean-and-sober' ) );
	}
}
add_action( 'after_setup_theme', 'clean_and_sober_setup' );

/**
 * Enqueue scripts and styles
 */
function clean_and_sober_scripts() {
	global $post;

	wp_enqueue_style( 'reset', get_stylesheet_directory_uri() . '/reset.css' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'responsive', get_stylesheet_directory_uri() . '/responsive.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'clean_and_sober_scripts' );

add_action( 'show_user_profile', 'clean_and_sober_contact_links' );
add_action( 'edit_user_profile', 'clean_and_sober_contact_links' );

function clean_and_sober_contact_links( $user ) { ?>
	<h3><?php esc_html_e( 'Contact links for your bio', 'clean-and-sober' ); ?></h3>

	<table class="form-table">
		<tr>
			<th rowspan="3">
				<span class="description"><?php esc_html_e( 'Enter HTML for contact links that will appear next to your bio.', 'clean-and-sober' ); ?></span>
			</th>
			<td>
				<input size="50" type="text" name="cas_contact_1" value="<?php esc_attr_e( get_the_author_meta( 'cas_contact_1', $user->ID ) ); ?>" />
			</td>
		</tr>
		<tr>
			<td>
				<input size="50" type="text" name="cas_contact_2" value="<?php esc_attr_e( get_the_author_meta( 'cas_contact_2', $user->ID ) ); ?>" />
			</td>
		</tr>
		<tr>
			<td>
				<input size="50" type="text" name="cas_contact_3" value="<?php esc_attr_e( get_the_author_meta( 'cas_contact_3', $user->ID ) ); ?>" />
			</td>
		</tr>
	</table>
<?php }

add_action( 'personal_options_update', 'clean_and_sober_save_contact_links' );
add_action( 'edit_user_profile_update', 'clean_and_sober_save_contact_links' );

function clean_and_sober_save_contact_links( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) )
		return false;

	update_usermeta( $user_id, 'cas_contact_1', $_POST['cas_contact_1'] );
	update_usermeta( $user_id, 'cas_contact_2', $_POST['cas_contact_2'] );
	update_usermeta( $user_id, 'cas_contact_3', $_POST['cas_contact_3'] );
}

function clean_and_sober_default_title( $title ) {
	if ( ! $title ) {
		return esc_html( __( '[Untitled]', 'clean-and-sober' ) );
	}

	return $title;
}

add_filter( 'the_title', 'clean_and_sober_default_title' );

function clean_and_sober_widgets() {
	register_sidebar( array(
		'id' => 'footer-widgets'
	) );
}

add_action( 'widgets_init', 'clean_and_sober_widgets' );

function clean_and_sober_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'clean_and_sober_default_author_section', array(
		'title'          => __( 'Default Bio', 'clean-and-sober' ),
		'priority'       => 35,
	) );
	
	$default_user = get_theme_mod( 'default_author_id' );
	
	if ( $default_user < 0 ) $default_user = 0;
	
	$wp_customize->add_setting( 'default_author_id', array(
	    'default'        => $default_user
	) );
	
	$choices = array(
		'0' => __( 'None', 'clean-and-sober' )
	);
	
	$users = get_users();
	
	foreach ( (array) $users as $user ) {
		$choices[$user->ID] = $user->display_name;
	}
	
	$wp_customize->add_control( 'clean_and_sober_default_author_id_dropdown', array(
		'label'   => __( 'Default user for header bio:', 'clean-and-sober' ),
		'section' => 'clean_and_sober_default_author_section',
 		'settings' => 'default_author_id',
		'type'    => 'select',
		'choices'    => $choices
	) );
}

add_action( 'customize_register', 'clean_and_sober_customize_register' );