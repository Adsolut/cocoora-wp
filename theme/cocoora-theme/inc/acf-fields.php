<?php
/**
 * ACF (Advanced Custom Fields) Configuration
 *
 * @package Cocoora
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enable ACF Local JSON save
 *
 * @param string $path Default JSON save path.
 * @return string Custom JSON save path.
 */
function cocoora_acf_json_save_point( $path ) {
	return COCOORA_DIR . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'cocoora_acf_json_save_point' );

/**
 * Enable ACF Local JSON load
 *
 * @param array $paths Default JSON load paths.
 * @return array Custom JSON load paths.
 */
function cocoora_acf_json_load_point( $paths ) {
	// Remove original path
	unset( $paths[0] );

	// Add custom path
	$paths[] = COCOORA_DIR . '/acf-json';

	return $paths;
}
add_filter( 'acf/settings/load_json', 'cocoora_acf_json_load_point' );

/**
 * Hide ACF admin menu in production
 * Enable by setting COCOORA_ACF_ADMIN in wp-config.php
 */
function cocoora_acf_show_admin() {
	if ( defined( 'COCOORA_ACF_ADMIN' ) && COCOORA_ACF_ADMIN ) {
		return true;
	}

	return cocoora_is_dev();
}
add_filter( 'acf/settings/show_admin', 'cocoora_acf_show_admin' );

/**
 * Add ACF Options Page
 */
function cocoora_acf_options_page() {
	if ( function_exists( 'acf_add_options_page' ) ) {

		// Main Options Page
		acf_add_options_page(
			array(
				'page_title' => __( 'Impostazioni Tema', 'cocoora' ),
				'menu_title' => __( 'Impostazioni Tema', 'cocoora' ),
				'menu_slug'  => 'theme-settings',
				'capability' => 'edit_posts',
				'redirect'   => true,
				'icon_url'   => 'dashicons-admin-customizer',
				'position'   => 59,
			)
		);

		// General Settings Sub-page
		acf_add_options_sub_page(
			array(
				'page_title'  => __( 'Impostazioni Generali', 'cocoora' ),
				'menu_title'  => __( 'Generali', 'cocoora' ),
				'parent_slug' => 'theme-settings',
			)
		);

		// Contact Info Sub-page
		acf_add_options_sub_page(
			array(
				'page_title'  => __( 'Informazioni Contatto', 'cocoora' ),
				'menu_title'  => __( 'Contatti', 'cocoora' ),
				'parent_slug' => 'theme-settings',
			)
		);

		// Social Media Sub-page
		acf_add_options_sub_page(
			array(
				'page_title'  => __( 'Social Media', 'cocoora' ),
				'menu_title'  => __( 'Social', 'cocoora' ),
				'parent_slug' => 'theme-settings',
			)
		);
	}
}
add_action( 'acf/init', 'cocoora_acf_options_page' );

/**
 * Register ACF Blocks (Gutenberg)
 */
function cocoora_register_acf_blocks() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	// Hero Block
	acf_register_block_type(
		array(
			'name'            => 'hero',
			'title'           => __( 'Hero Section', 'cocoora' ),
			'description'     => __( 'A custom hero section block.', 'cocoora' ),
			'render_template' => 'template-parts/blocks/hero.php',
			'category'        => 'cocoora',
			'icon'            => 'cover-image',
			'keywords'        => array( 'hero', 'banner', 'header' ),
			'supports'        => array(
				'align' => array( 'wide', 'full' ),
			),
		)
	);

	// Services Grid Block
	acf_register_block_type(
		array(
			'name'            => 'services-grid',
			'title'           => __( 'Services Grid', 'cocoora' ),
			'description'     => __( 'Display services in a grid layout.', 'cocoora' ),
			'render_template' => 'template-parts/blocks/services-grid.php',
			'category'        => 'cocoora',
			'icon'            => 'grid-view',
			'keywords'        => array( 'services', 'grid', 'cards' ),
		)
	);

	// CTA Block
	acf_register_block_type(
		array(
			'name'            => 'cta',
			'title'           => __( 'Call to Action', 'cocoora' ),
			'description'     => __( 'A call to action section.', 'cocoora' ),
			'render_template' => 'template-parts/blocks/cta.php',
			'category'        => 'cocoora',
			'icon'            => 'megaphone',
			'keywords'        => array( 'cta', 'action', 'button' ),
			'supports'        => array(
				'align' => array( 'wide', 'full' ),
			),
		)
	);

	// Testimonials Block
	acf_register_block_type(
		array(
			'name'            => 'testimonials',
			'title'           => __( 'Testimonials', 'cocoora' ),
			'description'     => __( 'Display testimonials carousel.', 'cocoora' ),
			'render_template' => 'template-parts/blocks/testimonials.php',
			'category'        => 'cocoora',
			'icon'            => 'format-quote',
			'keywords'        => array( 'testimonials', 'reviews', 'quotes' ),
		)
	);
}
add_action( 'acf/init', 'cocoora_register_acf_blocks' );

/**
 * Add custom block category
 *
 * @param array                   $categories Block categories.
 * @param WP_Block_Editor_Context $context    Block editor context.
 * @return array Modified block categories.
 */
function cocoora_block_categories( $categories, $context ) {
	return array_merge(
		array(
			array(
				'slug'  => 'cocoora',
				'title' => __( 'Cocoora', 'cocoora' ),
				'icon'  => 'star-filled',
			),
		),
		$categories
	);
}
add_filter( 'block_categories_all', 'cocoora_block_categories', 10, 2 );

/**
 * ACF helper function to get option field
 *
 * @param string $field_name Field name.
 * @param mixed  $default    Default value.
 * @return mixed Field value or default.
 */
function cocoora_get_option( $field_name, $default = '' ) {
	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $field_name, 'option' );
		return $value ? $value : $default;
	}
	return $default;
}
