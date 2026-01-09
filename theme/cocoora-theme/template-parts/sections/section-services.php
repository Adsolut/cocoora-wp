<?php
/**
 * Template part for Services section (ACF Flexible Content)
 *
 * @package Cocoora
 * @since 1.0.0
 */

// Get ACF fields
$title       = get_sub_field( 'title' );
$subtitle    = get_sub_field( 'subtitle' );
$show_all    = get_sub_field( 'show_all_services' );
$selected    = get_sub_field( 'selected_services' );
$columns     = get_sub_field( 'columns' ) ?: 3;
$cta         = get_sub_field( 'cta' );

// Build query args
$args = array(
	'post_type'      => 'service',
	'posts_per_page' => $show_all ? -1 : 6,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
);

// If specific services selected
if ( ! $show_all && $selected ) {
	$args['post__in'] = $selected;
	$args['orderby']  = 'post__in';
}

$services = new WP_Query( $args );

// Grid columns class
$grid_cols = array(
	2 => 'md:grid-cols-2',
	3 => 'md:grid-cols-2 lg:grid-cols-3',
	4 => 'md:grid-cols-2 lg:grid-cols-4',
);
$grid_class = $grid_cols[ $columns ] ?? $grid_cols[3];

?>

<section id="servizi" class="section-light">
	<div class="container">
		<?php if ( $title || $subtitle ) : ?>
			<header class="text-center max-w-2xl mx-auto mb-12">
				<?php if ( $title ) : ?>
					<h2 class="text-3xl md:text-4xl font-bold text-cocoora-navy mb-4">
						<?php echo esc_html( $title ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $subtitle ) : ?>
					<p class="text-lg text-gray-600">
						<?php echo esc_html( $subtitle ); ?>
					</p>
				<?php endif; ?>
			</header>
		<?php endif; ?>

		<?php if ( $services->have_posts() ) : ?>
			<div class="grid gap-8 <?php echo esc_attr( $grid_class ); ?>">
				<?php
				while ( $services->have_posts() ) :
					$services->the_post();

					// Get service fields
					$icon        = get_field( 'service_icon' );
					$description = get_field( 'short_description' ) ?: get_the_excerpt();
					?>

					<article class="card group" data-animate="fade-up">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" class="block aspect-video overflow-hidden">
								<?php
								the_post_thumbnail(
									'cocoora-card',
									array(
										'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110',
									)
								);
								?>
							</a>
						<?php endif; ?>

						<div class="card-body">
							<?php if ( $icon ) : ?>
								<div class="w-12 h-12 flex items-center justify-center bg-cocoora-blue/10 text-cocoora-blue rounded-lg mb-4">
									<span class="dashicons <?php echo esc_attr( $icon ); ?> text-2xl"></span>
								</div>
							<?php endif; ?>

							<h3 class="text-xl font-bold text-cocoora-navy mb-2 group-hover:text-cocoora-blue transition-colors">
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h3>

							<?php if ( $description ) : ?>
								<p class="text-gray-600">
									<?php echo esc_html( wp_trim_words( $description, 20 ) ); ?>
								</p>
							<?php endif; ?>

							<a href="<?php the_permalink(); ?>" class="inline-flex items-center mt-4 text-cocoora-blue font-medium group-hover:gap-2 transition-all">
								<?php esc_html_e( 'Scopri di più', 'cocoora' ); ?>
								<svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
								</svg>
							</a>
						</div>
					</article>

				<?php endwhile; ?>
			</div>
			<?php wp_reset_postdata(); ?>

			<?php if ( $cta ) : ?>
				<div class="text-center mt-12">
					<a href="<?php echo esc_url( $cta['url'] ); ?>" class="btn-primary">
						<?php echo esc_html( $cta['title'] ); ?>
					</a>
				</div>
			<?php endif; ?>

		<?php else : ?>
			<p class="text-center text-gray-600">
				<?php esc_html_e( 'Nessun servizio disponibile.', 'cocoora' ); ?>
			</p>
		<?php endif; ?>
	</div>
</section>
