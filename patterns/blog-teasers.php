<?php
/**
 * Title: Blog teasers
 * Slug: evive/blog-teasers
 * Categories: evive-content
 * Keywords: blog, posts, articles, news, latest, teasers
 * Viewport Width: 1280
 * Description: The three latest posts as cards (featured image, category, title, excerpt, date) with a link to all articles. Fills itself; with fewer posts it shows fewer cards. Three per row on wide screens, stacked on phones.
 *
 * @package evive
 */

// evive #408: "All articles" goes to the posts page, or to the home page when the latest posts are on the front page.
$evive_posts_page = (int) get_option( 'page_for_posts' );
$evive_posts_url  = $evive_posts_page ? get_permalink( $evive_posts_page ) : home_url( '/' );
?>
<!-- wp:group {"align":"full","className":"evive-blog-teasers","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull evive-blog-teasers" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group alignwide"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html_x( 'Latest articles', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"evive-blog-teasers-all","style":{"typography":{"fontWeight":"600"}}} -->
<p class="evive-blog-teasers-all" style="font-weight:600"><a href="<?php echo esc_url( $evive_posts_url ); ?>"><?php echo esc_html_x( 'All articles', 'link', 'evive' ); ?> →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":8,"query":{"perPage":3,"pages":1,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false,"sticky":"","exclude":[]},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"16rem"}} -->
<!-- wp:group {"className":"is-style-card evive-teaser-card","style":{"dimensions":{"minHeight":"100%"},"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group is-style-card evive-teaser-card" style="min-height:100%"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","style":{"border":{"radius":"var:custom|radius|m"},"spacing":{"margin":{"bottom":"var:preset|spacing|20"}}}} /-->

<!-- wp:post-terms {"term":"category","textColor":"primary","fontSize":"xs","style":{"typography":{"fontWeight":"600"}}} /-->

<!-- wp:post-title {"level":3,"isLink":true,"fontSize":"l"} /-->

<!-- wp:post-excerpt {"excerptLength":20,"textColor":"muted"} /-->

<!-- wp:post-date {"textColor":"muted","fontSize":"xs","className":"evive-teaser-date"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'No articles yet.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->
