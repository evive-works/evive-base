<?php
/**
 * evive #411: one panel of evive/tabs. The label is a heading that is only visible without JavaScript
 * (view.js shows the tab list instead and links each panel to its tab).
 *
 * @package evive
 * @var array  $attributes
 * @var string $content
 */

defined( 'ABSPATH' ) || exit;

$evive_label = trim( wp_strip_all_tags( $attributes['label'] ?? '' ) );
?>
<div <?php echo get_block_wrapper_attributes( [ 'class' => 'evive-tabs__panel' ] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
	<?php if ( '' !== $evive_label ) : ?>
		<h3 class="evive-tabs__label"><?php echo esc_html( $evive_label ); ?></h3>
	<?php endif; ?>
	<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput ?>
</div>
