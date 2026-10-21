<?php
/**
 * Title: Testimonial
 * Slug: evive/testimonial
 * Categories: evive-proof
 * Keywords: testimonial, quote, review, customer
 * Viewport Width: 1280
 * Description: One large customer quote with name, role and photo.
 *
 * @package evive
 */

$evive_img = get_template_directory_uri() . "/assets/images/";
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"46rem"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"is-style-card","style":{"dimensions":{"minHeight":"100%"},"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group is-style-card" style="min-height:100%"><!-- wp:paragraph {"fontSize":"l"} -->
<p class="has-l-font-size">“<?php echo esc_html_x( 'A short, specific quote about the result a customer got. Real words from a real person.', 'placeholder', 'evive' ); ?>”</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"48px","sizeSlug":"full","style":{"border":{"radius":"999px"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url( $evive_img . 'placeholder-avatar.svg' ); ?>" alt="" style="border-radius:999px;width:48px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"fontSize":"s","style":{"typography":{"fontWeight":"600"}}} -->
<p class="has-s-font-size" style="font-weight:600"><?php echo esc_html_x( 'Name Surname', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"s"} -->
<p class="has-muted-color has-text-color has-s-font-size"><?php echo esc_html_x( 'Role, Company', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
