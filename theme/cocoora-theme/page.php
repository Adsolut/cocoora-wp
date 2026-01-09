<?php
/**
 * The template for displaying all pages
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

			<?php if ( has_post_thumbnail() && ! get_field( 'hide_featured_image' ) ) : ?>
				<div class="page-hero relative h-64 md:h-96 bg-cocoora-navy">
					<?php
					the_post_thumbnail(
						'cocoora-hero',
						array(
							'class' => 'absolute inset-0 w-full h-full object-cover opacity-50',
						)
					);
					?>
					<div class="absolute inset-0 flex items-center justify-center">
						<div class="container text-center text-white">
							<h1 class="text-4xl md:text-5xl font-bold"><?php the_title(); ?></h1>
						</div>
					</div>
				</div>
			<?php else : ?>
				<header class="page-header bg-cocoora-light py-12">
					<div class="container">
						<h1 class="text-4xl md:text-5xl font-bold text-cocoora-navy"><?php the_title(); ?></h1>
					</div>
				</header>
			<?php endif; ?>

			<div class="page-content section">
				<div class="container-narrow prose prose-lg max-w-none">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pagine:', 'cocoora' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>
			</div>

		</article>

		<?php
	endwhile;
	?>
</main>

<?php
get_footer();
