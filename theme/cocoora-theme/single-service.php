<?php
/**
 * The template for displaying single Service posts
 *
 * @package Cocoora
 * @since 1.0.0
 */

get_header();

// Get service fields
$icon        = get_field( 'service_icon' ) ?: get_post_meta( get_the_ID(), 'service_icon', true );
$features    = get_field( 'features' );
$gallery     = get_field( 'gallery' );
$cta_text    = get_field( 'cta_text' ) ?: __( 'Richiedi informazioni', 'cocoora' );
?>

<main id="primary" class="site-main">
	<?php while ( have_posts() ) : the_post(); ?>

		<!-- Hero Section -->
		<section class="bg-gradient-to-br from-cocoora-navy to-cocoora-blue text-white py-20">
			<div class="container">
				<div class="max-w-3xl">
					<?php if ( $icon ) : ?>
						<div class="w-16 h-16 flex items-center justify-center bg-white/10 rounded-xl mb-6">
							<span class="dashicons <?php echo esc_attr( $icon ); ?> text-4xl"></span>
						</div>
					<?php endif; ?>

					<h1 class="text-4xl md:text-5xl font-bold mb-4">
						<?php the_title(); ?>
					</h1>

					<?php if ( has_excerpt() ) : ?>
						<p class="text-xl opacity-90">
							<?php echo esc_html( get_the_excerpt() ); ?>
						</p>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<!-- Content Section -->
		<section class="section">
			<div class="container">
				<div class="grid lg:grid-cols-3 gap-12">
					<!-- Main Content -->
					<div class="lg:col-span-2">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="mb-8 rounded-xl overflow-hidden shadow-lg">
								<?php the_post_thumbnail( 'cocoora-hero', array( 'class' => 'w-full h-auto' ) ); ?>
							</div>
						<?php endif; ?>

						<div class="prose prose-lg max-w-none">
							<?php the_content(); ?>
						</div>

						<?php if ( $features && is_array( $features ) ) : ?>
							<div class="mt-12">
								<h2 class="text-2xl font-bold text-cocoora-navy mb-6">
									<?php esc_html_e( 'Caratteristiche', 'cocoora' ); ?>
								</h2>
								<ul class="space-y-3">
									<?php foreach ( $features as $feature ) : ?>
										<li class="flex items-start gap-3">
											<svg class="w-6 h-6 text-cocoora-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
											</svg>
											<span class="text-gray-700"><?php echo esc_html( $feature['text'] ); ?></span>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>

						<?php if ( $gallery && is_array( $gallery ) ) : ?>
							<div class="mt-12">
								<h2 class="text-2xl font-bold text-cocoora-navy mb-6">
									<?php esc_html_e( 'Galleria', 'cocoora' ); ?>
								</h2>
								<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
									<?php foreach ( $gallery as $image ) : ?>
										<a href="<?php echo esc_url( $image['url'] ); ?>" class="block aspect-square rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow">
											<img
												src="<?php echo esc_url( $image['sizes']['medium'] ); ?>"
												alt="<?php echo esc_attr( $image['alt'] ); ?>"
												class="w-full h-full object-cover"
												loading="lazy"
											>
										</a>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>

					<!-- Sidebar -->
					<aside class="lg:col-span-1">
						<div class="sticky top-24 space-y-6">
							<!-- CTA Card -->
							<div class="card">
								<div class="card-body text-center">
									<h3 class="text-xl font-bold text-cocoora-navy mb-4">
										<?php esc_html_e( 'Interessato a questo servizio?', 'cocoora' ); ?>
									</h3>
									<p class="text-gray-600 mb-6">
										<?php esc_html_e( 'Contattaci per una consulenza gratuita e personalizzata.', 'cocoora' ); ?>
									</p>
									<a href="<?php echo esc_url( home_url( '/contatti/' ) ); ?>" class="btn-primary w-full">
										<?php echo esc_html( $cta_text ); ?>
									</a>
								</div>
							</div>

							<!-- Other Services -->
							<?php
							$other_services = new WP_Query(
								array(
									'post_type'      => 'service',
									'posts_per_page' => 3,
									'post__not_in'   => array( get_the_ID() ),
									'orderby'        => 'rand',
								)
							);

							if ( $other_services->have_posts() ) :
								?>
								<div class="card">
									<div class="card-body">
										<h3 class="text-lg font-bold text-cocoora-navy mb-4">
											<?php esc_html_e( 'Altri Servizi', 'cocoora' ); ?>
										</h3>
										<ul class="space-y-3">
											<?php
											while ( $other_services->have_posts() ) :
												$other_services->the_post();
												$other_icon = get_field( 'service_icon' ) ?: get_post_meta( get_the_ID(), 'service_icon', true );
												?>
												<li>
													<a href="<?php the_permalink(); ?>" class="flex items-center gap-3 text-gray-700 hover:text-cocoora-blue transition-colors">
														<?php if ( $other_icon ) : ?>
															<span class="dashicons <?php echo esc_attr( $other_icon ); ?> text-cocoora-blue/50"></span>
														<?php endif; ?>
														<span><?php the_title(); ?></span>
													</a>
												</li>
											<?php endwhile; ?>
										</ul>
									</div>
								</div>
								<?php
								wp_reset_postdata();
							endif;
							?>
						</div>
					</aside>
				</div>
			</div>
		</section>

	<?php endwhile; ?>

	<!-- CTA Section -->
	<section class="section bg-gradient-to-r from-cocoora-blue to-cocoora-navy text-white">
		<div class="container text-center">
			<h2 class="text-3xl md:text-4xl font-bold mb-4">
				<?php esc_html_e( 'Pronto a iniziare?', 'cocoora' ); ?>
			</h2>
			<p class="text-lg opacity-90 mb-8 max-w-2xl mx-auto">
				<?php esc_html_e( 'Contattaci oggi stesso per discutere del tuo progetto e ricevere un preventivo personalizzato.', 'cocoora' ); ?>
			</p>
			<div class="flex flex-wrap justify-center gap-4">
				<a href="<?php echo esc_url( home_url( '/contatti/' ) ); ?>" class="btn bg-white text-cocoora-navy hover:bg-cocoora-light">
					<?php esc_html_e( 'Contattaci', 'cocoora' ); ?>
				</a>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>" class="btn border-2 border-white text-white hover:bg-white hover:text-cocoora-navy">
					<?php esc_html_e( 'Tutti i servizi', 'cocoora' ); ?>
				</a>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
