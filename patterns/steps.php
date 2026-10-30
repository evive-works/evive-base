<?php
/**
 * Title: Steps: how it works
 * Slug: evive/steps
 * Categories: evive-features
 * Keywords: steps, how it works, process, onboarding, getting started, numbered
 * Viewport Width: 1280
 * Description: "How it works" in three numbered steps: a centred heading, then per step a number in a circle, a short heading and one sentence. On wide screens a dashed line joins the steps. For four steps, duplicate a column and change its number; the columns stack on phones.
 *
 * @package evive
 */

// One step: number, heading, sentence.
$evive_step = function ( $number, $title, $text ) {
	?>
<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"evive-step-number"} -->
<p class="evive-step-number"><?php echo esc_html( $number ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html( $text ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->
	<?php
};
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php echo esc_html_x( 'How it works', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"muted"} -->
<p class="has-text-align-center has-muted-color has-text-color"><?php echo esc_html_x( 'From first click to daily use in three simple steps.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide","className":"evive-steps","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50","top":"var:preset|spacing|50"},"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide evive-steps" style="margin-top:var(--wp--preset--spacing--50)"><?php
$evive_step( '1', _x( 'Sign up', 'placeholder', 'evive' ), _x( 'Create your account in a minute, no credit card needed.', 'placeholder', 'evive' ) );
$evive_step( '2', _x( 'Set it up', 'placeholder', 'evive' ), _x( 'Add your team and locations, or let us do it for you.', 'placeholder', 'evive' ) );
$evive_step( '3', _x( 'Get going', 'placeholder', 'evive' ), _x( 'Everyone starts using it from the tools they already know.', 'placeholder', 'evive' ) );
?></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
