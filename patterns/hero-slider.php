<?php
/**
 * Title: Hero: slider
 * Slug: evive/hero-slider
 * Categories: evive-hero
 * Keywords: hero, slider, slides, carousel, slideshow
 * Viewport Width: 1280
 * Description: Three full-width slides (Cover blocks with an image and a dark overlay) in a Group with the block style "Slides": one slide at a time, with previous/next, dots, the arrow keys and swipe. Switch the group to "Slides, autoplay" to move on every 6 seconds (stops on hover and focus, never with reduced motion, with a pause button). Only the first slide has the page's H1. Add or remove slides in the group; in the editor they stand below each other.
 *
 * @package evive
 */

// evive #546.
$evive_img = get_template_directory_uri() . "/assets/images/";
?>
<!-- wp:group {"align":"full","className":"is-style-slides","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull is-style-slides"><!-- wp:cover {"url":"<?php echo esc_url( $evive_img . 'placeholder.svg' ); ?>","dimRatio":80,"overlayColor":"contrast","isUserOverlayColor":true,"isDark":true,"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"textColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-dark has-base-color has-text-color" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--50)"><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( $evive_img . 'placeholder.svg' ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php echo esc_html_x( 'A clear headline that says what you do', 'placeholder', 'evive' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"l"} -->
<p class="has-l-font-size"><?php echo esc_html_x( 'One or two sentences on who it is for and why it matters. Keep it concrete.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php echo esc_html_x( 'Primary action', 'placeholder', 'evive' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"textColor":"base","className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-base-color has-text-color wp-element-button" href="#"><?php echo esc_html_x( 'Secondary action', 'placeholder', 'evive' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"url":"<?php echo esc_url( $evive_img . 'placeholder.svg' ); ?>","dimRatio":80,"overlayColor":"contrast","isUserOverlayColor":true,"isDark":true,"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"textColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-dark has-base-color has-text-color" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--50)"><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( $evive_img . 'placeholder.svg' ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html_x( 'A second message worth its own slide', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"l"} -->
<p class="has-l-font-size"><?php echo esc_html_x( 'One sentence that backs it up: a feature, a result or a customer.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php echo esc_html_x( 'Learn more', 'placeholder', 'evive' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"url":"<?php echo esc_url( $evive_img . 'placeholder.svg' ); ?>","dimRatio":80,"overlayColor":"contrast","isUserOverlayColor":true,"isDark":true,"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"textColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-dark has-base-color has-text-color" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--50)"><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( $evive_img . 'placeholder.svg' ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html_x( 'A third message, then stop', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"l"} -->
<p class="has-l-font-size"><?php echo esc_html_x( 'Three slides is plenty: most visitors only see the first one.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php echo esc_html_x( 'Get in touch', 'placeholder', 'evive' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->
