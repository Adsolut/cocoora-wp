<?php
/**
 * The header template
 *
 * Displays all of the <head> section and site header
 *
 * @package Cocoora
 * @since 1.0.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'antialiased' ); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen flex flex-col">
	<a class="skip-link sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-cocoora-blue text-white px-4 py-2 rounded-lg z-50" href="#primary">
		<?php esc_html_e( 'Vai al contenuto', 'cocoora' ); ?>
	</a>

	<header id="masthead" class="site-header sticky top-0 z-40 bg-white shadow-sm" x-data="mobileMenu">
		<div class="container">
			<div class="flex items-center justify-between h-20">

				<!-- Logo -->
				<div class="site-branding flex-shrink-0">
					<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-bold text-cocoora-navy hover:text-cocoora-blue transition-colors" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					<?php endif; ?>
				</div>

				<!-- Desktop Navigation -->
				<nav id="site-navigation" class="main-navigation hidden lg:flex items-center gap-1" aria-label="<?php esc_attr_e( 'Primary Navigation', 'cocoora' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'container'      => false,
							'menu_class'     => 'flex items-center gap-1',
							'fallback_cb'    => false,
							'depth'          => 2,
							'link_before'    => '<span class="nav-link">',
							'link_after'     => '</span>',
						)
					);
					?>
				</nav>

				<!-- CTA Button (Desktop) -->
				<div class="hidden lg:block">
					<a href="<?php echo esc_url( home_url( '/contatti/' ) ); ?>" class="btn-primary">
						<?php esc_html_e( 'Contattaci', 'cocoora' ); ?>
					</a>
				</div>

				<!-- Mobile Menu Toggle -->
				<button
					type="button"
					class="lg:hidden inline-flex items-center justify-center p-2 rounded-lg text-cocoora-navy hover:bg-cocoora-light focus:outline-none focus:ring-2 focus:ring-cocoora-blue"
					data-menu-toggle
					@click="toggle()"
					:aria-expanded="open"
					aria-controls="mobile-menu"
					aria-label="<?php esc_attr_e( 'Toggle menu', 'cocoora' ); ?>"
				>
					<svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
					</svg>
					<svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
					</svg>
				</button>
			</div>

			<!-- Mobile Navigation -->
			<nav
				id="mobile-menu"
				class="lg:hidden"
				data-mobile-menu
				x-show="open"
				x-cloak
				x-transition:enter="transition ease-out duration-200"
				x-transition:enter-start="opacity-0 -translate-y-1"
				x-transition:enter-end="opacity-100 translate-y-0"
				x-transition:leave="transition ease-in duration-150"
				x-transition:leave-start="opacity-100 translate-y-0"
				x-transition:leave-end="opacity-0 -translate-y-1"
				@click.away="close()"
				aria-label="<?php esc_attr_e( 'Mobile Navigation', 'cocoora' ); ?>"
			>
				<div class="py-4 space-y-1 border-t border-gray-100">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'mobile-primary-menu',
							'container'      => false,
							'menu_class'     => 'space-y-1',
							'fallback_cb'    => false,
							'depth'          => 2,
							'link_before'    => '<span class="block px-4 py-2 rounded-lg hover:bg-cocoora-light">',
							'link_after'     => '</span>',
						)
					);
					?>
					<div class="pt-4 px-4">
						<a href="<?php echo esc_url( home_url( '/contatti/' ) ); ?>" class="btn-primary w-full text-center">
							<?php esc_html_e( 'Contattaci', 'cocoora' ); ?>
						</a>
					</div>
				</div>
			</nav>
		</div>
	</header>
