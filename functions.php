<?php

/**
 * Blue Lite Main Functions
 * ! adapted from Blue Haze
 *
 * @package Blue Lite
 */

/* Default WordPress Width */
if (! isset($content_width)) {
	$content_width = 1170;
}


/**
 * Setup Theme & Register Support Features.
 */
if (! function_exists('BlueThemesSetup')) {
	function BlueThemesSetup()
	{
		/**
		 * Make Theme Available for Translation
		 * Translations can be filed in the /languages/ directory
		 *
		 * Copied from Underscores Theme
		 */
		load_theme_textdomain('blue-lite', get_template_directory() . '/languages');

		/* Add Theme Support - title-tag */
		add_theme_support('title-tag');

		/* Add Theme Support - Post and Comment Automatic Feed Links */
		add_theme_support('automatic-feed-links');

		/* Enable Support for Post Thumbnail or Feature Image on Posts and Pages */
		add_theme_support('post-thumbnails');

		/* Allow the use of HTML5 Markup (for WordPress) */
		/** @disregard P1010 */
		if (version_compare(function_exists('classicpress_version') ? classicpress_version() : '0', '2', '<=')) {
			add_theme_support('html5');
		}

		/* Add Menu Support */
		register_nav_menus(array( 'primary' => __('Primary Menu', 'blue-lite') ));

		/* Add Post Format Support */
		add_theme_support('post-formats', array( 'aside', 'quote' ));

		/**
		 * Rename Default Post Formats
		 */
		function rename_post_formats($safe_text)
		{
			if ($safe_text === 'Quote') {
				return 'Barebones';
			}
			if ($safe_text === 'Aside') {
				return 'Blue Haze';
			}

			return $safe_text;
		}
		add_filter('esc_html', 'rename_post_formats');

		/**
		 * Rename Formats in Posts Table
		 */
		function live_rename_formats()
		{
			global $current_screen;

			if ($current_screen->id === 'edit-post') { ?>
				<script type="text/javascript">
					jQuery('document').ready(function() {

						jQuery("span.post-state-format").each(function() {
							if (jQuery(this).text() == "Quote")
								jQuery(this).text("Barebones");
							if (jQuery(this).text() == "Aside")
								jQuery(this).text("Blue Haze");
						});

					});
				</script>
<?php }
		}
		add_action('admin_head', 'live_rename_formats');

		/* Add support for Custom Background */
		add_theme_support(
			'custom-background',
			apply_filters(
				'bootstrap_basic_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);
	}
}
add_action('after_setup_theme', 'BlueThemesSetup');


/**
 * Register Widget Areas
 */
if (! function_exists('bootstrapBasicWidgetsInit')) {
	function bootstrapBasicWidgetsInit()
	{
		register_sidebar(
			array(
				'name'          => __('Sidebar Right', 'blue-lite'),
				'id'            => 'sidebar-right',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h1 class="widget-title">',
				'after_title'   => '</h1>',
			)
		);

		register_sidebar(
			array(
				'name'          => __('Sidebar Left', 'blue-lite'),
				'id'            => 'sidebar-left',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h1 class="widget-title">',
				'after_title'   => '</h1>',
			)
		);

		register_sidebar(
			array(
				'name'          => __('Title Header Right', 'blue-lite'),
				'id'            => 'header-right',
				'description'   => __('Header widget area on the right side next to site title.', 'blue-lite'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h1 class="widget-title">',
				'after_title'   => '</h1>',
			)
		);

		register_sidebar(
			array(
				'name'          => __('Custom Footer', 'blue-lite'),
				'id'            => 'footer-custom',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<strong>',
				'after_title'   => '</strong>',
			)
		);
	}
}
add_action('widgets_init', 'bootstrapBasicWidgetsInit');


/**
 * Registers Custom CSS File URL for the Customizer.
 */
function mytheme_customize_register($wp_customize)
{
	// Add a section for the custom CSS URL
	$wp_customize->add_section('custom_css_section', array(
		'title'       => __('Custom CSS File', 'blue-lite'),
		'description' => __('Add URL for a Custom CSS file.', 'blue-lite'),
		'priority'    => 30,
	));

	// Add a setting for the custom CSS URL
	$wp_customize->add_setting('custom_css_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));

	// Add a control for the custom CSS URL
	$wp_customize->add_control('custom_css_url', array(
		'label'    => __('Custom CSS URL', 'blue-lite'),
		'section'  => 'custom_css_section',
		'settings' => 'custom_css_url',
		'type'     => 'url',
	));
}
add_action('customize_register', 'mytheme_customize_register');


/**
 * Determine if Block Editor (Gutenberg) Support Needed
 */
function is_blocks_active()
{
	/* Gutenberg Plugin is Installed and Activated */
	$gutenberg = ! (false === has_filter('replace_editor', 'gutenberg_init'));
	/* Block Editor since v5.0 */
	$block_editor = version_compare($GLOBALS['wp_version'], '5.0-beta', '>');
	if (! $gutenberg && ! $block_editor) {
		return false;
	}
	/* ClassicPress Check - Disable Blocks */
	global $cp_version;
	if ($cp_version) {
		return false;
	} elseif (is_classic_editor_plugin_active()) {
		// Check if Classic Editor Plugin is set to Block Editor Mode in WP
		$editor_option       = get_option('classic-editor-replace');
		$block_editor_active = array( 'no-replace', 'block' );
		return in_array($editor_option, $block_editor_active, true);
	}
	return true;
}

/**
 * Check if Classic Editor Plugin is Active.
 */
function is_classic_editor_plugin_active()
{
	if (! function_exists('is_plugin_active')) {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
	}
	if (is_plugin_active('classic-editor/classic-editor.php')) {
		return true;
	}
	return false;
}

$isblock = is_blocks_active();
if (($isblock === false)) {
	// if( class_exists( 'Classic_Editor' ) ) {
	function smartwp_remove_wp_block_library_css()
	{
		wp_dequeue_style('wp-block-library');
		wp_dequeue_style('wp-block-library-theme');
		wp_dequeue_style('global-styles'); // REMOVE THEME.JSON
		wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
		wp_dequeue_style('classic-theme-styles'); // Testing that this is not needed
	}
	add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);
} else {
	// START GUTENBERG SUPPORT CODE --------------------------------------------------------------------------------------
	// @since 1.1 or WordPress 5.0+
	// @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/ reference.
	// add wide alignment ( https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#wide-alignment )
	add_theme_support('align-wide');
	// support default block styles for front-end ( https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#default-block-styles )
	add_theme_support('wp-block-styles');
	// support editor styles ( https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#editor-styles )
	// this one make appearance in editor more close to Bootstrap 3.
	add_theme_support('editor-styles');
	// support responsive embeds for front-end ( https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#responsive-embedded-content )
	add_theme_support('responsive-embeds');
	// END GUTENBERG SUPPORT CODE ----------------------------------------------------------------------------------------

	include_once get_template_directory() . '/inc/BootstrapBasicWp5.php';
}


/**
 * ENQUEUE SCRIPTS AND STYLES START
 */
if (! function_exists('blueThemesEnqueueScripts')) {
	function blueThemesEnqueueScripts()
	{
		//      global $wp_scripts;
		$Theme        = wp_get_theme();
		$themeVersion = $Theme->get('Version');
		unset($Theme);

		/* WIDE PAGE STYLESHEET */
		if (basename(get_page_template()) === 'page-wide.php' || basename(get_page_template()) === 'page-clean-wide.php' || basename(get_page_template()) === 'page-notitle-wide.php' || basename(get_page_template()) === 'single-wide.php' || basename(get_page_template()) === 'single-notitle-wide.php' || basename(get_page_template()) === 'single-clean-wide.php') {
			wp_enqueue_style('wide-stylesheet', get_template_directory_uri() . '/css/wide.css', array(), null);
		}

		/* BLUE LITE STYLE.CSS */
		wp_enqueue_style('blue-lite-styles', get_stylesheet_uri(), array(), $themeVersion);

		/* BOOTSTRAP 3.4.1 STYLESHEETS */
		wp_enqueue_style('bootstrap-styles', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.4.1');
		wp_enqueue_style('bootstrap-theme-styles', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), '3.4.1');

		/* BLUE THEMES STYLESHEET */
		wp_enqueue_style('blue-lite-css', get_template_directory_uri() . '/css/blue-lite.css', array(), $themeVersion);

		/* CUSTOM USER STYLESHEET */
		$custom_css_url = get_theme_mod('custom_css_url');

		if (! empty($custom_css_url)) {
			wp_enqueue_style('custom-css', esc_url($custom_css_url));
		}

		/* BOOTSTRAP 3.4.1 SCRIPT */
		wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array( 'jquery' ), '3.4.1', true);

		/* BLUE LITE MENU TOGGLE */
		wp_enqueue_script('blue-lite-menu', get_template_directory_uri() . '/js/blue-lite-menu.js', array( 'jquery' ), '1.0.0', true);


		/* I DON'T THINK THIS IS NEEDED ANYMORE */
		// wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array(), '3.6.0-20190314', true);

		/* JS that is loaded for old browsers - may not be needed */
		/*      wp_register_script('respond-script', get_template_directory_uri() . '/js/vendor/respond.min.js', array(), '1.4.2', true);
		$wp_scripts->add_data('respond-script', 'conditional', 'lt IE 9');
		wp_enqueue_script('respond-script');
		wp_register_script('html5-shiv-script', get_template_directory_uri() . '/js/vendor/html5shiv.min.js', array(), '3.7.3', true);
		$wp_scripts->add_data('html5-shiv-script', 'conditional', 'lte IE 9');
		wp_enqueue_script('html5-shiv-script');
		*/

		/* JQuery Scripts ( https://wordpress.stackexchange.com/a/225936/41315 ) */
		//      $wp_scripts->add_data('jquery', 'group', 1);
		//      $wp_scripts->add_data('jquery-core', 'group', 1);
		//      $wp_scripts->add_data('jquery-migrate', 'group', 1);


		/* WP Comments */
		if (is_singular() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
}

/**
 * ENQUEUE SCRIPTS AND STYLES END
 */
add_action('wp_enqueue_scripts', 'blueThemesEnqueueScripts');


/**
 * ADD SUPPORT FOR CUSTOM LOGO
 */
function theme_support_options()
{
	$defaults = array(
		'height'      => 100,
		'width'       => 280,
		'flex-height' => false, // <-- setting both flex-height and flex-width to false maintains an aspect ratio
		'flex-width'  => false,
	);
	add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'theme_support_options');


/**
 * CHANGE COMMENT FORM TEXT
 */
add_filter('comment_form_defaults', 'wpse33039_form_defaults');
function wpse33039_form_defaults($defaults)
{
	$defaults['title_reply'] = '';
	return $defaults;
}
add_filter('comment_form_logged_in', 'unset_login_field');
function unset_login_field($fields)
{
	unset($fields);
	// return $fields;
}


/* Custom template tags for this theme */
require get_template_directory() . '/inc/template-tags.php';

/* Custom functions that act independently of the theme templates */
require get_template_directory() . '/inc/extras.php';

/* Template Functions */
require get_template_directory() . '/inc/template-functions.php';


/* Remove Admin Bar from Front End*/
//show_admin_bar( false );


/**
 * --------------------------------------------------------------
 * Theme Widget & Widget Hooks
 * --------------------------------------------------------------
 */
require get_template_directory() . '/inc/widgets/BootstrapBasicAutoRegisterWidgets.php';
$BootstrapBasicAutoRegisterWidgets = new BootstrapBasicAutoRegisterWidgets();
$BootstrapBasicAutoRegisterWidgets->registerAll();
unset($BootstrapBasicAutoRegisterWidgets);
require get_template_directory() . '/inc/template-widgets-hook.php';


/* Check for Theme Update */
require 'vendor/bh-update/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://cs.elite-star-services.com/wp-repo/?action=get_metadata&slug=blue-lite',
	__FILE__, // Full path to the main plugin file or functions.php.
	'blue-lite'
);



/* BLUE HAZE ADMIN NOTIFICATION EXAMPLE */
/* v2.0.0 REQUIRES WARNING IF UPGRADING - BREAKING CHANGES */

/* Check if Upgrade */
/*
$ug_dir = get_home_path() . "/wp-content/uploads/bluehaze";

if (( current_user_can( 'install_themes' )) && (file_exists($ug_dir))) {
	require_once get_template_directory() . '/inc/BlueHazeNotify.php';
}
*/
