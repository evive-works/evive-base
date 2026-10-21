<?php
/**
 * Title: Page not found
 * Slug: evive/not-found
 * Inserter: no
 * Description: Content of the 404 template.
 *
 * @package evive
 */
?>
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Page not found', 'evive' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"l"} -->
<p class="has-l-font-size"><?php esc_html_e( 'The page you were looking for doesn’t exist or has moved. Try a search, or go to the home page.', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:search {"label":"<?php echo esc_attr_x( 'Search', 'search form label', 'evive' ); ?>","buttonText":"<?php echo esc_attr_x( 'Search', 'search button', 'evive' ); ?>"} /-->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go to the home page', 'evive' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
