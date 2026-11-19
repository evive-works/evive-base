<?php
/**
 * Title: Integrations grid
 * Slug: evive/integrations
 * Categories: evive-features
 * Keywords: integrations, apps, connections, tools, logos, grid
 * Viewport Width: 1280
 * Description: Section heading, a row of static category labels and a grid of integration tiles (logo, name, one line). The labels are plain text, not a working filter: change them, mark another one with the class is-active, or delete the list. On phones the tiles turn into compact rows.
 *
 * @package evive
 */

// evive #409: integrations grid. Tiles are Card groups on the core grid layout (four columns, two on
// tablets, one on phones; see .evive-integrations in base.css).
$evive_img = get_template_directory_uri() . "/assets/images/";
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php echo esc_html_x( 'Works with the tools you already use', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"muted"} -->
<p class="has-text-align-center has-muted-color has-text-color"><?php echo esc_html_x( 'One sentence on how the integrations work and how quickly they are set up.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"evive-integrations-filter","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"fontSize":"s"} -->
<ul style="margin-top:var(--wp--preset--spacing--40)" class="wp-block-list evive-integrations-filter has-s-font-size"><!-- wp:list-item {"className":"is-active"} -->
<li class="is-active"><?php echo esc_html_x( 'All', 'integration category', 'evive' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html_x( 'First category', 'placeholder', 'evive' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html_x( 'Second category', 'placeholder', 'evive' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html_x( 'Third category', 'placeholder', 'evive' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:group {"align":"wide","className":"evive-integrations","style":{"spacing":{"blockGap":"var:preset|spacing|40","margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"grid","columnCount":4,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide evive-integrations" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:group {"className":"is-style-card evive-integration","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card evive-integration"><!-- wp:image {"width":"48px","sizeSlug":"full","className":"evive-icon evive-integration-logo"} -->
<figure class="wp-block-image size-full is-resized evive-icon evive-integration-logo"><img src="<?php echo esc_url( $evive_img . 'placeholder-icon.svg' ); ?>" alt="" style="width:48px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"fontSize":"m"} -->
<h3 class="wp-block-heading has-m-font-size"><?php echo esc_html_x( 'Integration name', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"s"} -->
<p class="has-muted-color has-text-color has-s-font-size"><?php echo esc_html_x( 'One line on what this integration does.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-card evive-integration","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card evive-integration"><!-- wp:image {"width":"48px","sizeSlug":"full","className":"evive-icon evive-integration-logo"} -->
<figure class="wp-block-image size-full is-resized evive-icon evive-integration-logo"><img src="<?php echo esc_url( $evive_img . 'placeholder-icon.svg' ); ?>" alt="" style="width:48px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"fontSize":"m"} -->
<h3 class="wp-block-heading has-m-font-size"><?php echo esc_html_x( 'Integration name', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"s"} -->
<p class="has-muted-color has-text-color has-s-font-size"><?php echo esc_html_x( 'One line on what this integration does.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-card evive-integration","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card evive-integration"><!-- wp:image {"width":"48px","sizeSlug":"full","className":"evive-icon evive-integration-logo"} -->
<figure class="wp-block-image size-full is-resized evive-icon evive-integration-logo"><img src="<?php echo esc_url( $evive_img . 'placeholder-icon.svg' ); ?>" alt="" style="width:48px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"fontSize":"m"} -->
<h3 class="wp-block-heading has-m-font-size"><?php echo esc_html_x( 'Integration name', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"s"} -->
<p class="has-muted-color has-text-color has-s-font-size"><?php echo esc_html_x( 'One line on what this integration does.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-card evive-integration","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card evive-integration"><!-- wp:image {"width":"48px","sizeSlug":"full","className":"evive-icon evive-integration-logo"} -->
<figure class="wp-block-image size-full is-resized evive-icon evive-integration-logo"><img src="<?php echo esc_url( $evive_img . 'placeholder-icon.svg' ); ?>" alt="" style="width:48px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"fontSize":"m"} -->
<h3 class="wp-block-heading has-m-font-size"><?php echo esc_html_x( 'Integration name', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"s"} -->
<p class="has-muted-color has-text-color has-s-font-size"><?php echo esc_html_x( 'One line on what this integration does.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-card evive-integration","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card evive-integration"><!-- wp:image {"width":"48px","sizeSlug":"full","className":"evive-icon evive-integration-logo"} -->
<figure class="wp-block-image size-full is-resized evive-icon evive-integration-logo"><img src="<?php echo esc_url( $evive_img . 'placeholder-icon.svg' ); ?>" alt="" style="width:48px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"fontSize":"m"} -->
<h3 class="wp-block-heading has-m-font-size"><?php echo esc_html_x( 'Integration name', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"s"} -->
<p class="has-muted-color has-text-color has-s-font-size"><?php echo esc_html_x( 'One line on what this integration does.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-card evive-integration","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card evive-integration"><!-- wp:image {"width":"48px","sizeSlug":"full","className":"evive-icon evive-integration-logo"} -->
<figure class="wp-block-image size-full is-resized evive-icon evive-integration-logo"><img src="<?php echo esc_url( $evive_img . 'placeholder-icon.svg' ); ?>" alt="" style="width:48px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"fontSize":"m"} -->
<h3 class="wp-block-heading has-m-font-size"><?php echo esc_html_x( 'Integration name', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"s"} -->
<p class="has-muted-color has-text-color has-s-font-size"><?php echo esc_html_x( 'One line on what this integration does.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-card evive-integration","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card evive-integration"><!-- wp:image {"width":"48px","sizeSlug":"full","className":"evive-icon evive-integration-logo"} -->
<figure class="wp-block-image size-full is-resized evive-icon evive-integration-logo"><img src="<?php echo esc_url( $evive_img . 'placeholder-icon.svg' ); ?>" alt="" style="width:48px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"fontSize":"m"} -->
<h3 class="wp-block-heading has-m-font-size"><?php echo esc_html_x( 'Integration name', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"s"} -->
<p class="has-muted-color has-text-color has-s-font-size"><?php echo esc_html_x( 'One line on what this integration does.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-card evive-integration","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card evive-integration"><!-- wp:image {"width":"48px","sizeSlug":"full","className":"evive-icon evive-integration-logo"} -->
<figure class="wp-block-image size-full is-resized evive-icon evive-integration-logo"><img src="<?php echo esc_url( $evive_img . 'placeholder-icon.svg' ); ?>" alt="" style="width:48px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"fontSize":"m"} -->
<h3 class="wp-block-heading has-m-font-size"><?php echo esc_html_x( 'Integration name', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"s"} -->
<p class="has-muted-color has-text-color has-s-font-size"><?php echo esc_html_x( 'One line on what this integration does.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
