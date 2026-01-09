<?php
/**
 * Template part for displaying posts
 *
 * @package Cocoora
 * @since 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="block aspect-video overflow-hidden">
			<?php
			the_post_thumbnail(
				'cocoora-card',
				array(
					'class' => 'w-full h-full object-cover transition-transform duration-300 hover:scale-105',
				)
			);
			?>
		</a>
	<?php endif; ?>

	<div class="card-body">
		<?php
		$categories = get_the_category();
		if ( ! empty( $categories ) ) :
			?>
			<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" class="inline-block text-xs font-semibold text-cocoora-blue uppercase tracking-wider mb-2">
				<?php echo esc_html( $categories[0]->name ); ?>
			</a>
		<?php endif; ?>

		<h2 class="text-xl font-bold mb-2">
			<a href="<?php the_permalink(); ?>" class="text-cocoora-navy hover:text-cocoora-blue transition-colors">
				<?php the_title(); ?>
			</a>
		</h2>

		<div class="text-gray-600 text-sm mb-4">
			<?php the_excerpt(); ?>
		</div>

		<div class="flex items-center justify-between text-sm text-gray-500">
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
				<?php echo esc_html( get_the_date() ); ?>
			</time>
			<span><?php echo esc_html( cocoora_reading_time() ); ?></span>
		</div>
	</div>
</article>
