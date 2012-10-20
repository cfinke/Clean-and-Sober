<?php
/**
 * Clean and Sober functions and definitions
 *
 * @package Clean and Sober
 * @since Clean and Sober 1.0
 */

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' ); 

function theme_options_init(){
	register_setting( 'clean_and_sober_options', 'clean_and_sober_default_author_id', 'intval' );
} 

function theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'sampletheme' ), __( 'Theme Options', 'sampletheme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

function theme_options_do_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>". __( 'Clean and Sober Theme Options', 'clean-and-sober' ) . "</h2>"; ?>
	
		<?php if ( isset( $_REQUEST['settings-updated'] ) && $_REQUEST['settings-updated'] ) { ?>
			<div id="message" class="updated">
				<p><strong><?php _e( 'Options saved', 'clean-and-sober' ); ?></strong></p>
			</div>
		<?php } ?>
		<form method="post" action="options.php">
			<?php settings_fields( 'clean_and_sober_options' ); ?>  

			<table class="form-table">
				<tr>
					<th>
						<label for="clean_and_sober_default_author_id"><?php _e( 'Default user for header bio:', 'clean-and-sober' ); ?></label>
						<p>
							<span class="description"><?php _e( "On pages that don't have an author (search pages, archives, etc.), this user's bio will be shown at the top of the page. To disable, set to 'None.'", 'clean-and-sober' ); ?></span>
						</p>
					</th>
					<td style="vertical-align: top;">
						<?php
						
						wp_dropdown_users( array(
								'show_option_none' => __( 'None', 'clean-and-sober' ),
								'id' => 'clean_and_sober_default_author_id',
								'name' => 'clean_and_sober_default_author_id',
								'selected' => get_option( 'clean_and_sober_default_author_id' )
						) );
						
						?>
					</td>
				</tr>
			</table>
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'customtheme' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}
	
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Clean and Sober 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 760; /* pixels */

if ( ! function_exists( 'clean_and_sober_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Clean and Sober 1.0
 */
function clean_and_sober_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * WordPress.com-specific functions and definitions
	 */
	//require( get_template_directory() . '/inc/wpcom.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Clean and Sober, use a find and replace
	 * to change 'clean-and-sober' to the name of your theme in all the template files
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
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'clean-and-sober' ),
	) );

	/**
	 * Add support for the Aside and Gallery Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
}
endif; // clean_and_sober_setup
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
	<h3>Contact links for your bio</h3>

	<table class="form-table">
		<tr>
			<th rowspan="3">
				<span class="description">Enter HTML for contact links that will appear next to your bio.</span>
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
		return __( '[Untitled]', 'clean-and-sober' );
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