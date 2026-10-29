<?php
/**
 * Title: Pricing: three plans
 * Slug: evive/pricing-plans
 * Categories: evive-pricing
 * Keywords: pricing, plans, prices, tiers, subscription
 * Viewport Width: 1280
 * Description: Three plan cards of equal height with the middle plan highlighted: name, short description, large price with its period, a line for the yearly price, a checklist and a button aligned at the bottom.
 *
 * @package evive
 */

// One plan card. $featured marks the recommended plan: a badge, a stronger border and a solid button.
$evive_plan = function ( $name, $desc, $price, $period, $note, $features, $button, $featured = false ) {
	$card_class = 'is-style-card evive-plan' . ( $featured ? ' is-featured' : '' );
	?>
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"<?php echo esc_attr( $card_class ); ?>","style":{"dimensions":{"minHeight":"100%"}},"layout":{"type":"default"}} -->
<div class="wp-block-group <?php echo esc_attr( $card_class ); ?>" style="min-height:100%"><?php if ( $featured ) : ?><!-- wp:paragraph {"className":"evive-plan-badge"} -->
<p class="evive-plan-badge"><?php echo esc_html_x( 'Most popular', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<?php endif; ?><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html( $name ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"s"} -->
<p class="has-muted-color has-text-color has-s-font-size"><?php echo esc_html( $desc ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"evive-price"} -->
<p class="evive-price"><strong><?php echo esc_html( $price ); ?></strong> <?php echo esc_html( $period ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"xs"} -->
<p class="has-muted-color has-text-color has-xs-font-size"><?php echo esc_html( $note ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"evive-checklist"} -->
<ul class="wp-block-list evive-checklist"><?php foreach ( $features as $feature ) : ?><!-- wp:list-item -->
<li><?php echo esc_html( $feature ); ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list -->

<!-- wp:buttons {"className":"evive-plan-actions"} -->
<div class="wp-block-buttons evive-plan-actions"><!-- wp:button <?php echo $featured ? '' : '{"className":"is-style-outline"} '; ?>-->
<div class="wp-block-button<?php echo $featured ? '' : ' is-style-outline'; ?>"><a class="wp-block-button__link wp-element-button" href="#"><?php echo esc_html( $button ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->
	<?php
};
?>
<!-- wp:group {"align":"full","className":"evive-pricing","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull evive-pricing has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php echo esc_html_x( 'Simple pricing that grows with you', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"muted"} -->
<p class="has-text-align-center has-muted-color has-text-color"><?php echo esc_html_x( 'One sentence on how the plans differ and what every plan includes.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40","top":"var:preset|spacing|40"},"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50)"><?php
$evive_plan(
	_x( 'Starter', 'placeholder', 'evive' ),
	_x( 'For small teams getting started.', 'placeholder', 'evive' ),
	_x( '€ 2', 'placeholder', 'evive' ),
	_x( 'per user / month', 'placeholder', 'evive' ),
	_x( 'Or € 1.75 per month, billed yearly.', 'placeholder', 'evive' ),
	[ _x( 'First feature', 'placeholder', 'evive' ), _x( 'Second feature', 'placeholder', 'evive' ), _x( 'Third feature', 'placeholder', 'evive' ) ],
	_x( 'Start free trial', 'placeholder', 'evive' )
);
$evive_plan(
	_x( 'Professional', 'placeholder', 'evive' ),
	_x( 'For growing teams that want more control.', 'placeholder', 'evive' ),
	_x( '€ 3', 'placeholder', 'evive' ),
	_x( 'per user / month', 'placeholder', 'evive' ),
	_x( 'Or € 2.50 per month, billed yearly.', 'placeholder', 'evive' ),
	[ _x( 'Everything in Starter', 'placeholder', 'evive' ), _x( 'Second feature', 'placeholder', 'evive' ), _x( 'Third feature', 'placeholder', 'evive' ), _x( 'Fourth feature', 'placeholder', 'evive' ) ],
	_x( 'Start free trial', 'placeholder', 'evive' ),
	true
);
$evive_plan(
	_x( 'Enterprise', 'placeholder', 'evive' ),
	_x( 'For large organisations with several locations.', 'placeholder', 'evive' ),
	_x( 'Custom', 'placeholder', 'evive' ),
	'',
	_x( 'A quote that fits your organisation.', 'placeholder', 'evive' ),
	[ _x( 'Everything in Professional', 'placeholder', 'evive' ), _x( 'Second feature', 'placeholder', 'evive' ), _x( 'Third feature', 'placeholder', 'evive' ) ],
	_x( 'Book a demo', 'placeholder', 'evive' )
);
?></div>
<!-- /wp:columns -->

<!-- wp:paragraph {"align":"center","textColor":"muted","fontSize":"xs","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<p class="has-text-align-center has-muted-color has-text-color has-xs-font-size" style="margin-top:var(--wp--preset--spacing--40)"><?php echo esc_html_x( 'All prices exclude VAT.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
