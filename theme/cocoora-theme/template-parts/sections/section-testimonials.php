<?php
/**
 * Template part for Testimonials section (ACF Flexible Content)
 *
 * @package Cocoora
 * @since 1.0.0
 */

// Get ACF fields
$heading      = get_sub_field( 'heading' );
$testimonials = get_sub_field( 'testimonials' );

// If no selected testimonials, get all
if ( empty( $testimonials ) ) {
	$testimonials_query = new WP_Query(
		array(
			'post_type'      => 'testimonial',
			'posts_per_page' => 6,
			'orderby'        => 'date',
			'order'          => 'DESC',
		)
	);
	$testimonials = $testimonials_query->posts;
}

?>

<section class="section-light">
	<div class="container">
		<?php if ( $heading ) : ?>
			<header class="text-center max-w-2xl mx-auto mb-12">
				<h2 class="text-3xl md:text-4xl font-bold text-cocoora-navy">
					<?php echo esc_html( $heading ); ?>
				</h2>
			</header>
		<?php endif; ?>

		<?php if ( ! empty( $testimonials ) ) : ?>
			<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
				<?php foreach ( $testimonials as $testimonial ) :
					$author_name = get_field( 'author_name', $testimonial->ID ) ?: $testimonial->post_title;
					$author_role = get_field( 'author_role', $testimonial->ID );
					$author_company = get_field( 'author_company', $testimonial->ID );
					$content = get_field( 'testimonial_content', $testimonial->ID ) ?: $testimonial->post_content;
					$rating = get_field( 'rating', $testimonial->ID ) ?: 5;
				?>
					<article class="card" data-animate="fade-up">
						<div class="card-body">
							<!-- Quote Icon -->
							<div class="text-cocoora-blue/20 mb-4">
								<svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
									<path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
								</svg>
							</div>

							<!-- Rating Stars -->
							<?php if ( $rating ) : ?>
								<div class="flex gap-1 mb-4">
									<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
										<svg class="w-5 h-5 <?php echo $i <= $rating ? 'text-yellow-400' : 'text-gray-200'; ?>" fill="currentColor" viewBox="0 0 20 20">
											<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
										</svg>
									<?php endfor; ?>
								</div>
							<?php endif; ?>

							<!-- Content -->
							<p class="text-gray-600 mb-6">
								<?php echo esc_html( wp_trim_words( strip_tags( $content ), 40 ) ); ?>
							</p>

							<!-- Author -->
							<div class="flex items-center gap-4">
								<?php if ( has_post_thumbnail( $testimonial->ID ) ) : ?>
									<img
										src="<?php echo esc_url( get_the_post_thumbnail_url( $testimonial->ID, 'thumbnail' ) ); ?>"
										alt="<?php echo esc_attr( $author_name ); ?>"
										class="w-12 h-12 rounded-full object-cover"
									>
								<?php else : ?>
									<div class="w-12 h-12 rounded-full bg-cocoora-blue/10 flex items-center justify-center text-cocoora-blue font-bold">
										<?php echo esc_html( mb_substr( $author_name, 0, 1 ) ); ?>
									</div>
								<?php endif; ?>
								<div>
									<p class="font-bold text-cocoora-navy"><?php echo esc_html( $author_name ); ?></p>
									<?php if ( $author_role || $author_company ) : ?>
										<p class="text-sm text-gray-500">
											<?php
											$meta_parts = array_filter( array( $author_role, $author_company ) );
											echo esc_html( implode( ' - ', $meta_parts ) );
											?>
										</p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p class="text-center text-gray-600">
				<?php esc_html_e( 'Nessuna testimonianza disponibile.', 'cocoora' ); ?>
			</p>
		<?php endif; ?>
	</div>
</section>
