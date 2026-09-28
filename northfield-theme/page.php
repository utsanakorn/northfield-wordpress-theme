<?php
/**
 * Default page template. Content is built with blocks.
 *
 * @package Northfield
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'entry' ); ?>>
		<?php if ( ! is_front_page() ) : ?>
			<header class="container page-head">
				<h1 class="page-head__title"><?php the_title(); ?></h1>
			</header>
		<?php endif; ?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</article>
	<?php
endwhile;

get_footer();
