<?php
/**
 * Template Name: Contatti
 * Template for the Contact page
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
				<?php the_title(); ?>
			</h1>
			<p class="text-xl opacity-90 max-w-2xl mx-auto">
				<?php esc_html_e( 'Hai un progetto in mente? Siamo qui per aiutarti a realizzarlo.', 'cocoora' ); ?>
			</p>
		</div>
	</section>

	<!-- Contact Section -->
	<section class="section">
		<div class="container">
			<div class="grid lg:grid-cols-2 gap-12">
				<!-- Contact Form -->
				<div class="card">
					<div class="card-body">
						<h2 class="text-2xl font-bold text-cocoora-navy mb-6">
							<?php esc_html_e( 'Inviaci un messaggio', 'cocoora' ); ?>
						</h2>
						<?php
						// Check for Contact Form 7
						if ( function_exists( 'wpcf7_contact_form' ) ) {
							// Get first contact form
							$forms = get_posts( array(
								'post_type'      => 'wpcf7_contact_form',
								'posts_per_page' => 1,
							) );
							if ( ! empty( $forms ) ) {
								echo do_shortcode( '[contact-form-7 id="' . $forms[0]->ID . '"]' );
							}
						} else {
							// Fallback form
							?>
							<form action="#" method="post" class="space-y-6">
								<div class="grid md:grid-cols-2 gap-6">
									<div>
										<label for="name" class="form-label"><?php esc_html_e( 'Nome', 'cocoora' ); ?> *</label>
										<input type="text" id="name" name="name" required class="form-input">
									</div>
									<div>
										<label for="email" class="form-label"><?php esc_html_e( 'Email', 'cocoora' ); ?> *</label>
										<input type="email" id="email" name="email" required class="form-input">
									</div>
								</div>

								<div>
									<label for="phone" class="form-label"><?php esc_html_e( 'Telefono', 'cocoora' ); ?></label>
									<input type="tel" id="phone" name="phone" class="form-input">
								</div>

								<div>
									<label for="subject" class="form-label"><?php esc_html_e( 'Oggetto', 'cocoora' ); ?></label>
									<input type="text" id="subject" name="subject" class="form-input">
								</div>

								<div>
									<label for="message" class="form-label"><?php esc_html_e( 'Messaggio', 'cocoora' ); ?> *</label>
									<textarea id="message" name="message" rows="5" required class="form-input"></textarea>
								</div>

								<div class="flex items-start gap-2">
									<input type="checkbox" id="privacy" name="privacy" required class="mt-1 rounded border-gray-300 text-cocoora-blue focus:ring-cocoora-blue">
									<label for="privacy" class="text-sm text-gray-600">
										<?php
										printf(
											esc_html__( 'Ho letto e accetto la %s', 'cocoora' ),
											'<a href="' . esc_url( home_url( '/privacy-policy/' ) ) . '" class="text-cocoora-blue hover:underline">' . esc_html__( 'Privacy Policy', 'cocoora' ) . '</a>'
										);
										?>
									</label>
								</div>

								<button type="submit" class="btn-primary w-full md:w-auto">
									<?php esc_html_e( 'Invia Messaggio', 'cocoora' ); ?>
								</button>
							</form>
							<?php
						}
						?>
					</div>
				</div>

				<!-- Contact Info -->
				<div class="space-y-8">
					<div>
						<h2 class="text-2xl font-bold text-cocoora-navy mb-6">
							<?php esc_html_e( 'Informazioni di Contatto', 'cocoora' ); ?>
						</h2>
						<p class="text-gray-600 mb-8">
							<?php esc_html_e( 'Preferisci contattarci direttamente? Ecco come raggiungerci.', 'cocoora' ); ?>
						</p>
					</div>

					<div class="space-y-6">
						<!-- Address -->
						<div class="flex gap-4">
							<div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-cocoora-blue/10 text-cocoora-blue rounded-lg">
								<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
								</svg>
							</div>
							<div>
								<h3 class="font-bold text-cocoora-navy"><?php esc_html_e( 'Indirizzo', 'cocoora' ); ?></h3>
								<p class="text-gray-600">Via Emanuele Gianturco 92<br>80146 Napoli (NA), Italia</p>
							</div>
						</div>

						<!-- Phone -->
						<div class="flex gap-4">
							<div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-cocoora-blue/10 text-cocoora-blue rounded-lg">
								<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
								</svg>
							</div>
							<div>
								<h3 class="font-bold text-cocoora-navy"><?php esc_html_e( 'Telefono', 'cocoora' ); ?></h3>
								<p class="text-gray-600">
									<a href="tel:+390811822778" class="hover:text-cocoora-blue transition-colors">+39 081 1822 7784</a>
								</p>
							</div>
						</div>

						<!-- Email -->
						<div class="flex gap-4">
							<div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-cocoora-blue/10 text-cocoora-blue rounded-lg">
								<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
								</svg>
							</div>
							<div>
								<h3 class="font-bold text-cocoora-navy"><?php esc_html_e( 'Email', 'cocoora' ); ?></h3>
								<p class="text-gray-600">
									<a href="mailto:info@cocoora.it" class="hover:text-cocoora-blue transition-colors">info@cocoora.it</a>
								</p>
							</div>
						</div>

						<!-- Hours -->
						<div class="flex gap-4">
							<div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-cocoora-blue/10 text-cocoora-blue rounded-lg">
								<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
								</svg>
							</div>
							<div>
								<h3 class="font-bold text-cocoora-navy"><?php esc_html_e( 'Orari', 'cocoora' ); ?></h3>
								<p class="text-gray-600">Lun - Ven: 9:00 - 18:00</p>
							</div>
						</div>
					</div>

					<!-- Map -->
					<div class="mt-8">
						<div class="aspect-video rounded-xl overflow-hidden shadow-lg bg-gray-100">
							<iframe
								src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3018.8893025566714!2d14.288697!3d40.851944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x133b09f9b5c8d0e9%3A0x9c0b8c9c9c9c9c9c!2sVia%20Emanuele%20Gianturco%2C%2092%2C%2080146%20Napoli%20NA%2C%20Italy!5e0!3m2!1sen!2s!4v1234567890"
								width="100%"
								height="100%"
								style="border:0;"
								allowfullscreen=""
								loading="lazy"
								referrerpolicy="no-referrer-when-downgrade"
							></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
