<?php
/**
 * Custom Post Types and Taxonomies
 *
 * @package Cocoora
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Custom Post Types
 */
function cocoora_register_post_types() {

	/**
	 * Services CPT
	 */
	$service_labels = array(
		'name'                  => _x( 'Servizi', 'Post type general name', 'cocoora' ),
		'singular_name'         => _x( 'Servizio', 'Post type singular name', 'cocoora' ),
		'menu_name'             => _x( 'Servizi', 'Admin Menu text', 'cocoora' ),
		'name_admin_bar'        => _x( 'Servizio', 'Add New on Toolbar', 'cocoora' ),
		'add_new'               => __( 'Aggiungi Nuovo', 'cocoora' ),
		'add_new_item'          => __( 'Aggiungi Nuovo Servizio', 'cocoora' ),
		'new_item'              => __( 'Nuovo Servizio', 'cocoora' ),
		'edit_item'             => __( 'Modifica Servizio', 'cocoora' ),
		'view_item'             => __( 'Visualizza Servizio', 'cocoora' ),
		'all_items'             => __( 'Tutti i Servizi', 'cocoora' ),
		'search_items'          => __( 'Cerca Servizi', 'cocoora' ),
		'parent_item_colon'     => __( 'Servizio Padre:', 'cocoora' ),
		'not_found'             => __( 'Nessun servizio trovato.', 'cocoora' ),
		'not_found_in_trash'    => __( 'Nessun servizio nel cestino.', 'cocoora' ),
		'featured_image'        => _x( 'Immagine Servizio', 'Overrides the "Featured Image"', 'cocoora' ),
		'set_featured_image'    => _x( 'Imposta immagine servizio', 'Overrides the "Set featured image"', 'cocoora' ),
		'remove_featured_image' => _x( 'Rimuovi immagine servizio', 'Overrides the "Remove featured image"', 'cocoora' ),
		'use_featured_image'    => _x( 'Usa come immagine servizio', 'Overrides the "Use as featured image"', 'cocoora' ),
		'archives'              => _x( 'Archivio Servizi', 'The post type archive label', 'cocoora' ),
		'insert_into_item'      => _x( 'Inserisci nel servizio', 'Overrides the "Insert into post"', 'cocoora' ),
		'uploaded_to_this_item' => _x( 'Caricato in questo servizio', 'Overrides the "Uploaded to this post"', 'cocoora' ),
		'filter_items_list'     => _x( 'Filtra lista servizi', 'Screen reader text', 'cocoora' ),
		'items_list_navigation' => _x( 'Navigazione lista servizi', 'Screen reader text', 'cocoora' ),
		'items_list'            => _x( 'Lista servizi', 'Screen reader text', 'cocoora' ),
	);

	$service_args = array(
		'labels'             => $service_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'servizi', 'with_front' => false ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-portfolio',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
	);

	register_post_type( 'service', $service_args );

	/**
	 * Testimonials CPT
	 */
	$testimonial_labels = array(
		'name'               => _x( 'Testimonianze', 'Post type general name', 'cocoora' ),
		'singular_name'      => _x( 'Testimonianza', 'Post type singular name', 'cocoora' ),
		'menu_name'          => _x( 'Testimonianze', 'Admin Menu text', 'cocoora' ),
		'add_new'            => __( 'Aggiungi Nuova', 'cocoora' ),
		'add_new_item'       => __( 'Aggiungi Nuova Testimonianza', 'cocoora' ),
		'edit_item'          => __( 'Modifica Testimonianza', 'cocoora' ),
		'new_item'           => __( 'Nuova Testimonianza', 'cocoora' ),
		'view_item'          => __( 'Visualizza Testimonianza', 'cocoora' ),
		'all_items'          => __( 'Tutte le Testimonianze', 'cocoora' ),
		'search_items'       => __( 'Cerca Testimonianze', 'cocoora' ),
		'not_found'          => __( 'Nessuna testimonianza trovata.', 'cocoora' ),
		'not_found_in_trash' => __( 'Nessuna testimonianza nel cestino.', 'cocoora' ),
	);

	$testimonial_args = array(
		'labels'             => $testimonial_labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'menu_icon'          => 'dashicons-format-quote',
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'testimonial', $testimonial_args );
}
add_action( 'init', 'cocoora_register_post_types' );

/**
 * Register Custom Taxonomies
 */
function cocoora_register_taxonomies() {

	/**
	 * Service Category Taxonomy
	 */
	$service_cat_labels = array(
		'name'              => _x( 'Categorie Servizi', 'taxonomy general name', 'cocoora' ),
		'singular_name'     => _x( 'Categoria Servizio', 'taxonomy singular name', 'cocoora' ),
		'search_items'      => __( 'Cerca Categorie', 'cocoora' ),
		'all_items'         => __( 'Tutte le Categorie', 'cocoora' ),
		'parent_item'       => __( 'Categoria Padre', 'cocoora' ),
		'parent_item_colon' => __( 'Categoria Padre:', 'cocoora' ),
		'edit_item'         => __( 'Modifica Categoria', 'cocoora' ),
		'update_item'       => __( 'Aggiorna Categoria', 'cocoora' ),
		'add_new_item'      => __( 'Aggiungi Nuova Categoria', 'cocoora' ),
		'new_item_name'     => __( 'Nome Nuova Categoria', 'cocoora' ),
		'menu_name'         => __( 'Categorie', 'cocoora' ),
	);

	$service_cat_args = array(
		'hierarchical'      => true,
		'labels'            => $service_cat_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'categoria-servizio' ),
	);

	register_taxonomy( 'service_category', array( 'service' ), $service_cat_args );
}
add_action( 'init', 'cocoora_register_taxonomies' );

/**
 * Flush rewrite rules on theme activation
 */
function cocoora_rewrite_flush() {
	cocoora_register_post_types();
	cocoora_register_taxonomies();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'cocoora_rewrite_flush' );

/**
 * Add custom columns to Services admin list
 *
 * @param array $columns Existing columns.
 * @return array Modified columns.
 */
function cocoora_service_columns( $columns ) {
	$new_columns = array();

	foreach ( $columns as $key => $value ) {
		$new_columns[ $key ] = $value;

		if ( 'title' === $key ) {
			$new_columns['service_icon'] = __( 'Icona', 'cocoora' );
		}
	}

	return $new_columns;
}
add_filter( 'manage_service_posts_columns', 'cocoora_service_columns' );

/**
 * Populate custom columns for Services
 *
 * @param string $column  Column name.
 * @param int    $post_id Post ID.
 */
function cocoora_service_column_content( $column, $post_id ) {
	if ( 'service_icon' === $column ) {
		$icon = get_field( 'service_icon', $post_id );
		if ( $icon ) {
			echo '<span class="dashicons ' . esc_attr( $icon ) . '"></span>';
		} else {
			echo '—';
		}
	}
}
add_action( 'manage_service_posts_custom_column', 'cocoora_service_column_content', 10, 2 );
