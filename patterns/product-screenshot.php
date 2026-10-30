<?php
/**
 * Title: Product screenshot in a device frame
 * Slug: evive/product-screenshot
 * Categories: evive-features
 * Keywords: screenshot, product, app, device, browser, phone, laptop, mockup, frame
 * Viewport Width: 1280
 * Description: Text with a checklist and a button on the left, a screenshot in a browser-window frame on the right. Use a plain screenshot: the frame is drawn by the image's block style, so switch the style to "Phone" for an app screen (portrait) or "Laptop" for a desktop screen. Never use an image with a device baked in.
 *
 * @package evive
 */

$evive_img = get_template_directory_uri() . "/assets/images/";
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60","top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"42%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:42%"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html_x( 'Everything in one clear overview', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'One or two sentences on what the screen shows and why it saves time.', 'placeholder', 'evive' ); ?></p>
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
<!-- /wp:list -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php echo esc_html_x( 'Primary action', 'placeholder', 'evive' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"58%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:58%"><!-- wp:image {"sizeSlug":"full","className":"is-style-browser"} -->
<figure class="wp-block-image size-full is-style-browser"><img src="<?php echo esc_url( $evive_img . 'placeholder.svg' ); ?>" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
