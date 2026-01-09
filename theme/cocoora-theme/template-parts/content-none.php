<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Cocoora
 * @since 1.0.0
 */

?>

<section class="no-results not-found text-center py-16">
	<div class="max-w-lg mx-auto">
		<header class="page-header mb-8">
			<h1 class="page-title text-3xl font-bold text-cocoora-navy">
				<?php esc_html_e( 'Nessun risultato trovato', 'cocoora' ); ?>
			</h1>
		</header>

		<div class="page-content">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p class="text-gray-600 mb-6">
					<?php
					printf(
						wp_kses(
							/* translators: 1: link to WP admin new post page. */
							__( 'Pronto a pubblicare il tuo primo post? <a href="%1$s">Inizia da qui</a>.', 'cocoora' ),
							array(
								'a' => array(
									'href' => array(),
								),
							)
						),
						esc_url( admin_url( 'post-new.php' ) )
					);
					?>
				</p>

			<?php elseif ( is_search() ) : ?>

				<p class="text-gray-600 mb-6">
					<?php esc_html_e( 'Spiacenti, nessun risultato corrisponde alla tua ricerca. Prova con termini diversi.', 'cocoora' ); ?>
				</p>

				<div class="search-form-wrapper max-w-md mx-auto">
					<?php get_search_form(); ?>
				</div>

			<?php else : ?>

				<p class="text-gray-600 mb-6">
					<?php esc_html_e( 'Sembra che non ci sia nulla qui. Forse prova con una ricerca?', 'cocoora' ); ?>
				</p>

				<div class="search-form-wrapper max-w-md mx-auto">
					<?php get_search_form(); ?>
				</div>

			<?php endif; ?>
		</div>
	</div>
</section>
