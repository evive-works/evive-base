<?php
/**
 * Title: Features: three cards
 * Slug: evive/features-cards
 * Categories: evive-features
 * Keywords: features, cards, grid, benefits
 * Viewport Width: 1280
 * Description: Section heading and three feature cards with an icon, text and a link.
 *
 * @package evive
 */

$evive_img = get_template_directory_uri() . "/assets/images/";
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php echo esc_html_x( 'Everything you need, nothing you don’t', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"muted"} -->
<p class="has-text-align-center has-muted-color has-text-color"><?php echo esc_html_x( 'A one-line summary of the features below.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40","top":"var:preset|spacing|40"},"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-card","style":{"dimensions":{"minHeight":"100%"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card" style="min-height:100%"><!-- wp:image {"width":"48px","sizeSlug":"full","className":"evive-icon"} -->
<figure class="wp-block-image size-full is-resized evive-icon"><img src="<?php echo esc_url( $evive_img . 'placeholder-icon.svg' ); ?>" alt="" style="width:48px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html_x( 'First feature', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'A short description of this feature and the benefit it brings.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"s","style":{"typography":{"fontWeight":"600"}}} -->
<p class="has-s-font-size" style="font-weight:600"><a href="#"><?php echo esc_html_x( 'Learn more →', 'placeholder', 'evive' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-card","style":{"dimensions":{"minHeight":"100%"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card" style="min-height:100%"><!-- wp:image {"width":"48px","sizeSlug":"full","className":"evive-icon"} -->
<figure class="wp-block-image size-full is-resized evive-icon"><img src="<?php echo esc_url( $evive_img . 'placeholder-icon.svg' ); ?>" alt="" style="width:48px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html_x( 'Second feature', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'A short description of this feature and the benefit it brings.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"s","style":{"typography":{"fontWeight":"600"}}} -->
<p class="has-s-font-size" style="font-weight:600"><a href="#"><?php echo esc_html_x( 'Learn more →', 'placeholder', 'evive' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-card","style":{"dimensions":{"minHeight":"100%"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card" style="min-height:100%"><!-- wp:image {"width":"48px","sizeSlug":"full","className":"evive-icon"} -->
<figure class="wp-block-image size-full is-resized evive-icon"><img src="<?php echo esc_url( $evive_img . 'placeholder-icon.svg' ); ?>" alt="" style="width:48px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html_x( 'Third feature', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'A short description of this feature and the benefit it brings.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"s","style":{"typography":{"fontWeight":"600"}}} -->
<p class="has-s-font-size" style="font-weight:600"><a href="#"><?php echo esc_html_x( 'Learn more →', 'placeholder', 'evive' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
