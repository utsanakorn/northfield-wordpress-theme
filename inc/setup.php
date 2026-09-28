<?php
/**
 * Theme supports and menus.
 *
 * @package Northfield
 */

defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'northfield', NORTHFIELD_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'custom-logo', array( 'height' => 48, 'width' => 200, 'flex-width' => true ) );

	add_editor_style( 'assets/css/main.css' );

	add_image_size( 'northfield-card', 640, 400, true );

	register_nav_menus(
		array(
			'primary' => __( 'Primary menu', 'northfield' ),
			'footer'  => __( 'Footer menu', 'northfield' ),
		)
	);
} );
