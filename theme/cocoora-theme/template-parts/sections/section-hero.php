<?php
/**
 * Template part for Hero section (ACF Flexible Content)
 *
 * @package Cocoora
 * @since 1.0.0
 */

// Get ACF fields
$title       = get_sub_field( 'title' );
$subtitle    = get_sub_field( 'subtitle' );
$cta_primary = get_sub_field( 'cta_primary' );
$cta_secondary = get_sub_field( 'cta_secondary' );
$background_image = get_sub_field( 'background_image' );
$overlay_opacity = get_sub_field( 'overlay_opacity' ) ?: 50;

?>

<section class="hero relative min-h-[70vh] flex items-center bg-cocoora-navy text-white overflow-hidden">
	<?php if ( $background_image ) : ?>
		<div class="absolute inset-0">
			<img
				src="<?php echo esc_url( $background_image['url'] ); ?>"
				alt="<?php echo esc_attr( $background_image['alt'] ); ?>"
				class="w-full h-full object-cover"
			>
			<div class="absolute inset-0 bg-cocoora-navy" style="opacity: <?php echo esc_attr( $overlay_opacity / 100 ); ?>"></div>
		</div>
	<?php else : ?>
		<div class="absolute inset-0 bg-gradient-to-br from-cocoora-navy to-cocoora-blue"></div>
	<?php endif; ?>

	<div class="container relative z-10">
		<div class="max-w-3xl" data-animate="fade-up">
			<?php if ( $title ) : ?>
				<h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
					<?php echo esc_html( $title ); ?>
				</h1>
			<?php endif; ?>

			<?php if ( $subtitle ) : ?>
				<p class="text-xl md:text-2xl opacity-90 mb-8">
					<?php echo esc_html( $subtitle ); ?>
				</p>
			<?php endif; ?>

			<?php if ( $cta_primary || $cta_secondary ) : ?>
				<div class="flex flex-wrap gap-4">
					<?php if ( $cta_primary ) : ?>
						<a
							href="<?php echo esc_url( $cta_primary['url'] ); ?>"
							class="btn bg-white text-cocoora-navy hover:bg-cocoora-light"
							<?php echo $cta_primary['target'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
						>
							<?php echo esc_html( $cta_primary['title'] ); ?>
						</a>
					<?php endif; ?>

					<?php if ( $cta_secondary ) : ?>
						<a
							href="<?php echo esc_url( $cta_secondary['url'] ); ?>"
							class="btn border-2 border-white text-white hover:bg-white hover:text-cocoora-navy"
							<?php echo $cta_secondary['target'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
						>
							<?php echo esc_html( $cta_secondary['title'] ); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<!-- Decorative element -->
	<div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-white to-transparent"></div>
</section>
