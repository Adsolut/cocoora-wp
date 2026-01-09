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
				<a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-2" rel="home">
					<?php if (has_custom_logo()) : ?>
						<div class="brightness-0 invert">
							<?php the_custom_logo(); ?>
						</div>
					<?php else : ?>
						<!-- Logo Icon -->
						<svg class="w-8 h-8 text-white" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="16" cy="16" r="14" stroke="currentColor" stroke-width="2" fill="none"/>
							<circle cx="12" cy="14" r="3" fill="currentColor"/>
							<circle cx="20" cy="14" r="3" fill="currentColor"/>
							<path d="M10 20 Q16 26 22 20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/>
						</svg>
						<span class="text-xl font-bold font-heading text-white">
							<?php bloginfo('name'); ?>
						</span>
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
