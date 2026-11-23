<?php
/**
 * Title: Hero: text and video
 * Slug: evive/hero-video
 * Categories: evive-hero
 * Keywords: hero, intro, video, background, loop
 * Viewport Width: 1280
 * Description: Page heading, intro text and two buttons, with a short muted video that loops on the side (Video block style "Muted loop"). The poster shows first; the video starts after the page has loaded, on phones and with reduced motion only after a tap on play. A pause button is always there. Use a short MP4 without sound and set a poster image.
 *
 * @package evive
 */

// evive #546.
$evive_img = get_template_directory_uri() . "/assets/images/";
$evive_vid = get_template_directory_uri() . "/assets/video/";
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php echo esc_html_x( 'A clear headline that says what you do', 'placeholder', 'evive' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"l"} -->
<p class="has-l-font-size"><?php echo esc_html_x( 'One or two sentences on who it is for and why it matters. Keep it concrete.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php echo esc_html_x( 'Primary action', 'placeholder', 'evive' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#"><?php echo esc_html_x( 'Secondary action', 'placeholder', 'evive' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%"><!-- wp:video {"className":"is-style-loop"} -->
<figure class="wp-block-video is-style-loop"><video autoplay loop muted poster="<?php echo esc_url( $evive_img . 'placeholder.svg' ); ?>" preload="none" src="<?php echo esc_url( $evive_vid . 'placeholder-loop.webm' ); ?>" playsinline></video></figure>
<!-- /wp:video --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
