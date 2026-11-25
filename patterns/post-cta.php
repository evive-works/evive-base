<?php
/**
 * Title: Post call to action
 * Slug: evive/post-cta
 * Inserter: no
 * Description: Call-to-action card after every blog post (template part "Post call to action"): heading, one line and two buttons, by default to the contact page and the posts page. Edit it once in the Site Editor (Patterns → Template parts) and it changes on every post.
 *
 * @package evive
 */

// evive #580: the main button goes to the page with slug "contact" (or /contact/ when there is none yet),
// the second one to the posts page (or the home page when the latest posts are on the front page).
$evive_contact      = get_page_by_path( 'contact' );
$evive_contact_url  = $evive_contact ? get_permalink( $evive_contact ) : home_url( '/contact/' );
$evive_posts_page   = (int) get_option( 'page_for_posts' );
$evive_posts_url    = $evive_posts_page ? get_permalink( $evive_posts_page ) : home_url( '/' );
?>
<!-- wp:group {"className":"evive-post-cta","style":{"border":{"radius":"var:custom|radius|l"},"spacing":{"margin":{"top":"var:preset|spacing|60"},"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|30"},"elements":{"heading":{"color":{"text":"var:preset|color|primary-contrast"}}}},"backgroundColor":"primary","textColor":"primary-contrast","layout":{"type":"constrained"}} -->
<div class="wp-block-group evive-post-cta has-primary-contrast-color has-primary-background-color has-text-color has-background" style="border-radius:var(--wp--custom--radius--l);margin-top:var(--wp--preset--spacing--60);padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"fontSize":"xl"} -->
<h2 class="wp-block-heading has-xl-font-size"><?php echo esc_html_x( 'Want to talk about this?', 'post cta', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html_x( 'Get in touch: we are happy to think along with you, no strings attached.', 'post cta', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"accent","textColor":"accent-contrast"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-accent-contrast-color has-accent-background-color has-text-color has-background wp-element-button" href="<?php echo esc_url( $evive_contact_url ); ?>"><?php echo esc_html_x( 'Contact us', 'post cta', 'evive' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"textColor":"primary-contrast","className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-primary-contrast-color has-text-color wp-element-button" href="<?php echo esc_url( $evive_posts_url ); ?>"><?php echo esc_html_x( 'More articles', 'post cta', 'evive' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
