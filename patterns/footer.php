<?php
/**
 * Title: Footer, extended
 * Slug: evive/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: Logo and tagline, three link columns, legal line and social links.
 *
 * @package evive
 */

$evive_columns = [
	_x( 'Product', 'footer column heading', 'evive' ) => [ _x( 'Features', 'footer link', 'evive' ), _x( 'Pricing', 'footer link', 'evive' ), _x( 'Customers', 'footer link', 'evive' ) ],
	_x( 'Company', 'footer column heading', 'evive' ) => [ _x( 'About us', 'footer link', 'evive' ), _x( 'Contact', 'footer link', 'evive' ), _x( 'Blog', 'footer link', 'evive' ) ],
	_x( 'Support', 'footer column heading', 'evive' ) => [ _x( 'Help center', 'footer link', 'evive' ), _x( 'Privacy', 'footer link', 'evive' ), _x( 'Terms', 'footer link', 'evive' ) ],
];
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|50"}},"backgroundColor":"surface","className":"evive-footer","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull evive-footer has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50","top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"40%"} -->
<div class="wp-block-column" style="flex-basis:40%"><!-- wp:pattern {"slug":"evive/header-brand"} /-->

<!-- wp:site-tagline {"textColor":"muted","fontSize":"s"} /--></div>
<!-- /wp:column -->
<?php foreach ( $evive_columns as $evive_heading => $evive_links ) : ?>

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"fontSize":"s"} -->
<h2 class="wp-block-heading has-s-font-size"><?php echo esc_html( $evive_heading ); ?></h2>
<!-- /wp:heading -->

<!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"fontSize":"s"} -->
<?php foreach ( $evive_links as $evive_link ) : ?>
<!-- wp:navigation-link {"label":"<?php echo esc_attr( $evive_link ); ?>","url":"#"} /-->
<?php endforeach; ?>
<!-- /wp:navigation --></div>
<!-- /wp:column -->
<?php endforeach; ?>
</div>
<!-- /wp:columns -->

<!-- wp:separator {"align":"wide","className":"is-style-wide"} -->
<hr class="wp-block-separator alignwide has-alpha-channel-opacity is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide"><!-- wp:pattern {"slug":"evive/footer-legal"} /-->

<!-- wp:social-links {"size":"has-normal-icon-size","className":"is-style-logos-only"} -->
<ul class="wp-block-social-links has-normal-icon-size is-style-logos-only"><!-- wp:social-link {"url":"","service":"linkedin"} /-->

<!-- wp:social-link {"url":"","service":"youtube"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
