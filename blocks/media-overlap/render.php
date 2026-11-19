<?php
/**
 * evive #516: media with an overlapping card. The saved content is one core/image and one
 * evive/media-overlap-card; this adds the wrapper with the card settings as CSS variables (tokens only).
 * The same classes and variables are built in index.js for the editor, so both show the same layout.
 *
 * @package evive
 * @var array  $attributes Block attributes.
 * @var string $content    Rendered inner blocks (image + card).
 */

defined( 'ABSPATH' ) || exit;

$evive_mo_spacing = static function ( $slug, $fallback ) {
	$slug = (string) $slug;
	if ( '0' === $slug ) {
		return '0px';
	}
	return preg_match( '/^[1-7]0$/', $slug ) ? 'var(--wp--preset--spacing--' . $slug . ')' : 'var(--wp--preset--spacing--' . $fallback . ')';
};
$evive_mo_corner  = in_array( $attributes['corner'] ?? '', [ 'bottom-left', 'bottom-right', 'top-left', 'top-right' ], true ) ? $attributes['corner'] : 'bottom-left';
$evive_mo_bg      = (string) ( $attributes['cardBackground'] ?? 'base' );
$evive_mo_bg      = preg_match( '/^[a-z0-9-]+$/', $evive_mo_bg ) ? $evive_mo_bg : 'base';
// Text on the card: the paired contrast colour of the token contract.
$evive_mo_fg      = [ 'primary' => 'primary-contrast', 'accent' => 'accent-contrast', 'contrast' => 'base' ][ $evive_mo_bg ] ?? 'contrast';
$evive_mo_radius  = $attributes['cardRadius'] ?? 'l';
$evive_mo_shadow  = $attributes['cardShadow'] ?? 'm';
$evive_mo_vars    = [
	'--evive-mo-ox'     => $evive_mo_spacing( $attributes['offsetX'] ?? '50', '50' ),
	'--evive-mo-oy'     => $evive_mo_spacing( $attributes['offsetY'] ?? '60', '60' ),
	'--evive-mo-w'      => (string) (int) max( 20, min( 100, (float) ( $attributes['cardWidth'] ?? 60 ) ) ),
	'--evive-mo-bg'     => 'none' === $evive_mo_bg ? 'transparent' : 'var(--wp--preset--color--' . $evive_mo_bg . ')',
	'--evive-mo-fg'     => 'none' === $evive_mo_bg ? 'inherit' : 'var(--wp--preset--color--' . $evive_mo_fg . ')',
	'--evive-mo-radius' => in_array( $evive_mo_radius, [ 's', 'm', 'l' ], true ) ? 'var(--wp--custom--radius--' . $evive_mo_radius . ')' : '0px',
	'--evive-mo-pad'    => $evive_mo_spacing( $attributes['cardPadding'] ?? '30', '30' ),
	'--evive-mo-shadow' => in_array( $evive_mo_shadow, [ 's', 'm', 'l' ], true ) ? 'var(--wp--preset--shadow--' . $evive_mo_shadow . ')' : 'none',
];
$evive_mo_style   = '';
foreach ( $evive_mo_vars as $evive_mo_k => $evive_mo_v ) {
	$evive_mo_style .= $evive_mo_k . ':' . $evive_mo_v . ';';
}
$evive_mo_attrs = get_block_wrapper_attributes( [
	'class' => 'evive-mo is-card-' . $evive_mo_corner . ( empty( $attributes['overlapOnPhone'] ) ? '' : ' is-overlap-on-phone' ),
	'style' => $evive_mo_style,
] );
?>
<div <?php echo $evive_mo_attrs; // phpcs:ignore WordPress.Security.EscapeOutput -- core escapes it. ?>>
	<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput -- rendered blocks. ?>
</div>
