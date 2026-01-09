<?php
/**
 * Template part for About Preview section (ACF Flexible Content)
 *
 * @package Cocoora
 * @since 1.0.0
 */

// Get ACF fields
$heading = get_sub_field( 'heading' );
$content = get_sub_field( 'content' );
$image   = get_sub_field( 'image' );
$cta     = get_sub_field( 'cta' );
$layout  = get_sub_field( 'layout' ) ?: 'image_right';

// Layout classes
$image_order = 'image_left' === $layout ? 'lg:order-first' : 'lg:order-last';
$content_order = 'image_left' === $layout ? 'lg:order-last' : 'lg:order-first';

?>

<section class="section">
	<div class="container">
		<div class="grid lg:grid-cols-2 gap-12 items-center">
			<!-- Content -->
			<div class="<?php echo esc_attr( $content_order ); ?>" data-animate="fade-up">
				<?php if ( $heading ) : ?>
					<h2 class="text-3xl md:text-4xl font-bold text-cocoora-navy mb-6">
						<?php echo esc_html( $heading ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $content ) : ?>
					<div class="prose prose-lg text-gray-600 mb-8">
						<?php echo wp_kses_post( $content ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $cta ) : ?>
					<a
						href="<?php echo esc_url( $cta['url'] ); ?>"
						class="btn-primary"
						<?php echo $cta['target'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
					>
						<?php echo esc_html( $cta['title'] ); ?>
					</a>
				<?php endif; ?>
			</div>

			<!-- Image -->
			<?php if ( $image ) : ?>
				<div class="<?php echo esc_attr( $image_order ); ?>" data-animate="fade-up">
					<div class="relative">
						<img
							src="<?php echo esc_url( $image['url'] ); ?>"
							alt="<?php echo esc_attr( $image['alt'] ); ?>"
							class="w-full rounded-2xl shadow-xl"
							loading="lazy"
						>
						<!-- Decorative element -->
						<div class="absolute -bottom-4 -right-4 w-24 h-24 bg-cocoora-blue/10 rounded-2xl -z-10"></div>
						<div class="absolute -top-4 -left-4 w-16 h-16 bg-cocoora-navy/10 rounded-xl -z-10"></div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
