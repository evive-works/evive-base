<?php
/**
 * Title: Posts heading
 * Slug: evive/posts-heading
 * Inserter: no
 * Description: H1 for the posts index: the title of the posts page, or a neutral fallback.
 *
 * @package evive
 */

$evive_posts_page = (int) get_option( 'page_for_posts' );
$evive_heading    = $evive_posts_page ? get_the_title( $evive_posts_page ) : __( 'Latest posts', 'evive' );
?>
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php echo esc_html( $evive_heading ); ?></h1>
<!-- /wp:heading -->
