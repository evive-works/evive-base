<?php
/**
 * Title: No results
 * Slug: evive/no-results
 * Inserter: no
 * Description: Message shown when a query has no posts.
 *
 * @package evive
 */
?>
<!-- wp:paragraph -->
<p><?php esc_html_e( 'Nothing found. Try another search.', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:search {"label":"<?php echo esc_attr_x( 'Search', 'search form label', 'evive' ); ?>","buttonText":"<?php echo esc_attr_x( 'Search', 'search button', 'evive' ); ?>"} /-->
