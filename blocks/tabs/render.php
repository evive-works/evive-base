<?php
/**
 * evive #411: front end of evive/tabs. The tab list is built from the labels of the inner evive/tab blocks and
 * stays hidden until view.js has set up the panels; without JavaScript every tab is shown with its label above it.
 *
 * @package evive
 * @var array    $attributes
 * @var string   $content    The rendered evive/tab panels.
 * @var WP_Block $block
 */

defined( 'ABSPATH' ) || exit;

$evive_tabs = '';
$evive_n    = 0;
foreach ( $block->inner_blocks as $evive_tab ) {
	if ( 'evive/tab' !== $evive_tab->name ) {
		continue;
	}
	++$evive_n;
	$evive_label = trim( wp_strip_all_tags( $evive_tab->attributes['label'] ?? '' ) );
	if ( '' === $evive_label ) {
		/* translators: %d: number of the tab */
		$evive_label = sprintf( __( 'Tab %d', 'evive' ), $evive_n );
	}
	$evive_tabs .= '<button type="button" class="evive-tabs__tab" role="tab" aria-selected="false" tabindex="-1">' . esc_html( $evive_label ) . '</button>';
}
if ( ! $evive_n ) {
	return;
}
?>
<div <?php echo get_block_wrapper_attributes( [ 'data-evive-tabs' => '' ] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
	<div class="evive-tabs__list" role="tablist" hidden><?php echo $evive_tabs; // phpcs:ignore WordPress.Security.EscapeOutput -- escaped above ?></div>
	<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput ?>
</div>
