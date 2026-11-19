<?php
/**
 * evive base — parent block theme. Everything visual lives in theme.json, templates and patterns;
 * this file only wires up what theme.json can't.
 *
 * @package evive
 */

defined( 'ABSPATH' ) || exit;

define( 'EVIVE_BASE_VERSION', '0.7.1' );

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
		'evive-pricing'  => _x( 'Pricing', 'pattern category', 'evive' ),
	];
	foreach ( $categories as $slug => $label ) {
		register_block_pattern_category( $slug, [ 'label' => $label ] );
	}
} );

// Block styles used by the patterns: "Card" (rounded, soft shadow; values in theme.json), "Motif"
// (large faded rounded-rectangle outlines behind a section), "Comparison" for tables and the device frames
// "Phone", "Browser window" and "Laptop" for screenshots (CSS in base.css).
add_action( 'init', function () {
	register_block_style( 'core/group', [ 'name' => 'card', 'label' => _x( 'Card', 'block style', 'evive' ) ] );
	register_block_style( 'core/group', [ 'name' => 'motif', 'label' => _x( 'Motif', 'block style', 'evive' ) ] );
	register_block_style( 'core/table', [ 'name' => 'comparison', 'label' => _x( 'Comparison', 'block style', 'evive' ) ] );
	register_block_style( 'core/image', [ 'name' => 'phone', 'label' => _x( 'Phone', 'block style', 'evive' ) ] );
	register_block_style( 'core/image', [ 'name' => 'phone-float', 'label' => _x( 'Phone, floating', 'block style', 'evive' ) ] );
	register_block_style( 'core/image', [ 'name' => 'browser', 'label' => _x( 'Browser window', 'block style', 'evive' ) ] );
	register_block_style( 'core/image', [ 'name' => 'laptop', 'label' => _x( 'Laptop', 'block style', 'evive' ) ] );
} );

// evive #411: theme blocks in blocks/ (Tabs). Their front-end script and CSS load only on pages that use them;
// the editor script's strings come from languages/evive-<locale>-<md5 of blocks/tabs/index.js>.json.
add_action( 'init', function () {
	register_block_type( __DIR__ . '/blocks/tabs' );
	register_block_type( __DIR__ . '/blocks/tab' );
	wp_set_script_translations( 'evive-tabs-editor-script', 'evive', get_template_directory() . '/languages' );
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

// Cases are ordinary posts in the category "Cases" (slug filterable). They get single-case.html
// automatically, unless the post has another template picked in the editor; the category page
// itself uses category-cases.html.
add_filter( 'single_template_hierarchy', function ( $templates ) {
	$post = get_queried_object();
	if ( ! $post instanceof WP_Post || 'post' !== $post->post_type || ! has_category( apply_filters( 'evive_case_category', 'cases' ), $post ) ) {
		return $templates;
	}
	foreach ( $templates as $i => $template ) {
		if ( str_starts_with( $template, 'single-post' ) ) {
			array_splice( $templates, $i, 0, 'single-case.php' );
			break;
		}
	}
	return $templates;
} );

// evive #412: the theme's own blocks (blocks/<name>/block.json). Their styles and front-end scripts load only on
// pages that contain the block. Asset versions follow the theme version, so an update busts browser caches.
add_filter( 'block_type_metadata', function ( $metadata ) {
	if ( str_starts_with( $metadata['name'] ?? '', 'evive/' ) ) {
		$metadata['version'] = EVIVE_BASE_VERSION;
	}
	return $metadata;
} );
add_action( 'init', function () {
	foreach ( glob( __DIR__ . '/blocks/*/block.json' ) as $evive_block ) {
		register_block_type( dirname( $evive_block ) );
	}
} );

// The editor scripts have no build step (no JSON translations): their strings come from here.
add_action( 'enqueue_block_editor_assets', function () {
	$images  = get_template_directory_uri() . '/assets/images/';
	$strings = [
		'before'            => _x( 'Before', 'before/after label', 'evive' ),
		'after'             => _x( 'After', 'before/after label', 'evive' ),
		'panel'             => _x( 'Before / after', 'block title', 'evive' ),
		'labelBefore'       => __( 'Label of the before image', 'evive' ),
		'labelAfter'        => __( 'Label of the after image', 'evive' ),
		'position'          => __( 'Start position of the divider (%)', 'evive' ),
		'help'              => __( 'Visitors drag the divider or use the arrow keys. Without JavaScript both images are shown side by side.', 'evive' ),
		'placeholderBefore' => $images . 'placeholder-before.svg',
		'placeholderAfter'  => $images . 'placeholder-after.svg',
	];
	wp_add_inline_script( generate_block_asset_handle( 'evive/before-after', 'editorScript' ), 'window.eviveBeforeAfter = ' . wp_json_encode( $strings ) . ';', 'before' );
} );
