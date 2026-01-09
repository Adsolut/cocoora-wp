<?php
/**
 * Front Page Template - Pixel Perfect Figma Match
 *
 * Sections: Hero, Come Funziona, Location, Piani, FAQ, Form
 *
 * @package Cocoora
 * @since 2.0.0
 */

get_header();

// ACF Fields with fallbacks
$hero_title = get_field('hero_title') ?: 'La connessione tra paziente e medico';
$hero_subtitle = get_field('hero_subtitle') ?: 'Uno spazio pensato per avvicinare persone e professionisti, rendendo il percorso di cura fluido, chiaro e umano.';
?>

<main id="primary" class="site-main">

	<!-- ============================================
	     HERO SECTION
	     ============================================ -->
	<section id="hero" class="relative min-h-[90vh] flex items-center overflow-hidden">
		<!-- Background Bubbles -->
		<div class="absolute inset-0 pointer-events-none overflow-hidden">
			<div class="absolute -top-20 -right-20 w-[500px] h-[500px] rounded-full bg-gradient-to-br from-cocoora-sky/60 to-cocoora-cyan/30 blur-sm"></div>
			<div class="absolute top-40 right-40 w-[350px] h-[350px] rounded-full bg-gradient-to-br from-cocoora-cyan/40 to-cocoora-light-blue/20 blur-sm"></div>
			<div class="absolute bottom-20 left-10 w-[250px] h-[250px] rounded-full bg-gradient-to-br from-cocoora-sky/50 to-cocoora-cyan/25 blur-sm"></div>
			<div class="absolute top-1/2 left-5 w-[180px] h-[180px] rounded-full bg-gradient-to-br from-cocoora-light-blue/30 to-cocoora-sky/20 blur-sm"></div>
		</div>

		<div class="container relative z-10">
			<div class="grid lg:grid-cols-2 gap-12 items-center">
				<!-- Text Content -->
				<div class="text-center lg:text-left">
					<p class="text-cocoora-blue font-medium text-lg mb-4">Cocoora</p>
					<h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-heading text-cocoora-navy mb-6 leading-tight">
						<?php echo esc_html($hero_title); ?>
					</h1>
					<p class="text-lg text-gray-600 mb-8 max-w-xl mx-auto lg:mx-0">
						<?php echo esc_html($hero_subtitle); ?>
					</p>
					<div class="flex flex-wrap gap-4 justify-center lg:justify-start">
						<a href="#piani" class="inline-flex items-center justify-center px-8 py-3 bg-cocoora-blue text-white font-semibold rounded-full hover:bg-cocoora-navy transition-colors shadow-lg shadow-cocoora-blue/25">
							<?php esc_html_e('Scopri i piani', 'cocoora'); ?>
						</a>
						<a href="#form" class="inline-flex items-center justify-center px-8 py-3 border-2 border-cocoora-blue text-cocoora-blue font-semibold rounded-full hover:bg-cocoora-blue hover:text-white transition-colors">
							<?php esc_html_e('Contatta il doc', 'cocoora'); ?>
						</a>
					</div>
				</div>

				<!-- Hero Image Area -->
				<div class="relative hidden lg:block">
					<?php
					$hero_image = get_field('hero_image');
					if ($hero_image) :
					?>
						<img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>" class="rounded-2xl shadow-2xl">
					<?php else : ?>
						<!-- Hero Visual from Figma -->
						<div class="relative">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hero-visual.png" alt="<?php esc_attr_e('Cocoora - Paziente e Medico', 'cocoora'); ?>" class="max-w-lg mx-auto drop-shadow-2xl">
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- ============================================
	     COME FUNZIONA SECTION
	     ============================================ -->
	<section id="come-funziona" class="py-20 md:py-28 bg-gradient-to-b from-cocoora-sky/30 to-white">
		<div class="container">
			<!-- Section Header -->
			<div class="text-center max-w-3xl mx-auto mb-16">
				<h2 class="text-3xl md:text-4xl font-bold font-heading text-cocoora-navy mb-6">
					<?php esc_html_e('Come Funziona', 'cocoora'); ?>
				</h2>
				<p class="text-gray-600 leading-relaxed">
					<?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porttitor, ante id bibendum pharetra, arcu eros.', 'cocoora'); ?>
				</p>
				<p class="text-gray-600 leading-relaxed mt-4">
					<?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porttitor ante id bibendum pharetra, arcu eros ullamcorper erat, in vehicula tortor tellus id magna. Sed ipsum magna, commodo sed leo sollicitudin, dapibus fermentum libero.', 'cocoora'); ?>
				</p>
			</div>

			<!-- Cards Grid -->
			<div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
				<!-- Per i pazienti -->
				<div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-xl transition-shadow">
					<div class="aspect-video bg-gradient-to-br from-cocoora-sky/40 to-cocoora-light-blue/30 overflow-hidden">
						<?php
						$patients_image = get_field('patients_image');
						if ($patients_image) :
						?>
							<img src="<?php echo esc_url($patients_image['url']); ?>" alt="<?php echo esc_attr($patients_image['alt']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
						<?php else : ?>
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/card-pazienti.png" alt="<?php esc_attr_e('Per i pazienti', 'cocoora'); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
						<?php endif; ?>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold font-heading text-cocoora-navy mb-2">
							<?php esc_html_e('Per i pazienti', 'cocoora'); ?>
						</h3>
						<p class="text-gray-600">
							<?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'cocoora'); ?>
						</p>
					</div>
				</div>

				<!-- Per i medici -->
				<div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-xl transition-shadow">
					<div class="aspect-video bg-gradient-to-br from-cocoora-sky/40 to-cocoora-light-blue/30 overflow-hidden">
						<?php
						$doctors_image = get_field('doctors_image');
						if ($doctors_image) :
						?>
							<img src="<?php echo esc_url($doctors_image['url']); ?>" alt="<?php echo esc_attr($doctors_image['alt']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
						<?php else : ?>
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/card-medici.png" alt="<?php esc_attr_e('Per i medici', 'cocoora'); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
						<?php endif; ?>
					</div>
					<div class="p-6">
						<h3 class="text-xl font-bold font-heading text-cocoora-navy mb-2">
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

	<!-- ============================================
	     LOCATION SECTION
	     ============================================ -->
	<section id="location" class="py-20 md:py-28 bg-gradient-to-b from-white to-cocoora-sky/40">
		<div class="container">
			<!-- Section Header -->
			<div class="text-center max-w-3xl mx-auto mb-12">
				<h2 class="text-3xl md:text-4xl font-bold font-heading text-cocoora-navy mb-6">
					<?php esc_html_e('Location', 'cocoora'); ?>
				</h2>
				<p class="text-gray-600 leading-relaxed">
					<?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porttitor, ante id bibendum pharetra, arcu eros ullamcorper erat, in vehicula tortor tellus id magna.', 'cocoora'); ?>
				</p>
			</div>

			<!-- Photo Gallery - 3 images per Figma -->
			<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
				<?php
				$gallery = get_field('location_gallery');
				if ($gallery) :
					$count = 0;
					foreach ($gallery as $image) :
						if ($count >= 3) break;
				?>
					<div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-lg">
						<img src="<?php echo esc_url($image['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
					</div>
				<?php
						$count++;
					endforeach;
				else :
					// Fallback to Figma images
					$location_images = array('location-1.png', 'location-2.png', 'location-3.png');
					foreach ($location_images as $img) :
				?>
					<div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-lg">
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/<?php echo esc_attr($img); ?>" alt="<?php esc_attr_e('Cocoora Location', 'cocoora'); ?>" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
					</div>
				<?php
					endforeach;
				endif;
				?>
			</div>

			<!-- Address Pill & CTA -->
			<div class="flex flex-col sm:flex-row items-center justify-center gap-6">
				<div class="inline-flex items-center gap-3 bg-white rounded-full px-6 py-3 shadow-md">
					<svg class="w-6 h-6 text-cocoora-blue flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
						<path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
					</svg>
					<div class="text-left">
						<p class="font-semibold text-cocoora-navy">Via Emanuele Gianturco, 92</p>
						<p class="text-sm text-gray-500">80146 Napoli NA</p>
					</div>
				</div>
				<a href="#form" class="inline-flex items-center justify-center px-8 py-3 bg-cocoora-blue text-white font-semibold rounded-full hover:bg-cocoora-navy transition-colors shadow-lg shadow-cocoora-blue/25">
					<?php esc_html_e('Registrati', 'cocoora'); ?>
				</a>
			</div>
		</div>
	</section>

	<!-- ============================================
	     PIANI (PRICING) SECTION
	     ============================================ -->
	<section id="piani" class="py-20 md:py-28 bg-gradient-to-b from-cocoora-sky/40 to-white">
		<div class="container">
			<!-- Section Header -->
			<div class="text-center max-w-3xl mx-auto mb-16">
				<h2 class="text-3xl md:text-4xl font-bold font-heading text-cocoora-navy mb-6">
					<?php esc_html_e('Piani', 'cocoora'); ?>
				</h2>
				<p class="text-gray-600 leading-relaxed">
					<?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porttitor, ante id bibendum pharetra, arcu eros ullamcorper erat, in vehicula tortor tellus id magna.', 'cocoora'); ?>
				</p>
			</div>

			<!-- Pricing Cards -->
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
						'button_text' => 'Scopri il piano',
						'button_style' => 'outline',
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
						'button_text' => 'Scegli il piano',
						'button_style' => 'filled',
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
						'button_text' => 'Scegli il piano',
						'button_style' => 'filled',
					),
				);

				foreach ($plans as $plan) :
					$card_class = $plan['featured'] ? 'border-2 border-cocoora-blue shadow-xl scale-105' : 'border border-gray-100 shadow-lg';
				?>
					<div class="bg-white rounded-2xl <?php echo esc_attr($card_class); ?> overflow-hidden">
						<div class="p-8">
							<!-- Plan Name -->
							<div class="flex items-center gap-2 mb-4">
								<?php if (!$plan['featured']) : ?>
									<svg class="w-5 h-5 text-cocoora-blue" fill="currentColor" viewBox="0 0 24 24">
										<circle cx="12" cy="12" r="10"/>
									</svg>
								<?php endif; ?>
								<h3 class="text-lg font-medium text-gray-500"><?php echo esc_html($plan['name']); ?></h3>
							</div>

							<!-- Price -->
							<div class="mb-6">
								<span class="text-4xl font-bold text-cocoora-navy">€<?php echo esc_html($plan['price']); ?></span>
								<span class="text-gray-500 text-sm ml-1"><?php echo esc_html($plan['period']); ?></span>
								<p class="text-xs text-gray-400 mt-1"><?php esc_html_e('Lorem ipsum dolor sit amet', 'cocoora'); ?></p>
							</div>

							<!-- CTA Button -->
							<?php if ($plan['button_style'] === 'filled') : ?>
								<a href="#form" class="block w-full text-center px-6 py-3 bg-cocoora-blue text-white font-semibold rounded-full hover:bg-cocoora-navy transition-colors mb-6">
									<?php echo esc_html($plan['button_text']); ?>
								</a>
							<?php else : ?>
								<a href="#form" class="block w-full text-center px-6 py-3 border-2 border-cocoora-blue text-cocoora-blue font-semibold rounded-full hover:bg-cocoora-blue hover:text-white transition-colors mb-6">
									<?php echo esc_html($plan['button_text']); ?>
								</a>
							<?php endif; ?>

							<!-- Features -->
							<div>
								<p class="text-sm font-semibold text-cocoora-navy mb-4">
									<?php esc_html_e('Cosa comprende:', 'cocoora'); ?>
								</p>
								<ul class="space-y-3">
									<?php foreach ($plan['features'] as $feature) : ?>
										<li class="flex items-start gap-3 text-sm text-gray-600">
											<svg class="w-5 h-5 text-cocoora-blue flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
												<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
											</svg>
											<span><?php echo esc_html($feature); ?></span>
										</li>
									<?php endforeach; ?>
								</ul>
								<p class="text-xs text-gray-400 mt-4"><?php esc_html_e('*Lorem ipsum dolor', 'cocoora'); ?></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============================================
	     FAQ SECTION
	     ============================================ -->
	<section id="faq" class="py-20 md:py-28 bg-gradient-to-b from-white to-cocoora-sky/30">
		<div class="container max-w-3xl">
			<!-- Section Header -->
			<div class="text-center mb-12">
				<h2 class="text-3xl md:text-4xl font-bold font-heading text-cocoora-navy">
					<?php esc_html_e('FAQ', 'cocoora'); ?>
				</h2>
			</div>

			<!-- FAQ Accordion -->
			<div class="space-y-4" x-data="{ openFaq: null }">
				<?php
				$faqs = array(
					array(
						'question' => 'Lorem ipsum dolor sit amet adipisci?',
						'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porttitor, ante id bibendum pharetra, arcu eros ullamcorper erat, in vehicula tortor tellus id magna. Etiam porttitor, ante id bibendum pharetra, arcu eros ullamcorper erat, in vehicula tortor tellus id magna.',
					),
					array(
						'question' => 'Lorem ipsum dolor sit amet?',
						'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porttitor, ante id bibendum pharetra, arcu eros ullamcorper erat, in vehicula tortor tellus id magna.',
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
					<div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
						<button
							@click="openFaq = openFaq === <?php echo $index; ?> ? null : <?php echo $index; ?>"
							class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 transition-colors"
						>
							<span class="font-medium text-cocoora-navy pr-4"><?php echo esc_html($faq['question']); ?></span>
							<svg class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform duration-200" :class="{ 'rotate-180': openFaq === <?php echo $index; ?> }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
							</svg>
						</button>
						<div
							x-show="openFaq === <?php echo $index; ?>"
							x-collapse
							x-cloak
						>
							<div class="px-6 pb-5 text-gray-600">
								<?php echo esc_html($faq['answer']); ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============================================
	     FORM SECTION
	     ============================================ -->
	<section id="form" class="py-20 md:py-28 bg-gradient-to-b from-cocoora-sky/30 to-cocoora-sky/50 relative overflow-hidden">
		<!-- Background Bubbles -->
		<div class="absolute inset-0 pointer-events-none overflow-hidden">
			<div class="absolute -bottom-40 -left-40 w-[600px] h-[600px] rounded-full bg-gradient-to-br from-cocoora-sky/60 to-cocoora-cyan/30 blur-sm"></div>
			<div class="absolute -top-20 -right-20 w-[400px] h-[400px] rounded-full bg-gradient-to-br from-cocoora-cyan/40 to-cocoora-light-blue/20 blur-sm"></div>
		</div>

		<div class="container relative z-10 max-w-2xl">
			<!-- Section Header -->
			<div class="text-center mb-10">
				<h2 class="text-3xl md:text-4xl font-bold font-heading text-cocoora-navy mb-4">
					<?php esc_html_e('Sei un medico specialista?', 'cocoora'); ?>
				</h2>
				<p class="text-gray-600">
					<?php esc_html_e('Entra a far parte del team di', 'cocoora'); ?> <span class="text-cocoora-blue font-semibold">Cocoora</span>
				</p>
				<p class="text-sm text-gray-500 mt-1"><?php esc_html_e('Compila il form.', 'cocoora'); ?></p>
			</div>

			<!-- Contact Form -->
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
					<!-- Nome & Cognome -->
					<div class="grid md:grid-cols-2 gap-6">
						<div>
							<label for="nome" class="block text-sm font-medium text-gray-700 mb-2"><?php esc_html_e('Nome', 'cocoora'); ?> *</label>
							<input type="text" id="nome" name="nome" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-cocoora-blue focus:ring-2 focus:ring-cocoora-blue/20 transition-colors" placeholder="<?php esc_attr_e('Es: Giovanni', 'cocoora'); ?>">
						</div>
						<div>
							<label for="cognome" class="block text-sm font-medium text-gray-700 mb-2"><?php esc_html_e('Cognome', 'cocoora'); ?> *</label>
							<input type="text" id="cognome" name="cognome" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-cocoora-blue focus:ring-2 focus:ring-cocoora-blue/20 transition-colors" placeholder="<?php esc_attr_e('Es: Esposito', 'cocoora'); ?>">
						</div>
					</div>

					<!-- Email -->
					<div>
						<label for="email" class="block text-sm font-medium text-gray-700 mb-2"><?php esc_html_e('E-mail', 'cocoora'); ?> *</label>
						<input type="email" id="email" name="email" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-cocoora-blue focus:ring-2 focus:ring-cocoora-blue/20 transition-colors" placeholder="<?php esc_attr_e('Indirizzo e-mail valido', 'cocoora'); ?>">
					</div>

					<!-- Telefono -->
					<div>
						<label for="telefono" class="block text-sm font-medium text-gray-700 mb-2"><?php esc_html_e('Recapito telefonico', 'cocoora'); ?> *</label>
						<input type="tel" id="telefono" name="telefono" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-cocoora-blue focus:ring-2 focus:ring-cocoora-blue/20 transition-colors" placeholder="<?php esc_attr_e('Preferenza: il tuo numero di cellulare e fisso', 'cocoora'); ?>">
					</div>

					<!-- Note -->
					<div>
						<label for="note" class="block text-sm font-medium text-gray-700 mb-2"><?php esc_html_e('Note', 'cocoora'); ?></label>
						<textarea id="note" name="note" rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-cocoora-blue focus:ring-2 focus:ring-cocoora-blue/20 transition-colors resize-none" placeholder="<?php esc_attr_e('Scrivi un messaggio (max 400 caratteri)', 'cocoora'); ?>"></textarea>
					</div>

					<!-- Privacy -->
					<div class="flex items-start gap-3">
						<input type="checkbox" id="privacy" name="privacy" required class="mt-1 w-4 h-4 rounded border-gray-300 text-cocoora-blue focus:ring-cocoora-blue">
						<label for="privacy" class="text-sm text-gray-600">
							<?php esc_html_e('Esprimo il consenso al trattamento dei dati personali', 'cocoora'); ?>
						</label>
					</div>

					<!-- Submit -->
					<div class="text-center pt-4">
						<button type="submit" class="inline-flex items-center justify-center px-12 py-4 bg-cocoora-blue text-white font-semibold rounded-full hover:bg-cocoora-navy transition-colors shadow-lg shadow-cocoora-blue/25">
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
