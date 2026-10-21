<?php
/**
 * Title: Stats
 * Slug: evive/stats
 * Categories: evive-proof
 * Keywords: stats, numbers, figures, results
 * Viewport Width: 1280
 * Description: Four big numbers with a label each.
 *
 * @package evive
 */

$evive_img = get_template_directory_uri() . "/assets/images/";
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50","top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"textColor":"primary","fontSize":"xxl","style":{"typography":{"fontWeight":"700","lineHeight":"1.1"}},"fontFamily":"heading"} -->
<p class="has-primary-color has-text-color has-heading-font-family has-xxl-font-size" style="font-weight:700;line-height:1.1">12</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'Label for the first number', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"textColor":"primary","fontSize":"xxl","style":{"typography":{"fontWeight":"700","lineHeight":"1.1"}},"fontFamily":"heading"} -->
<p class="has-primary-color has-text-color has-heading-font-family has-xxl-font-size" style="font-weight:700;line-height:1.1">1,200</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'Label for the second number', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"textColor":"primary","fontSize":"xxl","style":{"typography":{"fontWeight":"700","lineHeight":"1.1"}},"fontFamily":"heading"} -->
<p class="has-primary-color has-text-color has-heading-font-family has-xxl-font-size" style="font-weight:700;line-height:1.1">98%</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'Label for the third number', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"textColor":"primary","fontSize":"xxl","style":{"typography":{"fontWeight":"700","lineHeight":"1.1"}},"fontFamily":"heading"} -->
<p class="has-primary-color has-text-color has-heading-font-family has-xxl-font-size" style="font-weight:700;line-height:1.1">24/7</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'Label for the fourth number', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
