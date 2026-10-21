<?php
/**
 * evive base — parent block theme. Everything visual lives in theme.json, templates and patterns;
 * this file only wires up what theme.json can't.
 *
 * @package evive
 */

defined( 'ABSPATH' ) || exit;

define( 'EVIVE_BASE_VERSION', '0.3.0' );

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

// Block styles used by the patterns: "Card" (rounded, soft shadow; values in theme.json) and
// "Motif" (large faded rounded-rectangle outlines behind a section; CSS in base.css).
add_action( 'init', function () {
	register_block_style( 'core/group', [ 'name' => 'card', 'label' => _x( 'Card', 'block style', 'evive' ) ] );
	register_block_style( 'core/group', [ 'name' => 'motif', 'label' => _x( 'Motif', 'block style', 'evive' ) ] );
} );

// FAQ pattern: a group with the class "evive-faq" gets FAQPage structured data built from its
// Details blocks (question = summary, answer = the content), so editors only edit the visible text.
add_filter( 'render_block_core/group', function ( $html, $block ) {
	if ( ! str_contains( $block['attrs']['className'] ?? '', 'evive-faq' ) ) {
		return $html;
	}
	$items = [];
	$walk  = function ( $blocks ) use ( &$walk, &$items ) {
		foreach ( $blocks as $inner ) {
			if ( 'core/details' === $inner['blockName'] ) {
				$question = trim( wp_strip_all_tags( $inner['attrs']['summary'] ?? '' ) );
				$answer   = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( implode( ' ', array_map( 'render_block', $inner['innerBlocks'] ) ) ) ) );
				if ( '' !== $question && '' !== $answer ) {
					$items[] = [ '@type' => 'Question', 'name' => $question, 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $answer ] ];
				}
			} elseif ( ! empty( $inner['innerBlocks'] ) ) {
				$walk( $inner['innerBlocks'] );
			}
		}
	};
	$walk( $block['innerBlocks'] );
	if ( ! $items ) {
		return $html;
	}
	$data = [ '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $items ];
	return $html . '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG ) . '</script>';
}, 10, 2 );

// front-page.html shows the static front page's content. When the front page lists the latest posts,
// skip it so the posts index (home.html / index.html) is used instead.
add_filter( 'frontpage_template_hierarchy', function ( $templates ) {
	return 'page' === get_option( 'show_on_front' ) ? $templates : [];
} );

// Header/footer brand: the site title is only a fallback for sites without a logo.
add_filter( 'render_block_core/site-title', function ( $html, $block ) {
	$classes = $block['attrs']['className'] ?? '';
	return ( str_contains( $classes, 'evive-site-title-fallback' ) && has_custom_logo() ) ? '' : $html;
}, 10, 2 );

// Social links without any URL filled in render as an empty list: drop it.
add_filter( 'render_block_core/social-links', function ( $html ) {
	return str_contains( $html, '<li' ) ? $html : '';
} );

// Mobile menu toggle: core sets aria-haspopup but no aria-expanded; bind it to core's own menu state.
add_filter( 'render_block_core/navigation', function ( $html ) {
	return str_replace(
		'class="wp-block-navigation__responsive-container-open"',
		'class="wp-block-navigation__responsive-container-open" aria-expanded="false" data-wp-bind--aria-expanded="state.isMenuOpen"',
		$html
	);
} );
