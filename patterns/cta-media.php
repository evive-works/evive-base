<?php
/**
 * Title: CTA band with image
 * Slug: evive/cta-media
 * Categories: evive-cta
 * Keywords: cta, call to action, banner, image, mockup, phone, screenshot, trial
 * Viewport Width: 1280
 * Description: Call-to-action band on the primary colour with text and buttons on the left and an image on the right that sticks out above the band (desktop). Made for a product mockup or screenshot with a transparent background, e.g. a phone. Use real text here, never an image with the text baked in.
 *
 * @package evive
 */

$evive_img = get_template_directory_uri() . "/assets/images/";
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"align":"wide","className":"evive-cta-media","style":{"border":{"radius":"var:custom|radius|l"},"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60","right":"var:preset|spacing|60"}},"elements":{"heading":{"color":{"text":"var:preset|color|primary-contrast"}}}},"backgroundColor":"primary","textColor":"primary-contrast","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide evive-cta-media has-primary-contrast-color has-primary-background-color has-text-color has-background" style="border-radius:var(--wp--custom--radius--l);padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60","top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"58%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:58%"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html_x( 'See it for yourself', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"l"} -->
<p class="has-l-font-size"><?php echo esc_html_x( 'One sentence that removes the last doubt, and what happens when you click.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"accent","textColor":"accent-contrast"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-accent-contrast-color has-accent-background-color has-text-color has-background wp-element-button" href="#"><?php echo esc_html_x( 'Primary action', 'placeholder', 'evive' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"textColor":"primary-contrast","className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-primary-contrast-color has-text-color wp-element-button" href="#"><?php echo esc_html_x( 'Secondary action', 'placeholder', 'evive' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom","width":"42%"} -->
<div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:42%"><!-- wp:image {"sizeSlug":"full","className":"evive-cta-media-image"} -->
<figure class="wp-block-image size-full evive-cta-media-image"><img src="<?php echo esc_url( $evive_img . 'placeholder.svg' ); ?>" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
