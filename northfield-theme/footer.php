<?php
/**
 * Site footer.
 *
 * @package Northfield
 */
?>
</main>

<footer class="site-footer">
	<div class="container site-footer__inner">
		<p class="site-footer__name"><?php bloginfo( 'name' ); ?></p>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'footer',
				'container'      => 'nav',
				'container_attr' => array( 'aria-label' => __( 'Footer', 'northfield' ) ),
				'menu_class'     => 'footer-nav',
				'fallback_cb'    => false,
				'depth'          => 1,
			)
		);
		?>
		<p class="site-footer__legal">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
