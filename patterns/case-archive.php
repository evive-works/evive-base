<?php
/**
 * Title: Case archive grid
 * Slug: evive/case-archive
 * Inserter: no
 * Description: The cards on the "Cases" category page: featured image, title, excerpt and a link, three per row.
 *
 * @package evive
 */
?>
<!-- wp:query {"queryId":1,"query":{"inherit":true,"perPage":12},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"18rem"}} -->
<!-- wp:group {"className":"is-style-card evive-case-card","style":{"dimensions":{"minHeight":"100%"},"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group is-style-card evive-case-card" style="min-height:100%"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","style":{"border":{"radius":"var:custom|radius|m"}}} /-->

<!-- wp:post-title {"level":2,"isLink":true,"fontSize":"l"} /-->

<!-- wp:post-excerpt {"excerptLength":24,"textColor":"muted"} /-->

<!-- wp:read-more {"content":"<?php echo esc_attr( _x( 'Read the case', 'link', 'evive' ) ); ?> →","className":"evive-case-link","style":{"typography":{"fontWeight":"600"}}} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"space-between"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:pattern {"slug":"evive/no-results"} /-->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->
