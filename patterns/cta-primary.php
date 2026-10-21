<?php
/**
 * Title: CTA band: primary colour
 * Slug: evive/cta-primary
 * Categories: evive-cta
 * Keywords: cta, call to action, banner
 * Viewport Width: 1280
 * Description: Call-to-action band on the primary colour with one button.
 *
 * @package evive
 */

$evive_img = get_template_directory_uri() . "/assets/images/";
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"align":"wide","style":{"border":{"radius":"var:custom|radius|l"},"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"elements":{"heading":{"color":{"text":"var:preset|color|primary-contrast"}}}},"backgroundColor":"primary","textColor":"primary-contrast","layout":{"type":"constrained","contentSize":"40rem"}} -->
<div class="wp-block-group alignwide has-primary-contrast-color has-primary-background-color has-text-color has-background" style="border-radius:var(--wp--custom--radius--l);padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php echo esc_html_x( 'Ready to get started?', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"l"} -->
<p class="has-text-align-center has-l-font-size"><?php echo esc_html_x( 'One sentence that removes the last doubt.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"accent","textColor":"accent-contrast"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-accent-contrast-color has-accent-background-color has-text-color has-background wp-element-button" href="#"><?php echo esc_html_x( 'Primary action', 'placeholder', 'evive' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
