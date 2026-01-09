<?php
/**
 * The template for displaying single posts
 *
 * @package Cocoora
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- Hero Section -->
			<header class="entry-header relative bg-cocoora-navy text-white py-16 md:py-24">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="absolute inset-0">
						<?php
						the_post_thumbnail(
							'cocoora-hero',
							array(
								'class' => 'w-full h-full object-cover opacity-30',
							)
						);
						?>
					</div>
				<?php endif; ?>

				<div class="container relative z-10">
					<div class="max-w-3xl">
						<?php
						$categories = get_the_category();
						if ( ! empty( $categories ) ) :
							?>
							<div class="mb-4">
								<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" class="inline-block px-3 py-1 bg-cocoora-blue rounded-full text-sm font-medium">
									<?php echo esc_html( $categories[0]->name ); ?>
								</a>
							</div>
						<?php endif; ?>

						<h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
							<?php the_title(); ?>
						</h1>

						<div class="flex flex-wrap items-center gap-4 text-gray-300 text-sm">
							<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
								<?php echo esc_html( get_the_date() ); ?>
							</time>
							<span>&bull;</span>
							<span><?php echo esc_html( cocoora_reading_time() ); ?></span>
						</div>
					</div>
				</div>
			</header>

			<!-- Content -->
			<div class="entry-content section">
				<div class="container">
					<div class="grid lg:grid-cols-12 gap-12">
						<!-- Main Content -->
						<div class="lg:col-span-8">
							<div class="prose prose-lg max-w-none">
								<?php the_content(); ?>
							</div>

							<?php
							wp_link_pages(
								array(
									'before' => '<div class="page-links my-8">' . esc_html__( 'Pagine:', 'cocoora' ),
									'after'  => '</div>',
								)
							);
							?>

							<!-- Tags -->
							<?php
							$tags = get_the_tags();
							if ( $tags ) :
								?>
								<div class="entry-tags mt-8 pt-8 border-t border-gray-200">
									<span class="font-medium text-cocoora-navy"><?php esc_html_e( 'Tags:', 'cocoora' ); ?></span>
									<div class="flex flex-wrap gap-2 mt-2">
										<?php foreach ( $tags as $tag ) : ?>
											<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="px-3 py-1 bg-cocoora-light text-cocoora-navy rounded-full text-sm hover:bg-cocoora-blue hover:text-white transition-colors">
												<?php echo esc_html( $tag->name ); ?>
											</a>
										<?php endforeach; ?>
									</div>
								</div>
							<?php endif; ?>

							<!-- Author Box -->
							<div class="entry-author mt-8 p-6 bg-cocoora-light rounded-xl">
								<div class="flex items-start gap-4">
									<?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', '', array( 'class' => 'rounded-full' ) ); ?>
									<div>
										<h3 class="font-bold text-cocoora-navy">
											<?php the_author(); ?>
										</h3>
										<?php if ( get_the_author_meta( 'description' ) ) : ?>
											<p class="text-gray-600 mt-2">
												<?php echo esc_html( get_the_author_meta( 'description' ) ); ?>
											</p>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>

						<!-- Sidebar -->
						<aside class="lg:col-span-4">
							<div class="sticky top-24 space-y-8">
								<!-- Related Posts -->
								<?php
								$related_posts = new WP_Query(
									array(
										'post_type'      => 'post',
										'posts_per_page' => 3,
										'post__not_in'   => array( get_the_ID() ),
										'category__in'   => wp_get_post_categories( get_the_ID() ),
									)
								);

								if ( $related_posts->have_posts() ) :
									?>
									<div class="related-posts">
										<h3 class="text-lg font-bold text-cocoora-navy mb-4">
											<?php esc_html_e( 'Articoli Correlati', 'cocoora' ); ?>
										</h3>
										<div class="space-y-4">
											<?php
											while ( $related_posts->have_posts() ) :
												$related_posts->the_post();
												?>
												<article class="flex gap-4">
													<?php if ( has_post_thumbnail() ) : ?>
														<a href="<?php the_permalink(); ?>" class="flex-shrink-0 w-20 h-20">
															<?php
															the_post_thumbnail(
																'cocoora-thumbnail',
																array(
																	'class' => 'w-full h-full object-cover rounded-lg',
																)
															);
															?>
														</a>
													<?php endif; ?>
													<div>
														<h4 class="font-medium text-cocoora-navy hover:text-cocoora-blue">
															<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
														</h4>
														<time class="text-sm text-gray-500">
															<?php echo esc_html( get_the_date() ); ?>
														</time>
													</div>
												</article>
											<?php endwhile; ?>
										</div>
									</div>
									<?php
									wp_reset_postdata();
								endif;
								?>
							</div>
						</aside>
					</div>
				</div>
			</div>

		</article>

		<!-- Post Navigation -->
		<nav class="post-navigation bg-cocoora-light py-8">
			<div class="container">
				<div class="flex justify-between">
					<?php
					$prev_post = get_previous_post();
					$next_post = get_next_post();
					?>

					<?php if ( $prev_post ) : ?>
						<a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>" class="flex items-center gap-2 text-cocoora-navy hover:text-cocoora-blue">
							<span>&larr;</span>
							<span><?php esc_html_e( 'Precedente', 'cocoora' ); ?></span>
						</a>
					<?php else : ?>
						<span></span>
					<?php endif; ?>

					<?php if ( $next_post ) : ?>
						<a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>" class="flex items-center gap-2 text-cocoora-navy hover:text-cocoora-blue">
							<span><?php esc_html_e( 'Successivo', 'cocoora' ); ?></span>
							<span>&rarr;</span>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</nav>

		<?php
	endwhile;
	?>
</main>

<?php
get_footer();
