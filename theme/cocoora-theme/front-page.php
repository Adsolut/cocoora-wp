<?php
/**
 * The front page template
 *
 * This template is used for the site's front page.
 * Uses ACF flexible content for modular sections.
 *
 * @package Cocoora
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php
	// Check for ACF flexible content sections
	if ( function_exists( 'have_rows' ) && have_rows( 'sections' ) ) :

		while ( have_rows( 'sections' ) ) :
			the_row();

			// Get the layout name and load corresponding template part
			$layout = get_row_layout();
			get_template_part( 'template-parts/sections/section', $layout );

		endwhile;

	else :

		// Fallback content if no ACF sections or ACF not installed
		?>
		<section class="hero section bg-gradient-to-br from-cocoora-navy to-cocoora-blue text-white">
			<div class="container text-center">
				<h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
					<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
				</h1>
				<?php if ( get_bloginfo( 'description' ) ) : ?>
					<p class="text-xl md:text-2xl opacity-90 max-w-3xl mx-auto">
						<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
					</p>
				<?php endif; ?>
				<div class="mt-8 flex flex-wrap justify-center gap-4">
					<a href="#servizi" class="btn bg-white text-cocoora-navy hover:bg-cocoora-light">
						<?php esc_html_e( 'I Nostri Servizi', 'cocoora' ); ?>
					</a>
					<a href="#contatti" class="btn border-2 border-white text-white hover:bg-white hover:text-cocoora-navy">
						<?php esc_html_e( 'Contattaci', 'cocoora' ); ?>
					</a>
				</div>
			</div>
		</section>

		<?php if ( have_posts() ) : ?>
			<section class="section">
				<div class="container">
					<?php
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
					?>
				</div>
			</section>
		<?php endif; ?>

		<?php
	endif;
	?>
</main>

<?php
get_footer();
