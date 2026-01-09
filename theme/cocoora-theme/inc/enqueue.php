<?php
/**
 * Enqueue scripts and styles
 *
 * @package Cocoora
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue frontend scripts and styles
 */
function cocoora_scripts() {
	$manifest_path = COCOORA_DIR . '/dist/.vite/manifest.json';

	// Check if we're in development mode (Vite dev server running)
	if ( cocoora_is_dev() && ! file_exists( $manifest_path ) ) {
		// Development: Load from Vite dev server
		wp_enqueue_script(
			'vite-client',
			'http://localhost:5173/@vite/client',
			array(),
			null,
			false
		);

		wp_enqueue_script(
			'cocoora-main',
			'http://localhost:5173/src/js/main.js',
			array( 'vite-client' ),
			null,
			true
		);

		// Add type="module" to scripts
		add_filter( 'script_loader_tag', 'cocoora_add_module_type', 10, 3 );

	} elseif ( file_exists( $manifest_path ) ) {
		// Production: Load from built manifest
		$manifest = json_decode( file_get_contents( $manifest_path ), true );

		// Enqueue CSS
		if ( isset( $manifest['src/css/main.css'] ) ) {
			wp_enqueue_style(
				'cocoora-style',
				COCOORA_URI . '/dist/' . $manifest['src/css/main.css']['file'],
				array(),
				COCOORA_VERSION
			);
		}

		// Enqueue JS
		if ( isset( $manifest['src/js/main.js'] ) ) {
			wp_enqueue_script(
				'cocoora-main',
				COCOORA_URI . '/dist/' . $manifest['src/js/main.js']['file'],
				array(),
				COCOORA_VERSION,
				true
			);

			// Add type="module" to main script
			add_filter( 'script_loader_tag', 'cocoora_add_module_type', 10, 3 );
		}
	} else {
		// Fallback: Enqueue theme's style.css
		wp_enqueue_style(
			'cocoora-style',
			get_stylesheet_uri(),
			array(),
			COCOORA_VERSION
		);
	}

	// Enqueue comment reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cocoora_scripts' );

/**
 * Add type="module" to specific scripts
 *
 * @param string $tag    Script tag.
 * @param string $handle Script handle.
 * @param string $src    Script source URL.
 * @return string Modified script tag.
 */
function cocoora_add_module_type( $tag, $handle, $src ) {
	$module_handles = array( 'cocoora-main', 'vite-client' );

	if ( in_array( $handle, $module_handles, true ) ) {
		$tag = str_replace( ' src=', ' type="module" src=', $tag );
	}

	return $tag;
}

/**
 * Remove WordPress version from scripts and styles
 */
function cocoora_remove_version_scripts_styles( $src ) {
	if ( strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'style_loader_src', 'cocoora_remove_version_scripts_styles', 9999 );
add_filter( 'script_loader_src', 'cocoora_remove_version_scripts_styles', 9999 );

/**
 * Enqueue admin scripts and styles
 */
function cocoora_admin_scripts() {
	wp_enqueue_style(
		'cocoora-admin',
		COCOORA_URI . '/assets/css/admin.css',
		array(),
		COCOORA_VERSION
	);
}
add_action( 'admin_enqueue_scripts', 'cocoora_admin_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 */
function cocoora_editor_styles() {
	// Add editor styles
	add_editor_style( 'dist/css/editor.css' );
}
add_action( 'after_setup_theme', 'cocoora_editor_styles' );

/**
 * Preload critical assets
 */
function cocoora_preload_assets() {
	$manifest_path = COCOORA_DIR . '/dist/.vite/manifest.json';

	if ( file_exists( $manifest_path ) ) {
		$manifest = json_decode( file_get_contents( $manifest_path ), true );

		// Preload main CSS
		if ( isset( $manifest['src/css/main.css'] ) ) {
			printf(
				'<link rel="preload" href="%s" as="style">' . "\n",
				esc_url( COCOORA_URI . '/dist/' . $manifest['src/css/main.css']['file'] )
			);
		}
	}
}
add_action( 'wp_head', 'cocoora_preload_assets', 1 );
