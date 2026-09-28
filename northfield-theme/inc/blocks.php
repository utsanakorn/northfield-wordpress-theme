<?php
/**
 * Block registration.
 * - React blocks are compiled by @wordpress/scripts into /build/blocks.
 * - ACF blocks (PHP render templates) live in /acf-blocks and need ACF Pro.
 *
 * @package Northfield
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	$build = NORTHFIELD_DIR . '/build/blocks';
	if ( is_dir( $build ) ) {
		foreach ( glob( $build . '/*/block.json' ) as $block_json ) {
			register_block_type( dirname( $block_json ) );
		}
	}

	if ( function_exists( 'acf_register_block_type' ) ) {
		foreach ( glob( NORTHFIELD_DIR . '/acf-blocks/*/block.json' ) as $block_json ) {
			register_block_type( dirname( $block_json ) );
		}
	}
} );

/**
 * Put the theme's blocks in their own inserter category.
 */
add_filter( 'block_categories_all', function ( $categories ) {
	array_unshift(
		$categories,
		array(
			'slug'  => 'northfield',
			'title' => __( 'Northfield', 'northfield' ),
		)
	);
	return $categories;
} );
