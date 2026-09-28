<?php
/**
 * Northfield College theme bootstrap.
 *
 * @package Northfield
 */

defined( 'ABSPATH' ) || exit;

define( 'NORTHFIELD_VERSION', '1.0.0' );
define( 'NORTHFIELD_DIR', get_template_directory() );
define( 'NORTHFIELD_URI', get_template_directory_uri() );

require_once NORTHFIELD_DIR . '/inc/setup.php';
require_once NORTHFIELD_DIR . '/inc/enqueue.php';
require_once NORTHFIELD_DIR . '/inc/post-types.php';
require_once NORTHFIELD_DIR . '/inc/acf-fields.php';
require_once NORTHFIELD_DIR . '/inc/blocks.php';
require_once NORTHFIELD_DIR . '/inc/template-tags.php';
