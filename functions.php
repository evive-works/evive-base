<?php
/**
 * evive base — parent block theme. Everything visual lives in theme.json, templates and patterns;
 * this file only wires up what theme.json can't.
 *
 * @package evive
 */

defined( 'ABSPATH' ) || exit;

define( 'EVIVE_BASE_VERSION', '0.11.0' );

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

// evive #580: the Comments block renders only when comments are open on that post, so a site with comments
// closed (evive's default) shows no comments area at all, not "Comments are closed" or old comments.
// To keep showing a closed post's existing comments: add_filter( 'evive_show_comments', ..., 10, 2 ).
add_filter( 'render_block_core/comments', function ( $html, $block, $instance = null ) {
	$post_id = (int) ( $instance->context['postId'] ?? get_the_ID() );
	return apply_filters( 'evive_show_comments', $post_id && comments_open( $post_id ), $post_id ) ? $html : '';
}, 10, 3 );

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

	// evive #516: media with an overlapping card.
	$strings = [
		'panel'          => _x( 'Card', 'media-overlap panel', 'evive' ),
		'corner'         => __( 'Card position', 'evive' ),
		'bottomLeft'     => __( 'Bottom left', 'evive' ),
		'bottomRight'    => __( 'Bottom right', 'evive' ),
		'topLeft'        => __( 'Top left', 'evive' ),
		'topRight'       => __( 'Top right', 'evive' ),
		'offsetX'        => __( 'Sticks out sideways', 'evive' ),
		'offsetY'        => __( 'Sticks out vertically', 'evive' ),
		'offsetHelp'     => __( 'How far the card sticks out beyond the image (spacing steps). The block reserves that space, so nothing next to or below it is covered.', 'evive' ),
		'width'          => __( 'Card width (% of the image)', 'evive' ),
		'background'     => __( 'Card background', 'evive' ),
		'backgroundHelp' => __( 'Theme colours only. No colour: transparent card.', 'evive' ),
		'radius'         => __( 'Card corners', 'evive' ),
		'padding'        => __( 'Padding inside the card', 'evive' ),
		'shadow'         => __( 'Shadow', 'evive' ),
		'none'           => _x( 'None', 'media-overlap option', 'evive' ),
		'small'          => _x( 'Small', 'media-overlap option', 'evive' ),
		'medium'         => _x( 'Medium', 'media-overlap option', 'evive' ),
		'large'          => _x( 'Large', 'media-overlap option', 'evive' ),
		'phone'          => __( 'Keep the overlap on phones', 'evive' ),
		'phoneHelp'      => __( 'Off: on screens below 782px the card stacks under the image.', 'evive' ),
		'cardText'       => __( 'Card content: an image, SVG, text or any blocks.', 'evive' ),
		'placeholder'    => $images . 'placeholder.svg',
	];
	wp_add_inline_script( generate_block_asset_handle( 'evive/media-overlap', 'editorScript' ), 'window.eviveMediaOverlap = ' . wp_json_encode( $strings ) . ';', 'before' );
} );

// evive #546: "Slides" (Group block style): one slide (a direct child of the group, e.g. a Cover) at a time,
// full width, in a scroll-snap row with previous/next buttons, dots and keyboard (assets/js/carousel.js,
// shared with the Carousel style). "Slides, autoplay" also moves on by itself every 6 seconds: never with
// reduced motion, it stops on hover and keyboard focus, and it has a pause button (WCAG 2.2.2). Without
// JavaScript both are a plain scrollable row, like the Carousel style (#413). In the editor the slides stand
// below each other, so each one can be edited.
add_action( 'init', function () {
	register_block_style( 'core/group', [ 'name' => 'slides', 'label' => _x( 'Slides', 'block style', 'evive' ) ] );
	register_block_style( 'core/group', [ 'name' => 'slides-autoplay', 'label' => _x( 'Slides, autoplay', 'block style', 'evive' ) ] );
} );

