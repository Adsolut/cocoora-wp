<?php
/**
 * Custom hooks and filters
 *
 * @package Cocoora
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add custom classes to body tag
 *
 * @param array $classes Existing body classes.
 * @return array Modified body classes.
 */
function cocoora_body_classes( $classes ) {
	// Add a class of hfeed to non-singular pages
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class if there is a custom header
	if ( has_custom_header() ) {
		$classes[] = 'has-custom-header';
	}

	// Add class for sidebar
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'has-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'cocoora_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments
 */
function cocoora_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'cocoora_pingback_header' );

/**
 * Customize excerpt length
 *
 * @param int $length Default excerpt length.
 * @return int Custom excerpt length.
 */
function cocoora_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'cocoora_excerpt_length' );

/**
 * Customize excerpt more text
 *
 * @param string $more Default more text.
 * @return string Custom more text.
 */
function cocoora_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'cocoora_excerpt_more' );

/**
 * Calculate estimated reading time
 *
 * @param int $post_id Post ID. Defaults to current post.
 * @return string Reading time in minutes.
 */
function cocoora_reading_time( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$content    = get_post_field( 'post_content', $post_id );
	$word_count = str_word_count( strip_tags( $content ) );
	$reading_time = ceil( $word_count / 200 ); // Assuming 200 words per minute

	/* translators: %d: minutes count */
	return sprintf( _n( '%d min di lettura', '%d min di lettura', $reading_time, 'cocoora' ), $reading_time );
}

/**
 * Modify the main query
 *
 * @param WP_Query $query The WordPress Query instance.
 */
function cocoora_pre_get_posts( $query ) {
	if ( ! is_admin() && $query->is_main_query() ) {
		// Modify posts per page for archives
		if ( $query->is_archive() ) {
			$query->set( 'posts_per_page', 12 );
		}

		// Exclude services CPT from main blog
		if ( $query->is_home() ) {
			$query->set( 'post_type', 'post' );
		}
	}
}
add_action( 'pre_get_posts', 'cocoora_pre_get_posts' );

/**
 * Add custom logo class
 *
 * @param string $html Custom logo HTML.
 * @return string Modified custom logo HTML.
 */
function cocoora_custom_logo_class( $html ) {
	$html = str_replace( 'custom-logo-link', 'custom-logo-link block', $html );
	$html = str_replace( 'custom-logo', 'custom-logo h-12 w-auto', $html );
	return $html;
}
add_filter( 'get_custom_logo', 'cocoora_custom_logo_class' );

/**
 * Add defer attribute to scripts
 *
 * @param string $tag    Script tag.
 * @param string $handle Script handle.
 * @return string Modified script tag.
 */
function cocoora_defer_scripts( $tag, $handle ) {
	$defer_scripts = array(
		// Add script handles to defer here
	);

	if ( in_array( $handle, $defer_scripts, true ) ) {
		return str_replace( ' src', ' defer src', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'cocoora_defer_scripts', 10, 2 );

/**
 * Remove unnecessary WordPress features
 */
function cocoora_cleanup_head() {
	// Remove RSD link
	remove_action( 'wp_head', 'rsd_link' );

	// Remove wlwmanifest link
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// Remove generator tag
	remove_action( 'wp_head', 'wp_generator' );

	// Remove shortlink
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );

	// Remove REST API link
	remove_action( 'wp_head', 'rest_output_link_wp_head' );

	// Remove oEmbed discovery links
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

	// Remove emoji scripts
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'cocoora_cleanup_head' );

/**
 * Disable XML-RPC
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Add security headers
 */
function cocoora_security_headers() {
	if ( ! is_admin() ) {
		header( 'X-Content-Type-Options: nosniff' );
		header( 'X-Frame-Options: SAMEORIGIN' );
		header( 'X-XSS-Protection: 1; mode=block' );
		header( 'Referrer-Policy: strict-origin-when-cross-origin' );
	}
}
add_action( 'send_headers', 'cocoora_security_headers' );

/**
 * Add Alpine.js cloak styles to prevent flash of unstyled content
 */
function cocoora_alpine_cloak_styles() {
	echo '<style>[x-cloak] { display: none !important; }</style>';
}
add_action( 'wp_head', 'cocoora_alpine_cloak_styles' );
