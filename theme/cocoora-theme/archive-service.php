<?php
/**
 * The template for displaying Service archive pages
 *
 * @package Cocoora
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<!-- Hero Section -->
	<section class="bg-gradient-to-br from-cocoora-navy to-cocoora-blue text-white py-20">
		<div class="container text-center">
			<h1 class="text-4xl md:text-5xl font-bold mb-4">
				<?php post_type_archive_title(); ?>
			</h1>
			<p class="text-xl opacity-90 max-w-2xl mx-auto">
				<?php esc_html_e( 'Scopri come possiamo aiutarti a raggiungere i tuoi obiettivi con le nostre soluzioni su misura.', 'cocoora' ); ?>
			</p>
		</div>
	</section>

	<!-- Services Grid -->
	<section class="section">
		<div class="container">
			<?php if ( have_posts() ) : ?>
				<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
					<?php
					while ( have_posts() ) :
						the_post();

						// Get service fields
						$icon        = get_field( 'service_icon' ) ?: get_post_meta( get_the_ID(), 'service_icon', true );
						$description = get_field( 'short_description' ) ?: get_post_meta( get_the_ID(), 'short_description', true );
						if ( ! $description ) {
							$description = get_the_excerpt();
						}
						?>

						<article class="card group" data-animate="fade-up">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" class="block aspect-video overflow-hidden">
									<?php
									the_post_thumbnail(
										'cocoora-card',
										array(
											'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110',
										)
									);
									?>
								</a>
							<?php endif; ?>

							<div class="card-body">
								<?php if ( $icon ) : ?>
									<div class="w-12 h-12 flex items-center justify-center bg-cocoora-blue/10 text-cocoora-blue rounded-lg mb-4">
										<span class="dashicons <?php echo esc_attr( $icon ); ?> text-2xl"></span>
									</div>
								<?php endif; ?>

								<h2 class="text-xl font-bold text-cocoora-navy mb-2 group-hover:text-cocoora-blue transition-colors">
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</h2>

								<?php if ( $description ) : ?>
									<p class="text-gray-600 mb-4">
										<?php echo esc_html( wp_trim_words( $description, 20 ) ); ?>
									</p>
								<?php endif; ?>

								<a href="<?php the_permalink(); ?>" class="inline-flex items-center text-cocoora-blue font-medium group-hover:gap-2 transition-all">
									<?php esc_html_e( 'Scopri di più', 'cocoora' ); ?>
									<svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
									</svg>
								</a>
							</div>
						</article>

					<?php endwhile; ?>
				</div>

				<?php
				// Pagination
				the_posts_pagination(
					array(
						'class'     => 'mt-12',
						'prev_text' => '&larr; ' . __( 'Precedente', 'cocoora' ),
						'next_text' => __( 'Successivo', 'cocoora' ) . ' &rarr;',
					)
				);
				?>

			<?php else : ?>
				<p class="text-center text-gray-600">
					<?php esc_html_e( 'Nessun servizio disponibile.', 'cocoora' ); ?>
				</p>
			<?php endif; ?>
		</div>
	</section>

	<!-- CTA Section -->
	<section class="section bg-cocoora-light">
		<div class="container text-center">
			<h2 class="text-3xl md:text-4xl font-bold text-cocoora-navy mb-4">
				<?php esc_html_e( 'Hai un progetto in mente?', 'cocoora' ); ?>
			</h2>
			<p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
				<?php esc_html_e( 'Contattaci per una consulenza gratuita e scopri come possiamo aiutarti.', 'cocoora' ); ?>
			</p>
			<a href="<?php echo esc_url( home_url( '/contatti/' ) ); ?>" class="btn-primary">
				<?php esc_html_e( 'Richiedi un preventivo', 'cocoora' ); ?>
			</a>
		</div>
	</section>
</main>

<?php
get_footer();
