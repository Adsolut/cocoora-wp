<?php
/**
 * Header Template - Pixel Perfect Figma Match
 *
 * @package Cocoora
 * @since 2.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class('antialiased font-sans'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen flex flex-col">

	<!-- Skip Link -->
	<a class="skip-link sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-cocoora-blue text-white px-4 py-2 rounded-lg z-50" href="#primary">
		<?php esc_html_e('Vai al contenuto', 'cocoora'); ?>
	</a>

	<!-- Header -->
	<header id="masthead" class="site-header sticky top-0 z-40 bg-white/95 backdrop-blur-sm shadow-sm" x-data="{ mobileMenuOpen: false }">
		<div class="container">
			<nav class="flex items-center justify-between h-20">

				<!-- Logo -->
				<a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center flex-shrink-0" rel="home">
					<?php if (has_custom_logo()) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<!-- Logo from Figma -->
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.svg" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="h-10 w-auto">
					<?php endif; ?>
				</a>

				<!-- Desktop Navigation -->
				<div class="hidden lg:flex items-center gap-8">
					<a href="#come-funziona" class="text-cocoora-navy font-medium hover:text-cocoora-blue transition-colors">
						<?php esc_html_e('Come Funziona', 'cocoora'); ?>
					</a>
					<a href="#location" class="text-cocoora-navy font-medium hover:text-cocoora-blue transition-colors">
						<?php esc_html_e('Location', 'cocoora'); ?>
					</a>
					<a href="#piani" class="text-cocoora-navy font-medium hover:text-cocoora-blue transition-colors">
						<?php esc_html_e('Piani', 'cocoora'); ?>
					</a>
					<a href="#faq" class="text-cocoora-navy font-medium hover:text-cocoora-blue transition-colors">
						<?php esc_html_e('FAQ', 'cocoora'); ?>
					</a>
				</div>

				<!-- CTA Button (Desktop) -->
				<div class="hidden lg:block">
					<a href="#form" class="inline-flex items-center justify-center px-6 py-2.5 bg-cocoora-blue text-white font-semibold rounded-full hover:bg-cocoora-navy transition-colors">
						<?php esc_html_e('Contatta il doc', 'cocoora'); ?>
					</a>
				</div>

				<!-- Mobile Menu Toggle -->
				<button
					type="button"
					class="lg:hidden inline-flex items-center justify-center p-2 rounded-lg text-cocoora-navy hover:bg-cocoora-light focus:outline-none focus:ring-2 focus:ring-cocoora-blue"
					@click="mobileMenuOpen = !mobileMenuOpen"
					:aria-expanded="mobileMenuOpen"
					aria-controls="mobile-menu"
					aria-label="<?php esc_attr_e('Menu', 'cocoora'); ?>"
				>
					<svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
					</svg>
					<svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
					</svg>
				</button>
			</nav>

			<!-- Mobile Navigation -->
			<div
				id="mobile-menu"
				class="lg:hidden"
				x-show="mobileMenuOpen"
				x-cloak
				x-transition:enter="transition ease-out duration-200"
				x-transition:enter-start="opacity-0 -translate-y-2"
				x-transition:enter-end="opacity-100 translate-y-0"
				x-transition:leave="transition ease-in duration-150"
				x-transition:leave-start="opacity-100 translate-y-0"
				x-transition:leave-end="opacity-0 -translate-y-2"
				@click.away="mobileMenuOpen = false"
			>
				<div class="py-4 space-y-2 border-t border-gray-100">
					<a href="#come-funziona" class="block px-4 py-2 text-cocoora-navy font-medium hover:bg-cocoora-light rounded-lg" @click="mobileMenuOpen = false">
						<?php esc_html_e('Come Funziona', 'cocoora'); ?>
					</a>
					<a href="#location" class="block px-4 py-2 text-cocoora-navy font-medium hover:bg-cocoora-light rounded-lg" @click="mobileMenuOpen = false">
						<?php esc_html_e('Location', 'cocoora'); ?>
					</a>
					<a href="#piani" class="block px-4 py-2 text-cocoora-navy font-medium hover:bg-cocoora-light rounded-lg" @click="mobileMenuOpen = false">
						<?php esc_html_e('Piani', 'cocoora'); ?>
					</a>
					<a href="#faq" class="block px-4 py-2 text-cocoora-navy font-medium hover:bg-cocoora-light rounded-lg" @click="mobileMenuOpen = false">
						<?php esc_html_e('FAQ', 'cocoora'); ?>
					</a>
					<div class="pt-2 px-4">
						<a href="#form" class="block w-full text-center px-6 py-2.5 bg-cocoora-blue text-white font-semibold rounded-full hover:bg-cocoora-navy transition-colors" @click="mobileMenuOpen = false">
							<?php esc_html_e('Contatta il doc', 'cocoora'); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</header>
