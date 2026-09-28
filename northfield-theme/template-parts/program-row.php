<?php
/**
 * One program in a list. Used by archive-program.php and the Program Grid block.
 *
 * @package Northfield
 */

$duration = northfield_field( 'duration' );
$delivery = northfield_delivery_label();
?>
<li class="program-row">
	<a class="program-row__link" href="<?php the_permalink(); ?>">
		<span class="program-row__title"><?php the_title(); ?></span>
		<span class="program-row__meta">
			<?php if ( $duration ) : ?>
				<span><?php echo esc_html( $duration ); ?></span>
			<?php endif; ?>
			<?php if ( $delivery ) : ?>
				<span><?php echo esc_html( $delivery ); ?></span>
			<?php endif; ?>
		</span>
	</a>
</li>
