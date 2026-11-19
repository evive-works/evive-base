<?php
/**
 * evive #516: the card of evive/media-overlap. Saves only its inner blocks; its look (colour, radius, padding,
 * shadow, width and place) comes from the parent's CSS variables, see blocks/media-overlap/style.css.
 *
 * @package evive
 * @var array  $attributes
 * @var string $content
 */

defined( 'ABSPATH' ) || exit;
?>
<div <?php echo get_block_wrapper_attributes( [ 'class' => 'evive-mo__card' ] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
	<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput ?>
</div>
