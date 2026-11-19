<?php
/**
 * Title: Testimonial: large photo
 * Slug: evive/testimonial-photo
 * Categories: evive-proof
 * Keywords: testimonial, quote, review, customer, photo, portrait
 * Viewport Width: 1280
 * Description: A large photo of the person next to a big quote, with name, role and company logo. On phones the photo sits above the quote.
 *
 * @package evive
 */

// evive #410: quote with a large photo of the person.
$evive_img = get_template_directory_uri() . "/assets/images/";
?>
<!-- wp:group {"align":"full","className":"evive-testimonial-photo","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull evive-testimonial-photo has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%"><!-- wp:image {"aspectRatio":"4/5","scale":"cover","sizeSlug":"large","className":"evive-media evive-testimonial-photo-image","style":{"border":{"radius":"var:custom|radius|l"}}} -->
<figure class="wp-block-image size-large has-custom-border evive-media evive-testimonial-photo-image"><img src="<?php echo esc_url( $evive_img . 'placeholder-portrait.svg' ); ?>" alt="<?php echo esc_attr_x( 'Portrait of the customer', 'placeholder', 'evive' ); ?>" style="border-radius:var(--wp--custom--radius--l);aspect-ratio:4/5;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%"><!-- wp:quote {"className":"evive-testimonial-photo-quote"} -->
<blockquote class="wp-block-quote evive-testimonial-photo-quote"><!-- wp:paragraph {"fontSize":"xl"} -->
<p class="has-xl-font-size"><?php echo esc_html_x( 'A short, specific quote about the result a customer got. Real words from a real person.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></blockquote>
<!-- /wp:quote -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40","margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"fontSize":"m","style":{"typography":{"fontWeight":"600"}}} -->
<p class="has-m-font-size" style="font-weight:600"><?php echo esc_html_x( 'Name Surname', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"s"} -->
<p class="has-muted-color has-text-color has-s-font-size"><?php echo esc_html_x( 'Role, Company', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"width":"140px","sizeSlug":"full"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( $evive_img . 'placeholder-logo.svg' ); ?>" alt="<?php echo esc_attr_x( 'Customer logo', 'placeholder', 'evive' ); ?>" style="width:140px;height:auto"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
