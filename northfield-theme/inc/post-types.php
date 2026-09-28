<?php
/**
 * Custom post type: Program, and taxonomy: School.
 *
 * @package Northfield
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_post_type(
		'program',
		array(
			'labels'       => array(
				'name'          => __( 'Programs', 'northfield' ),
				'singular_name' => __( 'Program', 'northfield' ),
				'add_new_item'  => __( 'Add new program', 'northfield' ),
				'edit_item'     => __( 'Edit program', 'northfield' ),
				'all_items'     => __( 'All programs', 'northfield' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => array( 'slug' => 'programs' ),
			'menu_icon'    => 'dashicons-welcome-learn-more',
			'show_in_rest' => true, // Needed for the block editor and the Program Grid block.
			'rest_base'    => 'programs',
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
		)
	);

	register_taxonomy(
		'school',
		'program',
		array(
			'labels'            => array(
				'name'          => __( 'Schools', 'northfield' ),
				'singular_name' => __( 'School', 'northfield' ),
			),
			'hierarchical'      => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'school' ),
		)
	);
} );

/**
 * Flush rewrite rules once when the theme is activated so /programs/ works.
 */
add_action( 'after_switch_theme', 'flush_rewrite_rules' );
