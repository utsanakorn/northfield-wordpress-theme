<?php
/**
 * Front-end assets.
 *
 * @package Northfield
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'northfield-fonts',
		'https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700&family=Source+Sans+3:wght@400;600&display=swap',
		array(),
		null
	);

	$css = NORTHFIELD_DIR . '/assets/css/main.css';
	wp_enqueue_style(
		'northfield-main',
		NORTHFIELD_URI . '/assets/css/main.css',
		array( 'northfield-fonts' ),
		file_exists( $css ) ? filemtime( $css ) : NORTHFIELD_VERSION
	);

	wp_enqueue_script(
		'northfield-nav',
		NORTHFIELD_URI . '/assets/js/navigation.js',
		array(),
		NORTHFIELD_VERSION,
		array( 'strategy' => 'defer', 'in_footer' => true )
	);
} );

/**
 * Preconnect to Google Fonts for faster font loading (Core Web Vitals).
 */
add_filter( 'wp_resource_hints', function ( $urls, $relation ) {
	if ( 'preconnect' === $relation ) {
		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
	}
	return $urls;
}, 10, 2 );
