<?php
/**
 * Title: Hero: page title and intro
 * Slug: evive/hero-page
 * Categories: evive-hero
 * Keywords: hero, page, title
 * Viewport Width: 1280
 * Description: Simple page hero: heading and an intro paragraph, for inner pages.
 *
 * @package evive
 */

$evive_img = get_template_directory_uri() . "/assets/images/";
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"46rem"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php echo esc_html_x( 'Page title', 'placeholder', 'evive' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"l"} -->
<p class="has-muted-color has-text-color has-l-font-size"><?php echo esc_html_x( 'A short introduction to what this page covers, in one or two sentences.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
