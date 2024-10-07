<?php

/**

 * Abacus Plus functions and definitions

 *

 * @link https://developer.wordpress.org/themes/basics/theme-functions/

 *

 * @package Abacus_Plus

 */



if ( ! defined( '_S_VERSION' ) ) {

	// Replace the version number of the theme on each release.

	define( '_S_VERSION', '1.0.0' );

}



/**

 * Sets up theme defaults and registers support for various WordPress features.

 *

 * Note that this function is hooked into the after_setup_theme hook, which

 * runs before the init hook. The init hook is too late for some features, such

 * as indicating support for post thumbnails.

 */

function abacusplus_setup() {

	/*

		* Make theme available for translation.

		* Translations can be filed in the /languages/ directory.

		* If you're building a theme based on Abacus Plus, use a find and replace

		* to change 'abacusplus' to the name of your theme in all the template files.

		*/

	load_theme_textdomain( 'abacusplus', get_template_directory() . '/languages' );



	// Add default posts and comments RSS feed links to head.

	add_theme_support( 'automatic-feed-links' );



	/*

		* Let WordPress manage the document title.

		* By adding theme support, we declare that this theme does not use a

		* hard-coded <title> tag in the document head, and expect WordPress to

		* provide it for us.

		*/

	add_theme_support( 'title-tag' );



	/*

		* Enable support for Post Thumbnails on posts and pages.

		*

		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/

		*/

	add_theme_support( 'post-thumbnails' );



	// This theme uses wp_nav_menu() in one location.

	register_nav_menus(

		array(

			'menu-1' => esc_html__( 'Primary', 'abacusplus' ),

		)

	);



	/*

		* Switch default core markup for search form, comment form, and comments

		* to output valid HTML5.

		*/

	add_theme_support(

		'html5',

		array(

			'search-form',

			'comment-form',

			'comment-list',

			'gallery',

			'caption',

			'style',

			'script',

		)

	);



	// Set up the WordPress core custom background feature.

	add_theme_support(

		'custom-background',

		apply_filters(

			'abacusplus_custom_background_args',

			array(

				'default-color' => 'ffffff',

				'default-image' => '',

			)

		)

	);



	// Add theme support for selective refresh for widgets.

	add_theme_support( 'customize-selective-refresh-widgets' );



	/**

	 * Add support for core custom logo.

	 *

	 * @link https://codex.wordpress.org/Theme_Logo

	 */

	add_theme_support(

		'custom-logo',

		array(

			'height'      => 250,

			'width'       => 250,

			'flex-width'  => true,

			'flex-height' => true,

		)

	);

}

add_action( 'after_setup_theme', 'abacusplus_setup' );



/**

 * Set the content width in pixels, based on the theme's design and stylesheet.

 *

 * Priority 0 to make it available to lower priority callbacks.

 *

 * @global int $content_width

 */

function abacusplus_content_width() {

	$GLOBALS['content_width'] = apply_filters( 'abacusplus_content_width', 640 );

}

add_action( 'after_setup_theme', 'abacusplus_content_width', 0 );



/**

 * Register widget area.

 *

 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar

 */

function abacusplus_widgets_init() {

	register_sidebar(

		array(

			'name'          => esc_html__( 'Sidebar', 'abacusplus' ),

			'id'            => 'sidebar-1',

			'description'   => esc_html__( 'Add widgets here.', 'abacusplus' ),

			'before_widget' => '<section id="%1$s" class="widget %2$s">',

			'after_widget'  => '</section>',

			'before_title'  => '<h2 class="widget-title">',

			'after_title'   => '</h2>',

		)

	);

}

add_action( 'widgets_init', 'abacusplus_widgets_init' );



/**

 * Enqueue scripts and styles.

 */

$fonts = get_field('fonts_google_api', 'option');
$scripts = get_field('scripts', 'option');
$bootstrap = $scripts['enqueue_bootstrap'];
$slick_slider = $scripts['enqueue_slicks_slider'];

