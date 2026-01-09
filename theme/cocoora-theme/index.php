<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @package Cocoora
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container py-12">
		<?php if ( have_posts() ) : ?>

			<header class="page-header mb-8">
				<?php if ( is_home() && ! is_front_page() ) : ?>
					<h1 class="page-title text-4xl font-bold text-cocoora-navy">
						<?php single_post_title(); ?>
					</h1>
				<?php elseif ( is_archive() ) : ?>
					<?php the_archive_title( '<h1 class="page-title text-4xl font-bold text-cocoora-navy">', '</h1>' ); ?>
					<?php the_archive_description( '<div class="archive-description mt-4 text-gray-600">', '</div>' ); ?>
				<?php elseif ( is_search() ) : ?>
					<h1 class="page-title text-4xl font-bold text-cocoora-navy">
						<?php
						printf(
							/* translators: %s: search query */
							esc_html__( 'Risultati per: %s', 'cocoora' ),
							'<span class="text-cocoora-blue">' . get_search_query() . '</span>'
						);
						?>
					</h1>
				<?php endif; ?>
			</header>

			<div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;
				?>
			</div>

			<nav class="pagination mt-12">
				<?php
				the_posts_pagination(
					array(
						'prev_text' => '&larr; ' . __( 'Precedente', 'cocoora' ),
						'next_text' => __( 'Successivo', 'cocoora' ) . ' &rarr;',
						'class'     => 'flex items-center justify-center gap-2',
					)
				);
				?>
			</nav>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
