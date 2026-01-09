<?php
/**
 * Cocoora Theme Functions
 *
 * @package Cocoora
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define theme constants
 */
define( 'COCOORA_VERSION', '1.0.0' );
define( 'COCOORA_DIR', get_template_directory() );
define( 'COCOORA_URI', get_template_directory_uri() );

/**
 * Theme Setup
 */
function cocoora_setup() {
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );

	// Custom image sizes
	add_image_size( 'cocoora-hero', 1920, 800, true );
	add_image_size( 'cocoora-card', 600, 400, true );
	add_image_size( 'cocoora-thumbnail', 300, 200, true );

	// Register navigation menus
	register_nav_menus(
		array(
			'primary'   => __( 'Primary Menu', 'cocoora' ),
			'footer'    => __( 'Footer Menu', 'cocoora' ),
			'legal'     => __( 'Legal Menu', 'cocoora' ),
		)
	);

	// HTML5 support
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

	// Custom logo support
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 95,
			'width'       => 426,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Responsive embeds
	add_theme_support( 'responsive-embeds' );

	// Wide alignment for Gutenberg
	add_theme_support( 'align-wide' );

	// Editor styles
	add_theme_support( 'editor-styles' );
}
add_action( 'after_setup_theme', 'cocoora_setup' );

/**
 * Set the content width in pixels
 */
function cocoora_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cocoora_content_width', 1200 );
}
add_action( 'after_setup_theme', 'cocoora_content_width', 0 );

/**
 * Include theme files
 */
require_once COCOORA_DIR . '/inc/enqueue.php';
require_once COCOORA_DIR . '/inc/hooks.php';
require_once COCOORA_DIR . '/inc/custom-post-types.php';
require_once COCOORA_DIR . '/inc/acf-fields.php';

/**
 * Register widget areas
 */
function cocoora_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer Column 1', 'cocoora' ),
			'id'            => 'footer-1',
			'description'   => __( 'First footer column widget area.', 'cocoora' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title text-lg font-bold mb-4">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Column 2', 'cocoora' ),
			'id'            => 'footer-2',
			'description'   => __( 'Second footer column widget area.', 'cocoora' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title text-lg font-bold mb-4">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Column 3', 'cocoora' ),
			'id'            => 'footer-3',
			'description'   => __( 'Third footer column widget area.', 'cocoora' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title text-lg font-bold mb-4">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'cocoora_widgets_init' );

/**
 * Helper function to get SVG icon
 *
 * @param string $icon Icon name.
 * @param array  $args Optional arguments.
 * @return string SVG markup.
 */
function cocoora_get_icon( $icon, $args = array() ) {
	$defaults = array(
		'class'  => '',
		'width'  => 24,
		'height' => 24,
	);
	$args = wp_parse_args( $args, $defaults );

	$icon_path = COCOORA_DIR . '/assets/icons/' . $icon . '.svg';

	if ( file_exists( $icon_path ) ) {
		$svg = file_get_contents( $icon_path );
		// Add classes and dimensions
		$svg = str_replace( '<svg', sprintf( '<svg class="%s" width="%d" height="%d"', esc_attr( $args['class'] ), absint( $args['width'] ), absint( $args['height'] ) ), $svg );
		return $svg;
	}

	return '';
}

/**
 * Helper function to check if we're in development mode
 *
 * @return bool
 */
function cocoora_is_dev() {
	return defined( 'WP_ENVIRONMENT_TYPE' ) && 'local' === WP_ENVIRONMENT_TYPE;
}