function abacusplus_scripts() {

	global $fonts;
	global $scripts;
	global $bootstrap;
	global $slick_slider;

	wp_enqueue_style('abacusplus-google-font', "' . $fonts . '", array(), mt_rand());
	if($bootstrap == true) {
		wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
	}
	if($slick_slider == true) {
		wp_enqueue_style( 'slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
    	wp_enqueue_style( 'slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css' );
	}
	wp_enqueue_style( 'abacusplus-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'abacusplus-style', 'rtl', 'replace' );

	wp_enqueue_script( 'abacusplus-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'abacusplus-main', get_template_directory_uri() . '/js/main.js', array(),  mt_rand(), true );
	if($bootstrap == true) {
		wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), mt_rand(), false);
	}
	if($slick_slider == true) {
		wp_enqueue_script( 'slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array( 'jquery' ), false, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}

}

add_action( 'wp_enqueue_scripts', 'abacusplus_scripts' );



/**

 * Implement the Custom Header feature.

 */

require get_template_directory() . '/inc/custom-header.php';



/**

 * Custom template tags for this theme.

 */

require get_template_directory() . '/inc/template-tags.php';



/**

 * Functions which enhance the theme by hooking into WordPress.

 */

require get_template_directory() . '/inc/template-functions.php';



/**

 * Customizer additions.

 */

require get_template_directory() . '/inc/customizer.php';



/**

 * Load Jetpack compatibility file.

 */

if ( defined( 'JETPACK__VERSION' ) ) {

	require get_template_directory() . '/inc/jetpack.php';

}



if( function_exists('acf_add_options_page') ) {

	acf_add_options_page([

		'page_title' => 'Site Settings',

		'position' => 2

	]);

}



function enqueue_custom_styles() {

    wp_enqueue_style('custom-styles', get_stylesheet_directory_uri() . '/sass/starter/acfstyle.scss');

	/* General Tab */

	$bg_type_solid = get_field('solid', 'option');

    /* Font Tab */

    $primary_font = get_field('primary_font', 'option');

    $secondary_font = get_field('secondary_font', 'option');

    $font_sizes = get_field('font_sizes', 'option');

    $h1 = $font_sizes['h1'];

    $h2 = $font_sizes['h2'];

    $h3 = $font_sizes['h3'];

    $h4 = $font_sizes['h4'];

    $h5 = $font_sizes['h5'];

    $h6 = $font_sizes['h6'];

    $paragraph = $font_sizes['paragraph'];

    $caption = $font_sizes['caption'];

	$h1_line_height = $font_sizes['h1_line_height'];

	$h2_line_height = $font_sizes['h2_line_height'];

	$h3_line_height = $font_sizes['h3_line_height'];

	$h4_line_height = $font_sizes['h4_line_height'];

	$h5_line_height = $font_sizes['h5_line_height'];

	$h6_line_height = $font_sizes['h6_line_height'];

	$p_line_height = $font_sizes['paragraph_line_height'];

	$c_line_height = $font_sizes['caption_line_height'];



    /* Buttons Tab */

    $transition = get_field('transition', 'option');

    $primary_button = get_field('primary_button', 'option');

    $border_radius_pb = $primary_button['border_radius'];

    $border_style_pb = $primary_button['border_style'];

    $border_width_pb = $primary_button['border_width'];

    $secondary_button = get_field('secondary_button', 'option');

    $border_radius_sb = $secondary_button['border_radius'];

    $border_style_sb = $secondary_button['border_style'];

    $border_width_sb = $secondary_button['border_width'];

    $ghost_button = get_field('ghost_button', 'option');

    $border_radius_gb = $ghost_button['border_radius'];

    $border_style_gb = $ghost_button['border_style'];

    $border_width_gb = $ghost_button['border_width'];

    $small = get_field('small', 'option');

    $font_size_sm = $small['font_size'];

    $padding_small = $small['padding'];

    $medium = get_field('medium', 'option');

    $font_size_md = $medium['font_size'];

    $padding_medium = $medium['padding'];

    $large = get_field('large', 'option');

    $font_size_lg = $large['font_size'];

    $padding_large = $large['padding'];

    $button_icon = get_field('button_icon', 'option');

    $icon = $button_icon['icon'];



    /* Colors Tab */

    $primary_color = get_field('primary_color', 'option');

		$select_color_primary = $primary_color['select_color'];

		$shades_primary = $primary_color['shades'];

			$primary_100 = $shades_primary['shade_100'];

			$primary_200 = $shades_primary['shade_200'];

			$primary_300 = $shades_primary['shade_300'];

			$primary_400 = $shades_primary['shade_400'];

			$primary_600 = $shades_primary['shade_600'];

			$primary_700 = $shades_primary['shade_700'];

			$primary_800 = $shades_primary['shade_800'];

			$primary_900 = $shades_primary['shade_900'];

    $secondary_color = get_field('secondary_color', 'option');

		$select_color_secondary = $secondary_color['select_color'];

		$shades_secondary = $secondary_color['shades'];

			$secondary_100 = $shades_secondary['shade_100'];

			$secondary_200 = $shades_secondary['shade_200'];

			$secondary_300 = $shades_secondary['shade_300'];

			$secondary_400 = $shades_secondary['shade_400'];

			$secondary_600 = $shades_secondary['shade_600'];

			$secondary_700 = $shades_secondary['shade_700'];

			$secondary_800 = $shades_secondary['shade_800'];

			$secondary_900 = $shades_secondary['shade_900'];

	$grey = get_field('grey', 'option');

		$select_color_grey = $grey['select_color'];

		$shades_grey = $grey['shades'];

			$grey_100 = $shades_grey['shade_100'];

			$grey_200 = $shades_grey['shade_200'];

			$grey_300 = $shades_grey['shade_300'];

			$grey_400 = $shades_grey['shade_400'];

			$grey_600 = $shades_grey['shade_600'];

			$grey_700 = $shades_grey['shade_700'];

			$grey_800 = $shades_grey['shade_800'];

			$grey_900 = $shades_grey['shade_900'];



	/* Fields Tab */

	$input_fields_style = get_field('input_fields_style', 'option');

		$fields_border_radius = $input_fields_style['border_radius'];

		$fields_padding = $input_fields_style['padding'];

		$fields_font_size = $input_fields_style['font_size'];

		$fields_border_width = $input_fields_style['border_width'];

		$fields_border_style = $input_fields_style['border_style'];



    // Pass the values as CSS variables to the SCSS file

    wp_add_inline_style('custom-styles', "

        :root {

			--bg-type-solid: {$bg_type_solid};

            --primary-font: {$primary_font};

            --secondary-font: {$secondary_font};

            --heading-h1: {$h1};

            --heading-h2: {$h2};

            --heading-h3: {$h3};

            --heading-h4: {$h4};

            --heading-h5: {$h5};

            --heading-h6: {$h6};

            --paragraph: {$paragraph};

            --caption: {$caption};

			--heading-h1-line-height: {$h1_line_height};

			--heading-h2-line-height: {$h2_line_height};

			--heading-h3-line-height: {$h3_line_height};

			--heading-h4-line-height: {$h4_line_height};

			--heading-h5-line-height: {$h5_line_height};

			--heading-h6-line-height: {$h6_line_height};

			--paragraph-line-height: {$p_line_height};

			--caption-line-height: {$c_line_height};

            --transition: {$transition};

            --border-radius-pb: {$border_radius_pb};

            --border-style-pb: {$border_style_pb};

            --border-width-pb: {$border_width_pb};

            --border-radius-sb: {$border_radius_sb};

            --border-style-sb: {$border_style_sb};

            --border-width-sb: {$border_width_sb};

            --border-radius-gb: {$border_radius_gb};

            --border-style-gb: {$border_style_gb};

            --border-width-gb: {$border_width_gb};

            --font-size-sm: {$font_size_sm};

            --padding-small: {$padding_small};

            --font-size-md: {$font_size_md};

            --padding-medium: {$padding_medium};

            --font-size-lg: {$font_size_lg};

            --padding-large: {$padding_large};

            --btn-icon: url('{$icon}');

            --primary-color-100: {$primary_100};

			--primary-color-200: {$primary_200};

			--primary-color-300: {$primary_300};

			--primary-color-400: {$primary_400};

			--primary-color-500: {$select_color_primary};

			--primary-color-600: {$primary_600};

			--primary-color-700: {$primary_700};

			--primary-color-800: {$primary_800};

			--primary-color-900: {$primary_900};

			--secondary-color-100: {$secondary_100};

			--secondary-color-200: {$secondary_200};

			--secondary-color-300: {$secondary_300};

			--secondary-color-400: {$secondary_400};

			--secondary-color-500: {$select_color_secondary};

			--secondary-color-600: {$secondary_600};

			--secondary-color-700: {$secondary_700};

			--secondary-color-800: {$secondary_800};

			--secondary-color-900: {$secondary_900};

			--grey-color-100: {$grey_100};

			--grey-color-200: {$grey_200};

			--grey-color-300: {$grey_300};

			--grey-color-400: {$grey_400};

			--grey-color-500: {$select_color_grey};

			--grey-color-600: {$grey_600};

			--grey-color-700: {$grey_700};

			--grey-color-800: {$grey_800};

			--grey-color-900: {$grey_900};

			--fields-border-radius: {$fields_border_radius};

			--fields-font-size: {$fields_font_size};

			--fields-border-width: {$fields_border_width};

			--fields-border-style: {$fields_border_style};

			--fields-padding: {$fields_padding};

        }

    ");
}

add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

function abacus_acf_init_block_types() {
	if (function_exists('acf_register_block_type')) {
		acf_register_block_type(array(
			'name' => 'before-after-block',
			'title' => 'Before After Block',
			'description' => 'Before After Block',
			'render_template' => 'blocks/before-after/before-after.php',
			'category' => 'default',
			'icon' => 'info',
		));

		acf_register_block_type(array(
			'name' => 'palette-block',
			'title' => 'Palette Block',
			'description' => 'Palette Block',
			'render_template' => 'blocks/palette/palette.php',
			'category' => 'default',
			'icon' => 'info',
		));
  	}
}

add_action('init', 'abacus_acf_init_block_types');

add_action( 'admin_enqueue_scripts',  function() {
    $css_version = filemtime( get_stylesheet_directory() . '/admin.css' );
    wp_enqueue_style( 'abacusplus-admin-style', get_stylesheet_directory_uri() . '/admin.css', null, $css_version );
} );