<?php
/**
 * evive base — parent block theme. Everything visual lives in theme.json, templates and patterns;
 * this file only wires up what theme.json can't.
 *
 * @package evive
 */

defined( 'ABSPATH' ) || exit;

define( 'EVIVE_BASE_VERSION', '0.8.1' );

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
	// evive #414: a big number that counts up once when it scrolls into view (assets/js/count-up.js).
	register_block_style( 'core/paragraph', [ 'name' => 'count-up', 'label' => _x( 'Count up', 'block style', 'evive' ) ] );
} );

// evive #411: theme blocks in blocks/ (Tabs). Their front-end script and CSS load only on pages that use them;
// the editor script's strings come from languages/evive-<locale>-<md5 of blocks/tabs/index.js>.json.
// (0.8.0 batch: the blocks themselves are registered by the blocks/*/block.json loop further down, evive #412.)
add_action( 'init', function () {
	wp_set_script_translations( 'evive-tabs-editor-script', 'evive', get_template_directory() . '/languages' );
}, 11 );

// evive #413: moving variants of the logo wall and the testimonials grid, as block styles an editor can
// switch on. "Moving strip" (Group): a slow continuous strip, CSS only. The server repeats the logos
// (the copies are aria-hidden and inert) so the loop has no gap; it pauses on hover, on focus and with
// the "Pause animation" checkbox, and stands still as a normal scrollable row with reduced motion.
// "Carousel" (Columns): a scroll-snap row; a small script adds previous/next buttons. Without
// JavaScript both are a plain scrollable row.
add_action( 'init', function () {
	register_block_style( 'core/group', [ 'name' => 'logo-strip', 'label' => _x( 'Moving strip', 'block style', 'evive' ) ] );
	register_block_style( 'core/columns', [ 'name' => 'carousel', 'label' => _x( 'Carousel', 'block style', 'evive' ) ] );
	wp_register_script( 'evive-carousel', get_template_directory_uri() . '/assets/js/carousel.js', [], EVIVE_BASE_VERSION, [ 'in_footer' => true, 'strategy' => 'defer' ] );
} );

add_filter( 'render_block_core/group', function ( $html, $block ) {
	if ( ! str_contains( $block['attrs']['className'] ?? '', 'is-style-logo-strip' ) || empty( $block['innerBlocks'] ) ) {
		return $html;
	}
	$start = strpos( $html, '>' );
	$end   = strrpos( $html, '</' );
	if ( false === $start || false === $end || $end <= $start ) {
		return $html;
	}
	$items  = count( $block['innerBlocks'] );
	$copies = min( 8, 1 + (int) ceil( 13 / $items ) ); // enough copies to fill a wide screen
	$inner  = substr( $html, $start + 1, $end - $start - 1 );
	$track  = '<div class="evive-strip-track">';
	for ( $i = 0; $i < $copies; $i++ ) {
		$track .= 0 === $i ? '<div class="evive-strip-set">' . $inner . '</div>' : '<div class="evive-strip-set" aria-hidden="true" inert>' . $inner . '</div>';
	}
	$track .= '</div>';
	$tags = new WP_HTML_Tag_Processor( substr( $html, 0, $start + 1 ) );
	if ( ! $tags->next_tag() ) {
		return $html;
	}
	$tags->add_class( 'evive-strip-on' );
	$style = rtrim( (string) $tags->get_attribute( 'style' ), '; ' );
	$tags->set_attribute( 'style', ltrim( $style . ';--evive-strip-copies:' . $copies . ';--evive-strip-duration:' . ( 5 * $items ) . 's', ';' ) );
	$pause = '<label class="evive-strip-pause has-xs-font-size"><input type="checkbox"> ' . esc_html_x( 'Pause animation', 'logo strip', 'evive' ) . '</label>';
	return $tags->get_updated_html() . $track . substr( $html, $end ) . $pause;
}, 10, 2 );

add_filter( 'render_block_core/columns', function ( $html, $block ) {
	if ( ! str_contains( $block['attrs']['className'] ?? '', 'is-style-carousel' ) ) {
		return $html;
	}
	$tags = new WP_HTML_Tag_Processor( $html );
	if ( ! $tags->next_tag() ) {
		return $html;
	}
	$id = $tags->get_attribute( 'id' );
	if ( ! $id ) {
		$id = wp_unique_id( 'evive-carousel-' );
		$tags->set_attribute( 'id', $id );
	}
	$tags->set_attribute( 'role', 'region' );
	$tags->set_attribute( 'aria-label', _x( 'Carousel', 'carousel region', 'evive' ) );
	$tags->set_attribute( 'tabindex', '0' );
	$arrow = '<svg aria-hidden="true" focusable="false" width="20" height="20" viewBox="0 0 24 24"><path d="%s" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
	$nav   = '<div class="evive-carousel-nav" hidden>'
		. '<button type="button" class="evive-carousel-prev" aria-controls="' . esc_attr( $id ) . '" aria-label="' . esc_attr_x( 'Previous', 'carousel', 'evive' ) . '">' . sprintf( $arrow, 'M15 18l-6-6 6-6' ) . '</button>'
		. '<button type="button" class="evive-carousel-next" aria-controls="' . esc_attr( $id ) . '" aria-label="' . esc_attr_x( 'Next', 'carousel', 'evive' ) . '">' . sprintf( $arrow, 'M9 6l6 6-6 6' ) . '</button>'
		. '</div>';
	wp_enqueue_script( 'evive-carousel' );
	return $tags->get_updated_html() . $nav;
}, 10, 2 );

// evive #414: the count-up script loads only on pages with a "Count up" paragraph. Block themes render
// the template before wp_head, so enqueueing here still lands in the footer of the same page. The number
// itself stays in the HTML; without JavaScript or with reduced motion it simply shows.
add_filter( 'render_block_core/paragraph', function ( $html, $block ) {
	if ( ! is_admin() && str_contains( $block['attrs']['className'] ?? '', 'is-style-count-up' ) ) {
		wp_enqueue_script( 'evive-count-up', get_template_directory_uri() . '/assets/js/count-up.js', [], EVIVE_BASE_VERSION, [ 'in_footer' => true, 'strategy' => 'defer' ] );
	}
	return $html;
}, 10, 2 );

// evive #513: a sticky group (the "Header, sticky" pattern, or a header group set to sticky) loads a small
// script that keeps the anchor offset (scroll-padding-top in base.css) equal to the sticky header's height.
add_filter( 'render_block_core/group', function ( $html, $block ) {
	if ( ! is_admin() && 'sticky' === ( $block['attrs']['style']['position']['type'] ?? '' ) ) {
		wp_enqueue_script( 'evive-sticky-header', get_template_directory_uri() . '/assets/js/sticky-header.js', [], EVIVE_BASE_VERSION, [ 'in_footer' => true, 'strategy' => 'defer' ] );
	}
	return $html;
}, 10, 2 );

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
