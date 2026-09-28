<?php
/**
 * ACF block: Graduate Story.
 *
 * @var array $block      Block settings.
 * @var bool  $is_preview True in the editor.
 *
 * @package Northfield
 */

$quote   = get_field( 'quote' );
$name    = get_field( 'graduate_name' );
$role    = get_field( 'current_role' );
$program = get_field( 'program' ); // Post object (Program CPT).
$photo   = get_field( 'photo' );   // Image ID.

$anchor = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
$class  = 'nf-story' . ( ! empty( $block['className'] ) ? ' ' . $block['className'] : '' );

if ( ! $quote ) {
	if ( $is_preview ) {
		echo '<p class="nf-story nf-story--empty">' . esc_html__( 'Add a graduate quote in the block settings.', 'northfield' ) . '</p>';
	}
	return;
}
?>
<figure class="<?php echo esc_attr( $class ); ?>"<?php echo $anchor; // phpcs:ignore ?>>
	<?php if ( $photo ) : ?>
		<?php echo wp_get_attachment_image( $photo, 'thumbnail', false, array( 'class' => 'nf-story__photo' ) ); ?>
	<?php endif; ?>
	<blockquote class="nf-story__quote">
		<p><?php echo esc_html( $quote ); ?></p>
	</blockquote>
	<figcaption class="nf-story__caption">
		<strong><?php echo esc_html( $name ); ?></strong>
		<?php if ( $role ) : ?>
			<span><?php echo esc_html( $role ); ?></span>
		<?php endif; ?>
		<?php if ( $program instanceof WP_Post ) : ?>
			<a href="<?php echo esc_url( get_permalink( $program ) ); ?>"><?php echo esc_html( get_the_title( $program ) ); ?></a>
		<?php endif; ?>
	</figcaption>
</figure>