add_filter( 'render_block_core/group', function ( $html, $block ) {
	$classes = $block['attrs']['className'] ?? '';
	if ( is_admin() || ! preg_match( '/\bis-style-slides(-autoplay)?\b/', $classes, $style ) || empty( $block['innerBlocks'] ) ) {
		return $html;
	}
	$tags = new WP_HTML_Tag_Processor( $html );
	if ( ! $tags->next_tag() ) {
		return $html;
	}
	$id = $tags->get_attribute( 'id' );
	if ( ! $id ) {
		$id = wp_unique_id( 'evive-slides-' );
		$tags->set_attribute( 'id', $id );
	}
	$count = count( $block['innerBlocks'] );
	$tags->set_attribute( 'role', 'region' );
	$tags->set_attribute( 'aria-roledescription', _x( 'Slides', 'slides region', 'evive' ) );
	if ( ! $tags->get_attribute( 'aria-label' ) ) {
		$tags->set_attribute( 'aria-label', _x( 'Slides', 'slides region', 'evive' ) );
	}
	$tags->set_attribute( 'tabindex', '0' );
	/* translators: 1: number of the slide, 2: number of slides */
	$tags->set_attribute( 'data-evive-slide-label', _x( 'Slide %1$s of %2$s', 'slides', 'evive' ) );
	$tags->set_attribute( 'data-evive-slide-role', _x( 'Slide', 'slides roledescription', 'evive' ) );
	$autoplay = ! empty( $style[1] );
	$arrow    = '<svg aria-hidden="true" focusable="false" width="20" height="20" viewBox="0 0 24 24"><path d="%s" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
	$nav      = '<div class="evive-slides-nav" hidden>'
		. '<button type="button" class="evive-slides-prev" aria-controls="' . esc_attr( $id ) . '" aria-label="' . esc_attr_x( 'Previous slide', 'slides', 'evive' ) . '">' . sprintf( $arrow, 'M15 18l-6-6 6-6' ) . '</button>'
		. '<div class="evive-slides-dots">';
	for ( $i = 1; $i <= $count; $i++ ) {
		/* translators: %s: number of the slide */
		$nav .= '<button type="button" class="evive-slides-dot" aria-controls="' . esc_attr( $id ) . '" aria-label="' . esc_attr( sprintf( _x( 'Slide %s', 'slides dot', 'evive' ), $i ) ) . '"' . ( 1 === $i ? ' aria-current="true"' : '' ) . '></button>';
	}
	$nav .= '</div>'
		. '<button type="button" class="evive-slides-next" aria-controls="' . esc_attr( $id ) . '" aria-label="' . esc_attr_x( 'Next slide', 'slides', 'evive' ) . '">' . sprintf( $arrow, 'M9 6l6 6-6 6' ) . '</button>';
	if ( $autoplay ) {
		// The script shows this button only when autoplay really runs (not with reduced motion).
		$nav .= '<button type="button" class="evive-slides-pause" aria-controls="' . esc_attr( $id ) . '" hidden'
			. ' data-label-pause="' . esc_attr_x( 'Pause slides', 'slides', 'evive' ) . '" data-label-play="' . esc_attr_x( 'Play slides', 'slides', 'evive' ) . '"'
			. ' aria-label="' . esc_attr_x( 'Pause slides', 'slides', 'evive' ) . '">'
			. '<svg class="evive-icon-pause" aria-hidden="true" focusable="false" width="20" height="20" viewBox="0 0 24 24"><path d="M9 6v12M15 6v12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>'
			. '<svg class="evive-icon-play" aria-hidden="true" focusable="false" width="20" height="20" viewBox="0 0 24 24"><path d="M8 5.5v13l10.5-6.5z" fill="currentColor"/></svg>'
			. '</button>';
	}
	$nav .= '</div>';
	wp_enqueue_script( 'evive-carousel' );
	return $tags->get_updated_html() . $nav;
}, 10, 2 );

// evive #546: "Muted loop" (Video block style), for a video in place of a hero image. The video is muted,
// loops and has no sound or controls of its own; the poster shows first. The browser loads nothing of the
// video before the page has loaded (preload="none", no autoplay attribute): assets/js/video.js then starts it,
// except on phones (below 782px, to save data) and with reduced motion, where the visitor starts it with the
// play button. A pause button is always there (WCAG 2.2.2). Without JavaScript the browser's own controls show.
add_action( 'init', function () {
	register_block_style( 'core/video', [ 'name' => 'loop', 'label' => _x( 'Muted loop', 'block style', 'evive' ) ] );
	wp_register_script( 'evive-video', get_template_directory_uri() . '/assets/js/video.js', [], EVIVE_BASE_VERSION, [ 'in_footer' => true, 'strategy' => 'defer' ] );
} );

add_filter( 'render_block_core/video', function ( $html, $block ) {
	if ( is_admin() || ! str_contains( $block['attrs']['className'] ?? '', 'is-style-loop' ) ) {
		return $html;
	}
	$tags = new WP_HTML_Tag_Processor( $html );
	if ( ! $tags->next_tag( 'video' ) ) {
		return $html;
	}
	$tags->remove_attribute( 'autoplay' );
	$tags->set_attribute( 'muted', true );
	$tags->set_attribute( 'loop', true );
	$tags->set_attribute( 'playsinline', true );
	$tags->set_attribute( 'controls', true ); // removed by the script; the fallback without JavaScript
	$tags->set_attribute( 'preload', 'none' );
	$tags->set_attribute( 'data-evive-loop', '' );
	$html = $tags->get_updated_html();
	$end  = strrpos( $html, '</figure>' );
	if ( false === $end ) {
		return $html;
	}
	$button = '<button type="button" class="evive-video-toggle" hidden'
		. ' data-label-pause="' . esc_attr_x( 'Pause video', 'video', 'evive' ) . '" data-label-play="' . esc_attr_x( 'Play video', 'video', 'evive' ) . '"'
		. ' aria-label="' . esc_attr_x( 'Play video', 'video', 'evive' ) . '">'
		. '<svg class="evive-icon-pause" aria-hidden="true" focusable="false" width="20" height="20" viewBox="0 0 24 24"><path d="M9 6v12M15 6v12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>'
		. '<svg class="evive-icon-play" aria-hidden="true" focusable="false" width="20" height="20" viewBox="0 0 24 24"><path d="M8 5.5v13l10.5-6.5z" fill="currentColor"/></svg>'
		. '</button>';
	wp_enqueue_script( 'evive-video' );
	return substr( $html, 0, $end ) . $button . substr( $html, $end );
}, 10, 2 );

