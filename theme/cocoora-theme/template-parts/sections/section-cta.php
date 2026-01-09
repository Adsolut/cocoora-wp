<?php
/**
 * Template part for CTA section (ACF Flexible Content)
 *
 * @package Cocoora
 * @since 1.0.0
 */

// Get ACF fields
$title       = get_sub_field( 'title' );
$description = get_sub_field( 'description' );
$cta_primary = get_sub_field( 'cta_primary' );
$cta_secondary = get_sub_field( 'cta_secondary' );
$style       = get_sub_field( 'style' ) ?: 'gradient';

// Style classes
$bg_classes = array(
	'gradient' => 'bg-gradient-to-r from-cocoora-blue to-cocoora-navy text-white',
	'solid'    => 'bg-cocoora-navy text-white',
	'light'    => 'bg-cocoora-light text-cocoora-navy',
);
$bg_class = $bg_classes[ $style ] ?? $bg_classes['gradient'];

?>

<section class="section <?php echo esc_attr( $bg_class ); ?>">
	<div class="container">
		<div class="text-center max-w-3xl mx-auto">
			<?php if ( $title ) : ?>
				<h2 class="text-3xl md:text-4xl font-bold mb-4">
					<?php echo esc_html( $title ); ?>
				</h2>
			<?php endif; ?>

			<?php if ( $description ) : ?>
				<p class="text-lg opacity-90 mb-8">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif; ?>

			<?php if ( $cta_primary || $cta_secondary ) : ?>
				<div class="flex flex-wrap justify-center gap-4">
					<?php if ( $cta_primary ) : ?>
						<a
							href="<?php echo esc_url( $cta_primary['url'] ); ?>"
							class="btn <?php echo 'light' === $style ? 'btn-primary' : 'bg-white text-cocoora-navy hover:bg-cocoora-light'; ?>"
							<?php echo $cta_primary['target'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
						>
							<?php echo esc_html( $cta_primary['title'] ); ?>
						</a>
					<?php endif; ?>

					<?php if ( $cta_secondary ) : ?>
						<a
							href="<?php echo esc_url( $cta_secondary['url'] ); ?>"
							class="btn <?php echo 'light' === $style ? 'btn-outline' : 'border-2 border-white text-white hover:bg-white hover:text-cocoora-navy'; ?>"
							<?php echo $cta_secondary['target'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
						>
							<?php echo esc_html( $cta_secondary['title'] ); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
