<?php
/**
 * Template part for Contact section (ACF Flexible Content)
 *
 * @package Cocoora
 * @since 1.0.0
 */

// Get ACF fields
$title       = get_sub_field( 'title' );
$subtitle    = get_sub_field( 'subtitle' );
$form_id     = get_sub_field( 'contact_form_id' );
$show_info   = get_sub_field( 'show_contact_info' );
$address     = get_sub_field( 'address' ) ?: 'Via Emanuele Gianturco 92, Napoli (NA), Italia';
$phone       = get_sub_field( 'phone' ) ?: '+39 081 1822 7784';
$email       = get_sub_field( 'email' ) ?: 'info@cocoora.it';
$map_embed   = get_sub_field( 'google_maps_embed' );

?>

<section id="contatti" class="section">
	<div class="container">
		<?php if ( $title || $subtitle ) : ?>
			<header class="text-center max-w-2xl mx-auto mb-12">
				<?php if ( $title ) : ?>
					<h2 class="text-3xl md:text-4xl font-bold text-cocoora-navy mb-4">
						<?php echo esc_html( $title ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $subtitle ) : ?>
					<p class="text-lg text-gray-600">
						<?php echo esc_html( $subtitle ); ?>
					</p>
				<?php endif; ?>
			</header>
		<?php endif; ?>

		<div class="grid lg:grid-cols-2 gap-12">
			<!-- Contact Form -->
			<div class="card">
				<div class="card-body">
					<?php if ( $form_id && function_exists( 'wpcf7_contact_form' ) ) : ?>
						<?php echo do_shortcode( '[contact-form-7 id="' . absint( $form_id ) . '"]' ); ?>
					<?php else : ?>
						<!-- Fallback Form -->
						<form action="#" method="post" class="space-y-6">
							<div>
								<label for="name" class="form-label"><?php esc_html_e( 'Nome', 'cocoora' ); ?> *</label>
								<input type="text" id="name" name="name" required class="form-input">
							</div>

							<div>
								<label for="email" class="form-label"><?php esc_html_e( 'Email', 'cocoora' ); ?> *</label>
								<input type="email" id="email" name="email" required class="form-input">
							</div>

							<div>
								<label for="phone" class="form-label"><?php esc_html_e( 'Telefono', 'cocoora' ); ?></label>
								<input type="tel" id="phone" name="phone" class="form-input">
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
										/* translators: %s: privacy policy link */
										esc_html__( 'Ho letto e accetto la %s', 'cocoora' ),
										'<a href="' . esc_url( home_url( '/privacy-policy/' ) ) . '" class="text-cocoora-blue hover:underline">' . esc_html__( 'Privacy Policy', 'cocoora' ) . '</a>'
									);
									?>
								</label>
							</div>

							<button type="submit" class="btn-primary w-full">
								<?php esc_html_e( 'Invia Messaggio', 'cocoora' ); ?>
							</button>
						</form>
					<?php endif; ?>
				</div>
			</div>

			<!-- Contact Info -->
			<div class="space-y-8">
				<?php if ( $show_info ) : ?>
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
								<p class="text-gray-600"><?php echo esc_html( $address ); ?></p>
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
								<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" class="text-gray-600 hover:text-cocoora-blue">
									<?php echo esc_html( $phone ); ?>
								</a>
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
								<a href="mailto:<?php echo esc_attr( $email ); ?>" class="text-gray-600 hover:text-cocoora-blue">
									<?php echo esc_html( $email ); ?>
								</a>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<!-- Map -->
				<?php if ( $map_embed ) : ?>
					<div class="aspect-video rounded-xl overflow-hidden shadow-lg">
						<?php echo $map_embed; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