// evive #546: privacy embed for YouTube and Vimeo. Instead of the player, the page shows the video's
// thumbnail (fetched once by the server and stored in uploads/evive-embeds/, so the visitor's browser makes no
// request to YouTube or Vimeo), the title and a play button. Only a click loads the player, from
// youtube-nocookie.com or with Vimeo's dnt=1 (assets/js/embed.js). Without JavaScript the play button is a link
// to the video on YouTube/Vimeo. On for every YouTube/Vimeo embed; off for one embed with the extra CSS class
// "evive-embed-direct", or for the whole site with add_filter( 'evive_privacy_embed', '__return_false' ).
add_action( 'init', function () {
	wp_register_script( 'evive-embed', get_template_directory_uri() . '/assets/js/embed.js', [], EVIVE_BASE_VERSION, [ 'in_footer' => true, 'strategy' => 'defer' ] );
} );

/**
 * evive #546: the player URL (privacy mode, autoplay after the click) and the public page of a YouTube or Vimeo
 * video, from the embed's iframe src or its URL. Null for anything else.
 */
function evive_privacy_embed_target( string $provider, string $src, string $url ): ?array {
	$query = [];
	parse_str( (string) wp_parse_url( $src, PHP_URL_QUERY ), $query );
	if ( 'youtube' === $provider ) {
		$id = '';
		foreach ( [ $src, $url ] as $candidate ) {
			if ( preg_match( '~(?:youtube(?:-nocookie)?\.com/(?:embed/|shorts/|live/|watch\?(?:.*&)?v=)|youtu\.be/)([A-Za-z0-9_-]{11})~', $candidate, $m ) ) {
				$id = $m[1];
				break;
			}
		}
		if ( ! $id ) {
			return null;
		}
		$args = [ 'autoplay' => 1, 'rel' => 0 ];
		if ( isset( $query['start'] ) ) {
			$args['start'] = (int) $query['start'];
		}
		return [
			'id'     => $id,
			'player' => add_query_arg( $args, 'https://www.youtube-nocookie.com/embed/' . $id ),
			'page'   => 'https://www.youtube.com/watch?v=' . $id,
			'thumb'  => 'https://i.ytimg.com/vi/' . $id . '/hqdefault.jpg',
		];
	}
	if ( 'vimeo' === $provider && preg_match( '~player\.vimeo\.com/video/(\d+)~', $src, $m ) ) {
		$args = [ 'dnt' => 1, 'autoplay' => 1 ];
		if ( ! empty( $query['h'] ) && preg_match( '/^[a-f0-9]+$/', $query['h'] ) ) {
			$args['h'] = $query['h'];
		}
		return [
			'id'     => $m[1],
			'player' => add_query_arg( $args, 'https://player.vimeo.com/video/' . $m[1] ),
			'page'   => $url ? $url : 'https://vimeo.com/' . $m[1],
			'thumb'  => '',
		];
	}
	return null;
}

/**
 * evive #546: a local copy of the video's thumbnail (uploads/evive-embeds/), fetched once by the server.
 * Remembered for 30 days; a failed fetch is retried after a day. Empty string when there is none.
 */
