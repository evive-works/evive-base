<?php
/**
 * Title: Pricing: comparison table
 * Slug: evive/pricing-comparison
 * Categories: evive-pricing
 * Keywords: pricing, compare, comparison, table, features, plans
 * Viewport Width: 1280
 * Description: Feature comparison across plans. Type ✓ in a cell for "included" and leave it empty for "not included" (shown as a dash). A row whose first cell is bold and the rest empty is a group heading. The header row stays visible while scrolling; on phones the table fits the screen (with many plans it scrolls sideways, the feature column fixed).
 *
 * @package evive
 */

// A feature row: label, then one cell per plan (true = included).
$evive_row = function ( $label, $cells ) {
	echo '<tr><td>' . esc_html( $label ) . '</td>';
	foreach ( $cells as $included ) {
		echo '<td>' . ( $included ? '✓' : '' ) . '</td>';
	}
	echo '</tr>';
};
$evive_group = function ( $label ) {
	echo '<tr><td><strong>' . esc_html( $label ) . '</strong></td><td></td><td></td><td></td></tr>';
};
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php echo esc_html_x( 'Compare the plans', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:table {"align":"wide","className":"is-style-comparison","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<figure class="wp-block-table alignwide is-style-comparison" style="margin-top:var(--wp--preset--spacing--50)"><table><thead><tr><th><?php echo esc_html_x( 'Feature', 'placeholder', 'evive' ); ?></th><th><?php echo esc_html_x( 'Starter', 'placeholder', 'evive' ); ?></th><th><?php echo esc_html_x( 'Professional', 'placeholder', 'evive' ); ?></th><th><?php echo esc_html_x( 'Enterprise', 'placeholder', 'evive' ); ?></th></tr></thead><tbody><?php
$evive_group( _x( 'First group of features', 'placeholder', 'evive' ) );
$evive_row( _x( 'First feature', 'placeholder', 'evive' ), [ true, true, true ] );
$evive_row( _x( 'Second feature', 'placeholder', 'evive' ), [ true, true, true ] );
$evive_row( _x( 'Third feature', 'placeholder', 'evive' ), [ false, true, true ] );
$evive_group( _x( 'Second group of features', 'placeholder', 'evive' ) );
$evive_row( _x( 'Fourth feature', 'placeholder', 'evive' ), [ true, true, true ] );
$evive_row( _x( 'Fifth feature', 'placeholder', 'evive' ), [ false, true, true ] );
$evive_row( _x( 'Sixth feature', 'placeholder', 'evive' ), [ false, false, true ] );
?></tbody></table></figure>
<!-- /wp:table --></div>
<!-- /wp:group -->
