<?php
/**
 * Title: Pricing: add-on or single offer
 * Slug: evive/pricing-addon
 * Categories: evive-pricing
 * Keywords: pricing, add-on, addon, extra, offer, option
 * Viewport Width: 1280
 * Description: One wide card for an add-on or a separate offer next to the plans. Left: name, a short explanation and a checklist. Right: a centred price box with the same price style as the plans (the price in bold, the period text after it on its own line below), a note and one button. Stacks on phones.
 *
 * @package evive
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"align":"wide","className":"is-style-card evive-addon","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide is-style-card evive-addon"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60","top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"60%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:60%"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html_x( 'Add-on name', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'Who this is for and what it adds, in one or two sentences.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"evive-checklist"} -->
<ul class="wp-block-list evive-checklist"><!-- wp:list-item -->
<li><?php echo esc_html_x( 'First feature', 'placeholder', 'evive' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html_x( 'Second feature', 'placeholder', 'evive' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html_x( 'Third feature', 'placeholder', 'evive' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:group {"className":"evive-addon-price","backgroundColor":"surface","layout":{"type":"default"}} -->
<div class="wp-block-group evive-addon-price has-surface-background-color has-background"><!-- wp:paragraph {"align":"center","className":"evive-price"} -->
<p class="has-text-align-center evive-price"><strong><?php echo esc_html_x( 'From € 1', 'placeholder', 'evive' ); ?></strong><?php echo esc_html_x( 'per item / month', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","textColor":"muted","fontSize":"xs"} -->
<p class="has-text-align-center has-muted-color has-text-color has-xs-font-size"><?php echo esc_html_x( 'A short note on what the price depends on.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"evive-plan-actions"} -->
<div class="wp-block-buttons evive-plan-actions"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php echo esc_html_x( 'Get in touch', 'placeholder', 'evive' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
