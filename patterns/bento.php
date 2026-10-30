<?php
/**
 * Title: Bento grid
 * Slug: evive/bento
 * Categories: evive-features
 * Keywords: bento, grid, tiles, features, overview, mosaic
 * Viewport Width: 1280
 * Description: Features as a mosaic of tiles of different sizes on a four-column grid: one large tile with an image, a tile on the primary colour, a key figure, an icon tile and two wide tiles. Each tile's size is set in the block settings (column span, row span); keep every row filled to four columns. On phones all tiles stack.
 *
 * @package evive
 */

$evive_img = get_template_directory_uri() . "/assets/images/";
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php echo esc_html_x( 'Everything your team needs', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"muted"} -->
<p class="has-text-align-center has-muted-color has-text-color"><?php echo esc_html_x( 'One sentence that ties the features together.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"align":"wide","className":"evive-bento","style":{"spacing":{"blockGap":"var:preset|spacing|40","margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"grid","columnCount":4,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide evive-bento" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:group {"className":"is-style-card evive-bento-tile","style":{"layout":{"columnSpan":2,"rowSpan":2},"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card evive-bento-tile"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html_x( 'The main feature', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'Two sentences on the feature that matters most, with a screenshot below.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:image {"sizeSlug":"full","className":"evive-bento-media"} -->
<figure class="wp-block-image size-full evive-bento-media"><img src="<?php echo esc_url( $evive_img . 'placeholder.svg' ); ?>" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-card evive-bento-tile","style":{"layout":{"columnSpan":2,"rowSpan":1},"spacing":{"blockGap":"var:preset|spacing|30"},"elements":{"heading":{"color":{"text":"var:preset|color|primary-contrast"}}}},"backgroundColor":"primary","textColor":"primary-contrast","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card evive-bento-tile has-primary-contrast-color has-primary-background-color has-text-color has-background"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html_x( 'A bold promise', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html_x( 'One sentence that backs it up.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-card evive-bento-tile","style":{"layout":{"columnSpan":1,"rowSpan":1},"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card evive-bento-tile"><!-- wp:paragraph {"className":"evive-bento-figure","textColor":"primary"} -->
<p class="evive-bento-figure has-primary-color has-text-color"><?php echo esc_html_x( '98%', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"s"} -->
<p class="has-muted-color has-text-color has-s-font-size"><?php echo esc_html_x( 'of customers would recommend us.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-card evive-bento-tile","style":{"layout":{"columnSpan":1,"rowSpan":1},"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card evive-bento-tile"><!-- wp:image {"width":"40px","sizeSlug":"full","className":"evive-icon"} -->
<figure class="wp-block-image size-full is-resized evive-icon"><img src="<?php echo esc_url( $evive_img . 'placeholder-icon.svg' ); ?>" alt="" style="width:40px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"fontSize":"m"} -->
<h3 class="wp-block-heading has-m-font-size"><?php echo esc_html_x( 'A smaller feature', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"s"} -->
<p class="has-muted-color has-text-color has-s-font-size"><?php echo esc_html_x( 'One sentence about this point.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-card evive-bento-tile","style":{"layout":{"columnSpan":2,"rowSpan":1},"spacing":{"blockGap":"var:preset|spacing|30"}},"backgroundColor":"surface","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card evive-bento-tile has-surface-background-color has-background"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html_x( 'Works with your tools', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'One or two sentences about integrations or where it fits in.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-card evive-bento-tile","style":{"layout":{"columnSpan":2,"rowSpan":1},"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card evive-bento-tile"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html_x( 'Secure by default', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'One or two sentences about privacy, security or support.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
