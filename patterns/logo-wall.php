<?php
/**
 * Title: Logo wall
 * Slug: evive/logo-wall
 * Categories: evive-proof
 * Keywords: logos, customers, clients, trust
 * Viewport Width: 1280
 * Description: A short line and a row of customer logos.
 *
 * @package evive
 */

$evive_img = get_template_directory_uri() . "/assets/images/";
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:paragraph {"align":"center","textColor":"muted","fontSize":"s","style":{"typography":{"fontWeight":"600"}}} -->
<p class="has-text-align-center has-muted-color has-text-color has-s-font-size" style="font-weight:600"><?php echo esc_html_x( 'Trusted by teams at', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"align":"wide","className":"evive-logo-wall","style":{"spacing":{"blockGap":"var:preset|spacing|50","margin":{"top":"var:preset|spacing|40"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
<div class="wp-block-group alignwide evive-logo-wall" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:image {"width":"160px","sizeSlug":"full"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( $evive_img . 'placeholder-logo.svg' ); ?>" alt="<?php echo esc_html_x( 'Customer logo', 'placeholder', 'evive' ); ?>" style="width:160px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"160px","sizeSlug":"full"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( $evive_img . 'placeholder-logo.svg' ); ?>" alt="<?php echo esc_html_x( 'Customer logo', 'placeholder', 'evive' ); ?>" style="width:160px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"160px","sizeSlug":"full"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( $evive_img . 'placeholder-logo.svg' ); ?>" alt="<?php echo esc_html_x( 'Customer logo', 'placeholder', 'evive' ); ?>" style="width:160px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"160px","sizeSlug":"full"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( $evive_img . 'placeholder-logo.svg' ); ?>" alt="<?php echo esc_html_x( 'Customer logo', 'placeholder', 'evive' ); ?>" style="width:160px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"160px","sizeSlug":"full"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( $evive_img . 'placeholder-logo.svg' ); ?>" alt="<?php echo esc_html_x( 'Customer logo', 'placeholder', 'evive' ); ?>" style="width:160px;height:auto"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
