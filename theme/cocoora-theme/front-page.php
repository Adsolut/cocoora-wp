<?php
/**
 * The front page template - Healthcare Platform
 *
 * Matches Figma design: Patient-Doctor connection platform
 *
 * @package Cocoora
 * @since 1.0.0
 */

get_header();

// Get ACF fields (with fallbacks)
$hero_title = get_field('hero_title') ?: 'La connessione tra paziente e medico';
$hero_subtitle = get_field('hero_subtitle') ?: 'Uno spazio pensato per avvicinare persone e professionisti, rendendo il percorso di cura fluido, chiaro e umano.';
$hero_image = get_field('hero_image');
?>

<main id="primary" class="site-main">

	<!-- Hero Section -->
	<section id="hero" class="relative min-h-[90vh] flex items-center overflow-hidden">
		<!-- Background Bubbles -->
		<div class="absolute inset-0 overflow-hidden">
			<div class="bubble bubble-1"></div>
			<div class="bubble bubble-2"></div>
			<div class="bubble bubble-3"></div>
			<div class="bubble bubble-4"></div>
		</div>

		<div class="container relative z-10">
			<div class="grid lg:grid-cols-2 gap-12 items-center">
				<div class="text-center lg:text-left">
					<p class="text-cocoora-blue font-medium mb-4">Cocoora</p>
					<h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-cocoora-navy mb-6 leading-tight">
						<?php echo esc_html($hero_title); ?>
					</h1>
					<p class="text-lg text-gray-600 mb-8 max-w-xl">
						<?php echo esc_html($hero_subtitle); ?>
					</p>
					<div class="flex flex-wrap gap-4 justify-center lg:justify-start">
						<a href="#piani" class="btn-primary">
							<?php esc_html_e('Scopri i piani', 'cocoora'); ?>
						</a>
						<a href="#form" class="btn-outline">
							<?php esc_html_e('Contatta il doc', 'cocoora'); ?>
						</a>
					</div>
				</div>
				<div class="relative">
					<?php if ($hero_image) : ?>
						<img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>" class="rounded-2xl shadow-2xl">
					<?php else : ?>
						<div class="aspect-[4/3] bg-gradient-to-br from-cocoora-sky to-cocoora-light-blue rounded-2xl flex items-center justify-center">
							<span class="text-white text-6xl">👨‍⚕️</span>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- Come Funziona Section -->
	<section id="come-funziona" class="section bg-gradient-to-b from-cocoora-sky/30 to-white">
		<div class="container">
			<div class="text-center mb-12">
				<h2 class="text-3xl md:text-4xl font-bold text-cocoora-navy mb-4">
					<?php esc_html_e('Come Funziona', 'cocoora'); ?>
				</h2>
				<p class="text-gray-600 max-w-2xl mx-auto">
					<?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porttitor, ante id bibendum pharetra, arcu eros.', 'cocoora'); ?>
				</p>
			</div>

			<div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
				<!-- Per i pazienti -->
				<div class="card group hover:shadow-xl transition-shadow">
					<div class="aspect-video bg-cocoora-sky/20 rounded-t-xl overflow-hidden">
						<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/patients.jpg'); ?>" alt="Per i pazienti" class="w-full h-full object-cover" onerror="this.style.display='none'">
					</div>
					<div class="card-body">
						<h3 class="text-xl font-bold text-cocoora-navy mb-2">
							<?php esc_html_e('Per i pazienti', 'cocoora'); ?>
						</h3>
						<p class="text-gray-600">
							<?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'cocoora'); ?>
						</p>
					</div>
				</div>

				<!-- Per i medici -->
				<div class="card group hover:shadow-xl transition-shadow">
					<div class="aspect-video bg-cocoora-sky/20 rounded-t-xl overflow-hidden">
						<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/doctors.jpg'); ?>" alt="Per i medici" class="w-full h-full object-cover" onerror="this.style.display='none'">
					</div>
					<div class="card-body">
						<h3 class="text-xl font-bold text-cocoora-navy mb-2">
							<?php esc_html_e('Per i medici', 'cocoora'); ?>
						</h3>
						<p class="text-gray-600">
							<?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'cocoora'); ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Location Section -->
	<section id="location" class="section bg-cocoora-sky/30">
		<div class="container">
			<div class="text-center mb-12">
				<h2 class="text-3xl md:text-4xl font-bold text-cocoora-navy mb-4">
					<?php esc_html_e('Location', 'cocoora'); ?>
				</h2>
				<p class="text-gray-600 max-w-2xl mx-auto">
					<?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porttitor, ante id bibendum pharetra, arcu eros ullamcorper erat, in vehicula tortor tellus id magna.', 'cocoora'); ?>
				</p>
			</div>

			<!-- Photo Gallery -->
			<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
				<?php
				$gallery = get_field('location_gallery');
				if ($gallery) :
					foreach ($gallery as $image) :
				?>
					<div class="aspect-[4/3] rounded-xl overflow-hidden shadow-lg">
						<img src="<?php echo esc_url($image['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
					</div>
				<?php
					endforeach;
				else :
					for ($i = 0; $i < 4; $i++) :
				?>
					<div class="aspect-[4/3] rounded-xl overflow-hidden shadow-lg bg-gradient-to-br from-white to-cocoora-light">
						<div class="w-full h-full flex items-center justify-center text-4xl">🏥</div>
					</div>
				<?php
					endfor;
				endif;
				?>
			</div>

			<!-- Address Card -->
			<div class="flex flex-col md:flex-row items-center justify-center gap-6">
				<div class="flex items-center gap-3 bg-white rounded-full px-6 py-3 shadow-md">
					<span class="text-cocoora-blue text-2xl">📍</span>
					<div>
						<p class="font-medium text-cocoora-navy">Via Emanuele Gianturco, 92</p>
						<p class="text-sm text-gray-500">80146 Napoli NA</p>
					</div>
				</div>
				<a href="#form" class="btn-primary">
					<?php esc_html_e('Registrati', 'cocoora'); ?>
				</a>
			</div>
		</div>
	</section>

	<!-- Piani (Pricing) Section -->
	<section id="piani" class="section bg-gradient-to-b from-cocoora-sky/30 to-white">
		<div class="container">
			<div class="text-center mb-12">
				<h2 class="text-3xl md:text-4xl font-bold text-cocoora-navy mb-4">
					<?php esc_html_e('Piani', 'cocoora'); ?>
				</h2>
				<p class="text-gray-600 max-w-2xl mx-auto">
					<?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porttitor, ante id bibendum pharetra, arcu eros ullamcorper erat, in vehicula tortor tellus id magna.', 'cocoora'); ?>
				</p>
			</div>

			<div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
				<?php
				$plans = array(
					array(
						'name' => 'Basic',
						'price' => '30',
						'period' => 'per ogni ora',
						'features' => array(
							'Lorem ipsum dolor sit amet',
							'Lorem ipsum',
							'Lorem ipsum dolor',
						),
						'featured' => false,
					),
					array(
						'name' => 'Plus',
						'price' => '50',
						'period' => 'per ogni ora',
						'features' => array(
							'Lorem ipsum dolor sit amet',
							'Lorem ipsum',
							'Lorem ipsum dolor',
							'Lorem ipsum dolor sit amet',
						),
						'featured' => true,
					),
					array(
						'name' => 'Elite',
						'price' => '80',
						'period' => 'per ogni ora',
						'features' => array(
							'Lorem ipsum dolor sit amet',
							'Lorem ipsum',
							'Lorem ipsum dolor',
							'Lorem ipsum dolor sit amet',
							'Lorem ipsum dolor',
						),
						'featured' => false,
					),
				);

				foreach ($plans as $plan) :
				?>
					<div class="card <?php echo $plan['featured'] ? 'border-2 border-cocoora-blue shadow-xl' : ''; ?>">
						<div class="card-body text-center">
							<h3 class="text-lg font-medium text-gray-500 mb-2"><?php echo esc_html($plan['name']); ?></h3>
							<div class="mb-4">
								<span class="text-4xl font-bold text-cocoora-navy">€<?php echo esc_html($plan['price']); ?></span>
								<span class="text-gray-500 text-sm"><?php echo esc_html($plan['period']); ?></span>
							</div>

							<?php if ($plan['featured']) : ?>
								<a href="#form" class="btn-primary w-full mb-6">
									<?php esc_html_e('Scegli il piano', 'cocoora'); ?>
								</a>
							<?php else : ?>
								<a href="#form" class="btn-outline w-full mb-6">
									<?php esc_html_e('Scopri il piano', 'cocoora'); ?>
								</a>
							<?php endif; ?>

							<div class="text-left">
								<p class="text-sm font-medium text-cocoora-navy mb-3">
									<?php esc_html_e('Cosa comprende:', 'cocoora'); ?>
								</p>
								<ul class="space-y-2">
									<?php foreach ($plan['features'] as $feature) : ?>
										<li class="flex items-start gap-2 text-sm text-gray-600">
											<svg class="w-5 h-5 text-cocoora-blue flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
												<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
											</svg>
											<span><?php echo esc_html($feature); ?></span>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- FAQ Section -->
	<section id="faq" class="section bg-gradient-to-b from-white to-cocoora-sky/50">
		<div class="container max-w-3xl">
			<div class="text-center mb-12">
				<h2 class="text-3xl md:text-4xl font-bold text-cocoora-navy mb-4">
					<?php esc_html_e('FAQ', 'cocoora'); ?>
				</h2>
			</div>

			<div class="space-y-4" x-data="{ openFaq: null }">
				<?php
				$faqs = array(
					array(
						'question' => 'Lorem ipsum dolor sit amet adipisci?',
						'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porttitor, ante id bibendum pharetra, arcu eros ullamcorper erat, in vehicula tortor tellus id magna. Etiam porttitor, ante id bibendum pharetra, arcu eros ullamcorper erat, in vehicula tortor tellus id magna.',
					),
					array(
						'question' => 'Lorem ipsum dolor sit amet?',
						'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
					),
					array(
						'question' => 'Lorem ipsum dolor sit?',
						'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
					),
					array(
						'question' => 'Lorem ipsum dolor sit amet adipisci usque?',
						'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
					),
					array(
						'question' => 'Lorem ipsum dolor sit amet adipisci?',
						'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
					),
				);

				foreach ($faqs as $index => $faq) :
				?>
					<div class="bg-white rounded-xl shadow-sm overflow-hidden">
						<button
							@click="openFaq = openFaq === <?php echo $index; ?> ? null : <?php echo $index; ?>"
							class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors"
						>
							<span class="font-medium text-cocoora-navy"><?php echo esc_html($faq['question']); ?></span>
							<svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': openFaq === <?php echo $index; ?> }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
							</svg>
						</button>
						<div x-show="openFaq === <?php echo $index; ?>" x-collapse class="px-6 pb-4">
							<p class="text-gray-600"><?php echo esc_html($faq['answer']); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Form Section -->
	<section id="form" class="section bg-gradient-to-b from-cocoora-sky/50 to-cocoora-sky/20 relative overflow-hidden">
		<!-- Background Bubbles -->
		<div class="absolute inset-0 overflow-hidden pointer-events-none">
			<div class="bubble bubble-form-1"></div>
			<div class="bubble bubble-form-2"></div>
		</div>

		<div class="container relative z-10 max-w-2xl">
			<div class="text-center mb-10">
				<h2 class="text-3xl md:text-4xl font-bold text-cocoora-navy mb-4">
					<?php esc_html_e('Sei un medico specialista?', 'cocoora'); ?>
				</h2>
				<p class="text-gray-600">
					<?php esc_html_e('Entra a far parte del team di', 'cocoora'); ?> <strong class="text-cocoora-blue">Cocoora</strong>
				</p>
				<p class="text-sm text-gray-500"><?php esc_html_e('Compila il form.', 'cocoora'); ?></p>
			</div>

			<?php if (function_exists('wpcf7_contact_form')) : ?>
				<?php
				$forms = get_posts(array(
					'post_type' => 'wpcf7_contact_form',
					'posts_per_page' => 1,
				));
				if (!empty($forms)) :
					echo do_shortcode('[contact-form-7 id="' . $forms[0]->ID . '"]');
				endif;
				?>
			<?php else : ?>
				<form class="bg-white rounded-2xl shadow-xl p-8 space-y-6">
					<div class="grid md:grid-cols-2 gap-6">
						<div>
							<label for="nome" class="form-label"><?php esc_html_e('Nome', 'cocoora'); ?> *</label>
							<input type="text" id="nome" name="nome" required class="form-input" placeholder="<?php esc_attr_e('Es: Giovanni', 'cocoora'); ?>">
						</div>
						<div>
							<label for="cognome" class="form-label"><?php esc_html_e('Cognome', 'cocoora'); ?> *</label>
							<input type="text" id="cognome" name="cognome" required class="form-input" placeholder="<?php esc_attr_e('Rossi', 'cocoora'); ?>">
						</div>
					</div>

					<div>
						<label for="email" class="form-label"><?php esc_html_e('E-mail', 'cocoora'); ?> *</label>
						<input type="email" id="email" name="email" required class="form-input" placeholder="<?php esc_attr_e('Indirizzo e-mail valido', 'cocoora'); ?>">
					</div>

					<div>
						<label for="telefono" class="form-label"><?php esc_html_e('Recapito telefonico', 'cocoora'); ?> *</label>
						<input type="tel" id="telefono" name="telefono" required class="form-input" placeholder="<?php esc_attr_e('Preferenza: il tuo numero di cellulare e fisso', 'cocoora'); ?>">
					</div>

					<div>
						<label for="note" class="form-label"><?php esc_html_e('Note', 'cocoora'); ?></label>
						<textarea id="note" name="note" rows="4" class="form-input" placeholder="<?php esc_attr_e('Scrivi un messaggio (max 400 caratteri)', 'cocoora'); ?>"></textarea>
					</div>

					<div class="flex items-start gap-2">
						<input type="checkbox" id="privacy" name="privacy" required class="mt-1 rounded border-gray-300 text-cocoora-blue focus:ring-cocoora-blue">
						<label for="privacy" class="text-sm text-gray-600">
							<?php
							printf(
								esc_html__('Esprimo il consenso al trattamento dei dati personali', 'cocoora'),
								'<a href="' . esc_url(home_url('/privacy-policy/')) . '" class="text-cocoora-blue hover:underline">' . esc_html__('Privacy Policy', 'cocoora') . '</a>'
							);
							?>
						</label>
					</div>

					<div class="text-center">
						<button type="submit" class="btn-primary px-12">
							<?php esc_html_e('Invia la richiesta', 'cocoora'); ?>
						</button>
					</div>
				</form>
			<?php endif; ?>
		</div>
	</section>

</main>

<?php
get_footer();
