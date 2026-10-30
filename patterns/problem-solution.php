<?php
/**
 * Title: Problem → solution
 * Slug: evive/problem-solution
 * Categories: evive-features
 * Keywords: problem, solution, before, after, without, with, pain, gain, comparison
 * Viewport Width: 1280
 * Description: Two cards side by side: on the left the situation without you (a cross list of pains, on the surface colour), on the right the situation with you (a checklist, highlighted with a primary border). Keep the points short and paired: each pain on the left has its answer on the right, in the same order. Stacks on phones.
 *
 * @package evive
 */

// One side: card classes, label, heading, list class, points.
$evive_side = function ( $card, $attrs, $label, $title, $list, $points ) {
	?>
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {<?php echo $attrs; // phpcs:ignore WordPress.Security.EscapeOutput -- fixed JSON below ?>"style":{"dimensions":{"minHeight":"100%"},"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
<div class="wp-block-group <?php echo esc_attr( $card ); ?>" style="min-height:100%"><!-- wp:paragraph {"textColor":"muted","fontSize":"xs","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"700"}}} -->
<p class="has-muted-color has-text-color has-xs-font-size" style="font-weight:700;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html( $label ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:heading -->

<!-- wp:list {"className":"<?php echo esc_attr( $list ); ?>"} -->
<ul class="wp-block-list <?php echo esc_attr( $list ); ?>"><?php foreach ( $points as $point ) : ?><!-- wp:list-item -->
<li><?php echo esc_html( $point ); ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->
	<?php
};
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php echo esc_html_x( 'There is a better way', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"muted"} -->
<p class="has-text-align-center has-muted-color has-text-color"><?php echo esc_html_x( 'One sentence that names the problem your visitor recognises.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40","top":"var:preset|spacing|40"},"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50)"><?php
$evive_side(
	'is-style-card has-surface-background-color has-background',
	'"className":"is-style-card","backgroundColor":"surface",',
	_x( 'Without us', 'placeholder', 'evive' ),
	_x( 'Today', 'placeholder', 'evive' ),
	'evive-crosslist',
	[ _x( 'First pain point', 'placeholder', 'evive' ), _x( 'Second pain point', 'placeholder', 'evive' ), _x( 'Third pain point', 'placeholder', 'evive' ) ]
);
$evive_side(
	'is-style-card evive-solution',
	'"className":"is-style-card evive-solution",',
	_x( 'With us', 'placeholder', 'evive' ),
	_x( 'Tomorrow', 'placeholder', 'evive' ),
	'evive-checklist',
	[ _x( 'First answer', 'placeholder', 'evive' ), _x( 'Second answer', 'placeholder', 'evive' ), _x( 'Third answer', 'placeholder', 'evive' ) ]
);
?></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
