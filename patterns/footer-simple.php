<?php
/**
 * Title: Footer, simple
 * Slug: evive/footer-simple
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: One row: logo, legal line and social links.
 *
 * @package evive
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"backgroundColor":"surface","className":"evive-footer","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull evive-footer has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide"><!-- wp:pattern {"slug":"evive/header-brand"} /-->

<!-- wp:pattern {"slug":"evive/footer-legal"} /-->

<!-- wp:social-links {"size":"has-normal-icon-size","className":"is-style-logos-only"} -->
<ul class="wp-block-social-links has-normal-icon-size is-style-logos-only"><!-- wp:social-link {"url":"","service":"linkedin"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
