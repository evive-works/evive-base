<?php
/**
 * Title: Hero: on primary colour
 * Slug: evive/hero-primary
 * Categories: evive-hero
 * Keywords: hero, primary, brand, motif
 * Viewport Width: 1280
 * Description: Hero on the primary colour. Uses the Motif block style (faded rounded rectangles); switch the style to Default to remove it.
 *
 * @package evive
 */

$evive_img = get_template_directory_uri() . "/assets/images/";
?>
<!-- wp:group {"align":"full","className":"is-style-motif","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}},"elements":{"link":{"color":{"text":"var:preset|color|primary-contrast"}},"heading":{"color":{"text":"var:preset|color|primary-contrast"}}}},"backgroundColor":"primary","textColor":"primary-contrast","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-motif has-primary-contrast-color has-primary-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"align":"wide","layout":{"type":"constrained","contentSize":"44rem","justifyContent":"left"}} -->
<div class="wp-block-group alignwide"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php echo esc_html_x( 'A bold headline on the brand colour', 'placeholder', 'evive' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"l"} -->
<p class="has-l-font-size"><?php echo esc_html_x( 'Intro text in the contrast colour. Keep it short so the page gets going quickly.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"accent","textColor":"accent-contrast"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-accent-contrast-color has-accent-background-color has-text-color has-background wp-element-button" href="#"><?php echo esc_html_x( 'Primary action', 'placeholder', 'evive' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"textColor":"primary-contrast","className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-primary-contrast-color has-text-color wp-element-button" href="#"><?php echo esc_html_x( 'Secondary action', 'placeholder', 'evive' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
