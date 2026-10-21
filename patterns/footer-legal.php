<?php
/**
 * Title: Footer legal line
 * Slug: evive/footer-legal
 * Inserter: no
 * Description: Copyright line with the current year and the site title; editable in the Site Editor.
 *
 * @package evive
 */
?>
<!-- wp:paragraph {"textColor":"muted","fontSize":"xs"} -->
<p class="has-muted-color has-text-color has-xs-font-size"><?php
	/* translators: 1: year, 2: site title */
	echo esc_html( sprintf( __( '© %1$s %2$s. All rights reserved.', 'evive' ), wp_date( 'Y' ), get_bloginfo( 'name' ) ) );
?></p>
<!-- /wp:paragraph -->
