<?php
/**
 * evive base — parent block theme. Everything visual lives in theme.json, templates and patterns;
 * this file only wires up what theme.json can't.
 *
 * @package evive
 */

defined( 'ABSPATH' ) || exit;

define( 'EVIVE_BASE_VERSION', '0.1.1' );

require_once __DIR__ . '/inc/updates.php';

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'evive', get_template_directory() . '/languages' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/base.css' );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'evive-base', get_template_directory_uri() . '/assets/css/base.css', [], EVIVE_BASE_VERSION );
} );

add_action( 'init', function () {
	$categories = [
		'evive-hero'     => _x( 'Hero', 'pattern category', 'evive' ),
		'evive-features' => _x( 'Features', 'pattern category', 'evive' ),
		'evive-proof'    => _x( 'Proof', 'pattern category', 'evive' ),
		'evive-cta'      => _x( 'Call to action', 'pattern category', 'evive' ),
		'evive-content'  => _x( 'Content', 'pattern category', 'evive' ),
	];
	foreach ( $categories as $slug => $label ) {
		register_block_pattern_category( $slug, [ 'label' => $label ] );
	}
} );

// front-page.html shows the static front page's content. When the front page lists the latest posts,
// skip it so the posts index (home.html / index.html) is used instead.
add_filter( 'frontpage_template_hierarchy', function ( $templates ) {
	return 'page' === get_option( 'show_on_front' ) ? $templates : [];
} );
