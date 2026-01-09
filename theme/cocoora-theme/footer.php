<?php
/**
 * Footer Template - Pixel Perfect Figma Match
 *
 * @package Cocoora
 * @since 2.0.0
 */

?>

	<!-- Footer -->
	<footer id="colophon" class="site-footer bg-cocoora-navy text-white mt-auto">
		<div class="container py-8">

			<!-- Main Footer Content - Centered -->
			<div class="flex flex-col items-center text-center space-y-6">

				<!-- Logo -->
				<a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center" rel="home">
					<?php if (has_custom_logo()) : ?>
						<div class="brightness-0 invert">
							<?php the_custom_logo(); ?>
						</div>
					<?php else : ?>
						<!-- Logo from Figma (inverted for dark background) -->
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.svg" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="h-8 w-auto brightness-0 invert">
					<?php endif; ?>
				</a>

				<!-- Company Info Line -->
				<div class="flex flex-wrap items-center justify-center gap-2 text-sm text-gray-300">
					<span>&copy; <?php echo esc_html(date('Y')); ?></span>
					<span class="text-gray-500">•</span>
					<span>Cocoora di Primecare srl</span>
					<span class="text-gray-500">•</span>
					<a href="mailto:info@cocoora.it" class="hover:text-white transition-colors">
						info@cocoora.it
					</a>
					<span class="text-gray-500">•</span>
					<a href="tel:+390811822778" class="hover:text-white transition-colors">
						T +39 081.1822.7784
					</a>
				</div>

				<!-- Legal Links -->
				<nav class="flex items-center gap-4 text-sm text-gray-400" aria-label="<?php esc_attr_e('Legal Navigation', 'cocoora'); ?>">
					<a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" class="hover:text-white transition-colors">
						<?php esc_html_e('Privacy Policy', 'cocoora'); ?>
					</a>
					<span class="text-gray-600">|</span>
					<a href="<?php echo esc_url(home_url('/cookie-policy/')); ?>" class="hover:text-white transition-colors">
						<?php esc_html_e('Cookie Policy', 'cocoora'); ?>
					</a>
				</nav>

			</div>
		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
