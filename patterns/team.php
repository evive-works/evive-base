<?php
/**
 * Title: Team
 * Slug: evive/team
 * Categories: evive-content
 * Keywords: team, people, staff, about us, employees, linkedin
 * Viewport Width: 1280
 * Description: A grid of people with a square photo with rounded corners, name, role and a LinkedIn link. Four per row on wide screens (change the column count in the grid settings), two on phones. Set each LinkedIn link's URL, or remove the icon for someone without one.
 *
 * @package evive
 */

// evive #406: team grid. The people are identical placeholders, so they come from one loop.
$evive_img = get_template_directory_uri() . "/assets/images/";
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php echo esc_html_x( 'The people behind it', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"muted"} -->
<p class="has-text-align-center has-muted-color has-text-color"><?php echo esc_html_x( 'One sentence about the team and how they work together.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"align":"wide","className":"evive-team","style":{"spacing":{"blockGap":"var:preset|spacing|50","margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"grid","columnCount":4,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide evive-team" style="margin-top:var(--wp--preset--spacing--50)"><?php for ( $evive_i = 0; $evive_i < 8; $evive_i++ ) : ?><!-- wp:group {"className":"evive-team-member","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group evive-team-member"><!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"full","style":{"border":{"radius":"var:custom|radius|l"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="<?php echo esc_url( $evive_img . 'placeholder-avatar.svg' ); ?>" alt="" style="border-radius:var(--wp--custom--radius--l);aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"fontSize":"m"} -->
<h3 class="wp-block-heading has-m-font-size"><?php echo esc_html_x( 'Name Surname', 'placeholder', 'evive' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"s"} -->
<p class="has-muted-color has-text-color has-s-font-size"><?php echo esc_html_x( 'Job title', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:social-links {"size":"has-normal-icon-size","className":"is-style-logos-only"} -->
<ul class="wp-block-social-links has-normal-icon-size is-style-logos-only"><!-- wp:social-link {"url":"#","service":"linkedin"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group -->

<?php endfor; ?>
</div>
<!-- /wp:group --></div>
<!-- /wp:group -->
