<?php
/**
 * Server render for northfield/program-grid.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Inner content (unused).
 * @var WP_Block $block      Block instance.
 *
 * @package Northfield
 */

$args = array(
	'post_type'      => 'program',
	'posts_per_page' => max( 1, min( 12, (int) ( $attributes['count'] ?? 6 ) ) ),
	'orderby'        => 'title',
	'order'          => 'ASC',
	'no_found_rows'  => true, // No pagination here, so skip the COUNT query.
);

if ( ! empty( $attributes['school'] ) ) {
	$args['tax_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery
		array(
			'taxonomy' => 'school',
			'field'    => 'term_id',
			'terms'    => (int) $attributes['school'],
		),
	);
}

$programs = new WP_Query( $args );

if ( ! $programs->have_posts() ) {
	return;
}
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'nf-programs' ) ); // phpcs:ignore ?>>
	<?php if ( ! empty( $attributes['heading'] ) ) : ?>
		<h2 class="nf-programs__heading"><?php echo wp_kses_post( $attributes['heading'] ); ?></h2>
	<?php endif; ?>
	<ul class="program-list">
		<?php
		while ( $programs->have_posts() ) :
			$programs->the_post();
			get_template_part( 'template-parts/program', 'row' );
		endwhile;
		wp_reset_postdata();
		?>
	</ul>
	<a class="nf-programs__all" href="<?php echo esc_url( get_post_type_archive_link( 'program' ) ); ?>"><?php esc_html_e( 'See all programs', 'northfield' ); ?></a>
</section>
