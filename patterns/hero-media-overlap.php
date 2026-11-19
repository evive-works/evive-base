<?php
/**
 * Title: Hero: image with overlapping card
 * Slug: evive/hero-media-overlap
 * Categories: evive-hero
 * Keywords: hero, overlap, card, image
 * Viewport Width: 1280
 * Description: Text on the left; on the right an image with a card that overlaps its bottom-left corner (block "Media with overlapping card": position, size and colour of the card in the sidebar). On phones the card stacks under the image.
 *
 * @package evive
 */

// evive #516.
$evive_img = get_template_directory_uri() . '/assets/images/';
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"textColor":"muted","fontSize":"s","style":{"typography":{"fontWeight":"600","textTransform":"uppercase","letterSpacing":"0.08em"}}} -->
<p class="has-muted-color has-text-color has-s-font-size" style="font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html_x( 'Eyebrow', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php echo esc_html_x( 'A headline with a picture that tells the rest', 'placeholder', 'evive' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"l"} -->
<p class="has-l-font-size"><?php echo esc_html_x( 'Supporting text that explains the offer in plain words.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php echo esc_html_x( 'Primary action', 'placeholder', 'evive' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:evive/media-overlap -->
<!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"var:custom|radius|l"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( $evive_img . 'placeholder.svg' ); ?>" alt="" style="border-radius:var(--wp--custom--radius--l)"/></figure>
<!-- /wp:image -->

<!-- wp:evive/media-overlap-card -->
<!-- wp:paragraph {"fontSize":"xl","style":{"typography":{"fontWeight":"700","lineHeight":"1.1"}}} -->
<p class="has-xl-font-size" style="font-weight:700;line-height:1.1"><?php echo esc_html_x( '98%', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"s"} -->
<p class="has-s-font-size"><?php echo esc_html_x( 'One short line that backs up the headline with a fact.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:evive/media-overlap-card -->
<!-- /wp:evive/media-overlap --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