function evive_privacy_embed_thumb( string $provider, array $target ): string {
	$key    = 'evive_embed_' . md5( $provider . ':' . $target['id'] );
	$cached = get_transient( $key );
	$upload = wp_upload_dir( null, false );
	if ( is_array( $cached ) ) {
		return ( $cached['file'] && file_exists( trailingslashit( $upload['basedir'] ) . $cached['file'] ) ) ? set_url_scheme( trailingslashit( $upload['baseurl'] ) . $cached['file'] ) : '';
	}
	$thumb = $target['thumb'];
	if ( ! $thumb && 'vimeo' === $provider ) {
		$resp = wp_safe_remote_get( add_query_arg( [ 'url' => rawurlencode( $target['page'] ), 'width' => 1280 ], 'https://vimeo.com/api/oembed.json' ), [ 'timeout' => 4 ] );
		$data = json_decode( (string) wp_remote_retrieve_body( $resp ), true );
		$thumb = is_array( $data ) ? (string) ( $data['thumbnail_url'] ?? '' ) : '';
	}
	$file = '';
	if ( $thumb && preg_match( '~^https://(i\.ytimg\.com|i\.vimeocdn\.com)/~', $thumb ) && ! $upload['error'] ) {
		$resp = wp_safe_remote_get( $thumb, [ 'timeout' => 4, 'limit_response_size' => 2 * MB_IN_BYTES ] );
		$type = (string) wp_remote_retrieve_header( $resp, 'content-type' );
		$ext  = [ 'image/jpeg' => 'jpg', 'image/webp' => 'webp', 'image/png' => 'png' ][ strtok( $type, ';' ) ] ?? '';
		$body = (string) wp_remote_retrieve_body( $resp );
		if ( 200 === wp_remote_retrieve_response_code( $resp ) && $ext && strlen( $body ) > 100 && wp_mkdir_p( trailingslashit( $upload['basedir'] ) . 'evive-embeds' ) ) {
			$name = 'evive-embeds/' . $provider . '-' . $target['id'] . '.' . $ext;
			if ( false !== file_put_contents( trailingslashit( $upload['basedir'] ) . $name, $body ) ) {
				$file = $name;
			}
		}
	}
	set_transient( $key, [ 'file' => $file ], $file ? 30 * DAY_IN_SECONDS : DAY_IN_SECONDS );
	return $file ? set_url_scheme( trailingslashit( $upload['baseurl'] ) . $file ) : '';
}

add_filter( 'render_block_core/embed', function ( $html, $block ) {
	$provider = $block['attrs']['providerNameSlug'] ?? '';
	if ( is_admin() || is_feed() || ! in_array( $provider, [ 'youtube', 'vimeo' ], true ) || str_contains( $block['attrs']['className'] ?? '', 'evive-embed-direct' )
		|| ! apply_filters( 'evive_privacy_embed', true, $block ) ) {
		return $html;
	}
	// The_content's autoembed has already turned the URL into the provider's iframe; without one, leave it.
	if ( ! preg_match( '~<iframe\b[^>]*>.*?</iframe>~is', $html, $iframe ) ) {
		return $html;
	}
	$frame = new WP_HTML_Tag_Processor( $iframe[0] );
	$frame->next_tag( 'iframe' );
	$target = evive_privacy_embed_target( $provider, html_entity_decode( (string) $frame->get_attribute( 'src' ) ), (string) ( $block['attrs']['url'] ?? '' ) );
	if ( ! $target ) {
		return $html;
	}
	$title = trim( (string) $frame->get_attribute( 'title' ) );
	$name  = 'youtube' === $provider ? 'YouTube' : 'Vimeo';
	$thumb = evive_privacy_embed_thumb( $provider, $target );
	/* translators: %s: title of the video */
	$label = $title ? sprintf( _x( 'Play video: %s', 'privacy embed', 'evive' ), $title ) : _x( 'Play video', 'privacy embed', 'evive' );
	$note  = 'youtube' === $provider
		? _x( 'Plays from YouTube in privacy-enhanced mode. Nothing is loaded from YouTube before you click play.', 'privacy embed', 'evive' )
		: _x( 'Plays from Vimeo without tracking (dnt). Nothing is loaded from Vimeo before you click play.', 'privacy embed', 'evive' );
	$facade = '<div class="evive-embed" data-evive-embed="' . esc_url( $target['player'] ) . '" data-evive-embed-title="' . esc_attr( $title ? $title : $name ) . '">'
		. ( $thumb ? '<img class="evive-embed-thumb" src="' . esc_url( $thumb ) . '" alt="" loading="lazy" decoding="async">' : '' )
		. '<a class="evive-embed-play" href="' . esc_url( $target['page'] ) . '" aria-label="' . esc_attr( $label ) . '">'
		. '<svg aria-hidden="true" focusable="false" width="28" height="28" viewBox="0 0 24 24"><path d="M8 5.5v13l10.5-6.5z" fill="currentColor"/></svg></a>'
		. '<div class="evive-embed-info">' . ( $title ? '<p class="evive-embed-title">' . esc_html( $title ) . '</p>' : '' )
		. '<p class="evive-embed-note">' . esc_html( $note ) . '</p></div>'
		. '</div>';
	wp_enqueue_script( 'evive-embed' );
	$html = str_replace( $iframe[0], $facade, $html );
	$tags = new WP_HTML_Tag_Processor( $html );
	if ( $tags->next_tag( 'figure' ) ) {
		$tags->add_class( 'evive-embed-privacy' );
		$html = $tags->get_updated_html();
	}
	return $html;
}, 10, 2 );
