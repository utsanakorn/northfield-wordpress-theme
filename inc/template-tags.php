<?php
/**
 * Small helpers used in templates.
 *
 * @package Northfield
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get a Program field, with a safe fallback when ACF is inactive.
 *
 * @param string   $name    Field name.
 * @param int|null $post_id Post ID.
 * @return mixed
 */
function northfield_field( $name, $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	if ( function_exists( 'get_field' ) ) {
		return get_field( $name, $post_id );
	}
	return get_post_meta( $post_id, $name, true );
}

/**
 * Human-readable delivery label, e.g. "On campus or online".
 *
 * @param int|null $post_id Post ID.
 * @return string
 */
function northfield_delivery_label( $post_id = null ) {
	$delivery = (array) northfield_field( 'delivery', $post_id );
	$labels   = array(
		'campus' => __( 'On campus', 'northfield' ),
		'online' => __( 'Online', 'northfield' ),
	);
	$out = array();
	foreach ( $delivery as $key ) {
		if ( isset( $labels[ $key ] ) ) {
			$out[] = $labels[ $key ];
		}
	}
	return ucfirst( strtolower( implode( __( ' or ', 'northfield' ), $out ) ) );
}
