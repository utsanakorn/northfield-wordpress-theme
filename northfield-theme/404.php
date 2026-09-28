<?php
/**
 * 404 page.
 *
 * @package Northfield
 */

get_header();
?>
<div class="container section">
	<h1 class="page-head__title"><?php esc_html_e( 'This page has moved or no longer exists', 'northfield' ); ?></h1>
	<p><?php esc_html_e( 'Search the site or browse all programs.', 'northfield' ); ?></p>
	<?php get_search_form(); ?>
	<p><a class="button" href="<?php echo esc_url( get_post_type_archive_link( 'program' ) ); ?>"><?php esc_html_e( 'Browse programs', 'northfield' ); ?></a></p>
</div>
<?php
get_footer();
