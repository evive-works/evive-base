<?php
/**
 * Title: Device duo: laptop with phone in front
 * Slug: evive/device-duo
 * Categories: evive-features
 * Keywords: screenshot, laptop, phone, device, mockup, app, portal, duo
 * Viewport Width: 1280
 * Description: A laptop with a desktop screenshot and a floating phone with an app screenshot in front of it, overlapping its bottom-right corner. Swap in two plain screenshots: both devices are drawn by the image block styles "Laptop" and "Phone, floating" (never use an image with a device baked in). The desktop screenshot fills the screen from the top. One group, so it works on its own, in a column next to text or in the image column of a hero or CTA band.
 *
 * @package evive
 */

// evive #484.
$evive_img = get_template_directory_uri() . '/assets/images/';
?>
<!-- wp:group {"className":"evive-device-duo","layout":{"type":"default"}} -->
<div class="wp-block-group evive-device-duo"><!-- wp:image {"sizeSlug":"full","className":"is-style-laptop"} -->
<figure class="wp-block-image size-full is-style-laptop"><img src="<?php echo esc_url( $evive_img . 'placeholder.svg' ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","className":"is-style-phone-float"} -->
<figure class="wp-block-image size-full is-style-phone-float"><img src="<?php echo esc_url( $evive_img . 'placeholder-phone.svg' ); ?>" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->
