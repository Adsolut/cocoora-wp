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
		<!-- Main Footer -->
		<div class="container py-12 lg:py-16">
			<div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">

				<!-- Company Info -->
				<div class="lg:col-span-1">
					<?php if ( has_custom_logo() ) : ?>
						<div class="mb-6 brightness-0 invert">
							<?php the_custom_logo(); ?>
						</div>
					<?php else : ?>
						<h3 class="text-2xl font-bold mb-6"><?php bloginfo( 'name' ); ?></h3>
					<?php endif; ?>

					<p class="text-gray-300 mb-6">
						<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
					</p>

					<!-- Social Links -->
					<div class="flex gap-4">
						<?php
						$social_links = array(
							'facebook'  => get_theme_mod( 'cocoora_facebook_url', '' ),
							'instagram' => get_theme_mod( 'cocoora_instagram_url', '' ),
							'linkedin'  => get_theme_mod( 'cocoora_linkedin_url', '' ),
						);

						foreach ( $social_links as $platform => $url ) :
							if ( ! empty( $url ) ) :
								?>
								<a
									href="<?php echo esc_url( $url ); ?>"
									target="_blank"
									rel="noopener noreferrer"
									class="text-gray-300 hover:text-white transition-colors"
									aria-label="<?php echo esc_attr( ucfirst( $platform ) ); ?>"
								>
									<span class="sr-only"><?php echo esc_html( ucfirst( $platform ) ); ?></span>
									<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
										<!-- Icon placeholder -->
									</svg>
								</a>
								<?php
							endif;
						endforeach;
						?>
					</div>
				</div>

				<!-- Navigation -->
				<div>
					<h4 class="text-lg font-bold mb-4"><?php esc_html_e( 'Navigazione', 'cocoora' ); ?></h4>
					<?php if ( has_nav_menu( 'footer' ) ) : ?>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'container'      => false,
								'menu_class'     => 'space-y-2 text-gray-300',
								'depth'          => 1,
								'fallback_cb'    => false,
								'link_before'    => '<span class="hover:text-white transition-colors">',
								'link_after'     => '</span>',
							)
						);
						?>
					<?php else : ?>
						<ul class="space-y-2 text-gray-300">
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-white transition-colors"><?php esc_html_e( 'Home', 'cocoora' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/servizi/' ) ); ?>" class="hover:text-white transition-colors"><?php esc_html_e( 'Servizi', 'cocoora' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/chi-siamo/' ) ); ?>" class="hover:text-white transition-colors"><?php esc_html_e( 'Chi Siamo', 'cocoora' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/contatti/' ) ); ?>" class="hover:text-white transition-colors"><?php esc_html_e( 'Contatti', 'cocoora' ); ?></a></li>
						</ul>
					<?php endif; ?>
				</div>

				<!-- Services -->
				<div>
					<h4 class="text-lg font-bold mb-4"><?php esc_html_e( 'Servizi', 'cocoora' ); ?></h4>
					<?php
					$footer_services = new WP_Query( array(
						'post_type'      => 'service',
						'posts_per_page' => 5,
						'orderby'        => 'menu_order',
						'order'          => 'ASC',
					) );
					if ( $footer_services->have_posts() ) :
						?>
						<ul class="space-y-2 text-gray-300">
							<?php while ( $footer_services->have_posts() ) : $footer_services->the_post(); ?>
								<li>
									<a href="<?php the_permalink(); ?>" class="hover:text-white transition-colors">
										<?php the_title(); ?>
									</a>
								</li>
							<?php endwhile; ?>
						</ul>
						<?php
						wp_reset_postdata();
					endif;
					?>
				</div>

				<!-- Contact Info -->
				<div>
					<h4 class="text-lg font-bold mb-4"><?php esc_html_e( 'Contatti', 'cocoora' ); ?></h4>
					<address class="not-italic text-gray-300 space-y-3">
						<p>
							<strong class="text-white"><?php esc_html_e( 'Indirizzo', 'cocoora' ); ?></strong><br>
							Via Emanuele Gianturco 92<br>
							Napoli (NA), Italia
						</p>
						<p>
							<strong class="text-white"><?php esc_html_e( 'Telefono', 'cocoora' ); ?></strong><br>
							<a href="tel:+390811822778" class="hover:text-white transition-colors">+39 081 1822 7784</a>
						</p>
						<p>
							<strong class="text-white"><?php esc_html_e( 'Email', 'cocoora' ); ?></strong><br>
							<a href="mailto:info@cocoora.it" class="hover:text-white transition-colors">info@cocoora.it</a>
						</p>
					</address>
				</div>

			</div>
		</div>

		<!-- Bottom Bar -->
		<div class="border-t border-white/10">
			<div class="container py-6">
				<div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-400">
					<p>
						&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
						<?php esc_html_e( 'Tutti i diritti riservati.', 'cocoora' ); ?>
						<span class="block md:inline">P.IVA: IT10891001215</span>
					</p>

					<?php if ( has_nav_menu( 'legal' ) ) : ?>
						<nav aria-label="<?php esc_attr_e( 'Legal Navigation', 'cocoora' ); ?>">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'legal',
									'container'      => false,
									'menu_class'     => 'flex flex-wrap gap-4',
									'depth'          => 1,
									'fallback_cb'    => false,
								)
							);
							?>
						</nav>
					<?php else : ?>
						<nav class="flex flex-wrap gap-4" aria-label="<?php esc_attr_e( 'Legal Navigation', 'cocoora' ); ?>">
							<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="hover:text-white transition-colors">
								<?php esc_html_e( 'Privacy Policy', 'cocoora' ); ?>
							</a>
							<a href="<?php echo esc_url( home_url( '/cookie-policy/' ) ); ?>" class="hover:text-white transition-colors">
								<?php esc_html_e( 'Cookie Policy', 'cocoora' ); ?>
							</a>
						</nav>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
