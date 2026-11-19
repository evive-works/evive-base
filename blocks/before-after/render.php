<?php
/**
 * evive #412: before/after block. The saved content is two core/image blocks; this wraps each one with its
 * label. Without JavaScript both images stand side by side (stacked on phones); view.js turns them into one
 * picture with a divider and a range input.
 *
 * @package evive
 * @var array  $attributes Block attributes.
 * @var string $content    Rendered inner blocks (the two images).
 */

defined( 'ABSPATH' ) || exit;

$evive_ba_images = preg_split( '/(?=<figure\b)/', trim( $content ), -1, PREG_SPLIT_NO_EMPTY );
if ( 2 !== count( $evive_ba_images ) ) {
	// One image missing (or something unexpected): show what there is, without the slider.
	echo $content; // phpcs:ignore WordPress.Security.EscapeOutput -- rendered blocks.
	return;
}

$evive_ba_labels = [
	trim( $attributes['labelBefore'] ?? '' ) ?: _x( 'Before', 'before/after label', 'evive' ),
	trim( $attributes['labelAfter'] ?? '' ) ?: _x( 'After', 'before/after label', 'evive' ),
];
$evive_ba_pos    = (int) round( max( 0, min( 100, (float) ( $attributes['position'] ?? 50 ) ) ) );
$evive_ba_attrs  = get_block_wrapper_attributes( [
	'class'               => 'evive-ba',
	'style'               => '--evive-ba-pos:' . $evive_ba_pos . '%',
	'data-evive-ba-pos'   => (string) $evive_ba_pos,
	'data-evive-ba-label' => _x( 'Divider between before and after', 'before/after slider', 'evive' ),
] );
?>
<div <?php echo $evive_ba_attrs; // phpcs:ignore WordPress.Security.EscapeOutput -- core escapes it. ?>>
	<?php foreach ( [ 'before', 'after' ] as $evive_ba_i => $evive_ba_side ) : ?>
	<div class="evive-ba__item evive-ba__<?php echo esc_attr( $evive_ba_side ); ?>">
		<?php echo trim( $evive_ba_images[ $evive_ba_i ] ); // phpcs:ignore WordPress.Security.EscapeOutput -- rendered core/image. ?>
		<span class="evive-ba__label"><?php echo esc_html( $evive_ba_labels[ $evive_ba_i ] ); ?></span>
	</div>
	<?php endforeach; ?>
</div>
