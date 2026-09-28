<?php
/**
 * Programs archive at /programs/, with filtering by School.
 *
 * @package Northfield
 */

get_header();

$schools = get_terms( array( 'taxonomy' => 'school', 'hide_empty' => true ) );
$current = get_queried_object();
?>
<div class="container section">
	<header class="page-head">
		<h1 class="page-head__title"><?php esc_html_e( 'Find your program', 'northfield' ); ?></h1>
		<p class="page-head__lede"><?php esc_html_e( 'Career-focused diplomas and certificates, on campus or online.', 'northfield' ); ?></p>
	</header>

	<?php if ( $schools && ! is_wp_error( $schools ) ) : ?>
		<nav class="filter" aria-label="<?php esc_attr_e( 'Filter by school', 'northfield' ); ?>">
			<a class="filter__link<?php echo is_post_type_archive( 'program' ) ? ' is-active' : ''; ?>" href="<?php echo esc_url( get_post_type_archive_link( 'program' ) ); ?>"><?php esc_html_e( 'All schools', 'northfield' ); ?></a>
			<?php foreach ( $schools as $school ) : ?>
				<a class="filter__link<?php echo ( $current instanceof WP_Term && $current->term_id === $school->term_id ) ? ' is-active' : ''; ?>" href="<?php echo esc_url( get_term_link( $school ) ); ?>"><?php echo esc_html( $school->name ); ?></a>
			<?php endforeach; ?>
		</nav>
	<?php endif; ?>

	<?php if ( have_posts() ) : ?>
		<ul class="program-list">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/program', 'row' );
			endwhile;
			?>
		</ul>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No programs are listed in this school yet.', 'northfield' ); ?></p>
	<?php endif; ?>
</div>
<?php
get_footer();
