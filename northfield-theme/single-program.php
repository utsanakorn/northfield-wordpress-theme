<?php
/**
 * Single Program. Pulls structured data from ACF fields.
 *
 * @package Northfield
 */

get_header();

while ( have_posts() ) :
	the_post();
	$credential = northfield_field( 'credential' );
	$duration   = northfield_field( 'duration' );
	$next_start = northfield_field( 'next_start' );
	$apply_url  = northfield_field( 'apply_url' );
	$delivery   = northfield_delivery_label();
	$schools    = get_the_terms( get_the_ID(), 'school' );
	?>
	<article <?php post_class( 'program' ); ?>>
		<header class="program-head">
			<div class="container program-head__inner">
				<?php if ( $schools && ! is_wp_error( $schools ) ) : ?>
					<p class="program-head__school"><?php echo esc_html( $schools[0]->name ); ?></p>
				<?php endif; ?>
				<h1 class="program-head__title"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="program-head__lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
			</div>
		</header>

		<div class="container program-body">
			<aside class="program-facts" aria-label="<?php esc_attr_e( 'Program facts', 'northfield' ); ?>">
				<dl>
					<?php if ( $credential ) : ?>
						<div><dt><?php esc_html_e( 'Credential', 'northfield' ); ?></dt><dd><?php echo esc_html( ucfirst( $credential ) ); ?></dd></div>
					<?php endif; ?>
					<?php if ( $duration ) : ?>
						<div><dt><?php esc_html_e( 'Length', 'northfield' ); ?></dt><dd><?php echo esc_html( $duration ); ?></dd></div>
					<?php endif; ?>
					<?php if ( $delivery ) : ?>
						<div><dt><?php esc_html_e( 'Study', 'northfield' ); ?></dt><dd><?php echo esc_html( $delivery ); ?></dd></div>
					<?php endif; ?>
					<?php if ( $next_start ) : ?>
						<div><dt><?php esc_html_e( 'Next start', 'northfield' ); ?></dt><dd><?php echo esc_html( $next_start ); ?></dd></div>
					<?php endif; ?>
				</dl>
				<?php if ( $apply_url ) : ?>
					<a class="button button--accent" href="<?php echo esc_url( $apply_url ); ?>"><?php esc_html_e( 'Apply for this program', 'northfield' ); ?></a>
				<?php endif; ?>
			</aside>

			<div class="entry-content program-content">
				<?php the_content(); ?>
			</div>
		</div>
	</article>
	<?php
endwhile;

get_footer();
