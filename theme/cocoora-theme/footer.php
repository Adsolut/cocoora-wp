<?php
/**
 * The footer template
 *
 * Contains the closing of the #page div and all content after.
 *
 * @package Cocoora
 * @since 1.0.0
 */

?>

	<footer id="colophon" class="site-footer bg-cocoora-navy text-white mt-auto">
		<div class="container py-8">
			<div class="flex flex-col md:flex-row justify-between items-center gap-6">

				<!-- Logo & Company -->
				<div class="flex flex-col md:flex-row items-center gap-4">
					<?php if ( has_custom_logo() ) : ?>
						<div class="brightness-0 invert">
							<?php the_custom_logo(); ?>
						</div>
					<?php else : ?>
						<span class="text-xl font-bold font-heading"><?php bloginfo( 'name' ); ?></span>
					<?php endif; ?>
					<span class="text-gray-400 hidden md:inline">|</span>
					<span class="text-gray-300 text-sm">Cocoora di Primecare srl</span>
				</div>

				<!-- Contact Info -->
				<div class="flex flex-col sm:flex-row items-center gap-4 text-sm text-gray-300">
					<a href="mailto:info@cocoora.it" class="hover:text-white transition-colors flex items-center gap-2">
						<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
						</svg>
						info@cocoora.it
					</a>
					<span class="text-gray-500 hidden sm:inline">|</span>
					<a href="tel:+390811822778" class="hover:text-white transition-colors flex items-center gap-2">
						<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
						</svg>
						+39 081 1822 7784
					</a>
				</div>

			</div>

			<!-- Bottom Bar -->
			<div class="border-t border-white/10 mt-6 pt-6">
				<div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-gray-400">
					<p>
						&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
						<?php esc_html_e( 'Tutti i diritti riservati.', 'cocoora' ); ?>
					</p>

					<nav class="flex flex-wrap gap-6" aria-label="<?php esc_attr_e( 'Legal Navigation', 'cocoora' ); ?>">
						<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="hover:text-white transition-colors">
							<?php esc_html_e( 'Privacy Policy', 'cocoora' ); ?>
						</a>
						<a href="<?php echo esc_url( home_url( '/cookie-policy/' ) ); ?>" class="hover:text-white transition-colors">
							<?php esc_html_e( 'Cookie Policy', 'cocoora' ); ?>
						</a>
					</nav>
				</div>
			</div>
		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
