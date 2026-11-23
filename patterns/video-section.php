<?php
/**
 * Title: Video section
 * Slug: evive/video-section
 * Categories: evive-content
 * Keywords: video, film, movie, intro, explainer, youtube, vimeo
 * Viewport Width: 1280
 * Description: Heading and intro text with a video below it, rounded like the images. Replace the placeholder with your own video (MP4) and poster image; the video loads only when the visitor presses play. For a YouTube or Vimeo video, replace the Video block with an Embed block: the theme shows its thumbnail and loads the player only on click.
 *
 * @package evive
 */

// evive #546.
$evive_img = get_template_directory_uri() . "/assets/images/";
$evive_vid = get_template_directory_uri() . "/assets/video/";
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php echo esc_html_x( 'See how it works in two minutes', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"l"} -->
<p class="has-text-align-center has-l-font-size"><?php echo esc_html_x( 'One sentence on what the video shows and why it is worth watching.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:video {"className":"evive-video","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<figure class="wp-block-video evive-video" style="margin-top:var(--wp--preset--spacing--50)"><video controls poster="<?php echo esc_url( $evive_img . 'placeholder.svg' ); ?>" preload="none" src="<?php echo esc_url( $evive_vid . 'placeholder-loop.webm' ); ?>" playsinline></video></figure>
<!-- /wp:video --></div>
<!-- /wp:group -->
