<?php
/**
 * Title: Header, sticky
 * Slug: evive/header-sticky
 * Categories: header
 * Block Types: core/template-part/header
 * Description: Like the default header, but it stays at the top of the screen while scrolling.
 *
 * @package evive
 */
?>
<!-- wp:group {"align":"full","style":{"position":{"type":"sticky","top":"0px"},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"border":{"bottom":{"color":"var:preset|color|border","width":"1px","style":"solid"}}},"backgroundColor":"base","className":"evive-header","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull evive-header has-base-background-color has-background" style="border-bottom-color:var(--wp--preset--color--border);border-bottom-style:solid;border-bottom-width:1px;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide"><!-- wp:pattern {"slug":"evive/header-brand"} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right"}} -->
<div class="wp-block-group"><!-- wp:navigation {"overlayMenu":"mobile","overlayBackgroundColor":"base","overlayTextColor":"contrast","layout":{"type":"flex","justifyContent":"right"}} /-->

<!-- wp:pattern {"slug":"evive/header-language"} /-->

<!-- wp:pattern {"slug":"evive/header-cta"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
