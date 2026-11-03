<?php
/**
 * Title: Case cards
 * Slug: evive/case-cards
 * Categories: evive-proof
 * Keywords: cases, case studies, customers, stories, results, references
 * Viewport Width: 1280
 * Description: Three customer cards side by side: logo, the result in one number, a short quote and a link to the full case. Link each card to its case post (category "Cases"). Stacks on phones.
 *
 * @package evive
 */

$evive_img = get_template_directory_uri() . "/assets/images/";

// One card: number, what the number means, quote, customer name.
$evive_case = function ( $number, $label, $quote, $customer ) use ( $evive_img ) {
	?>
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-card evive-case-card","style":{"dimensions":{"minHeight":"100%"},"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group is-style-card evive-case-card" style="min-height:100%"><!-- wp:image {"width":"120px","sizeSlug":"full"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( $evive_img . 'placeholder-logo.svg' ); ?>" alt="<?php echo esc_attr( $customer ); ?>" style="width:120px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"textColor":"primary","fontSize":"xxl","style":{"typography":{"fontWeight":"700","lineHeight":"1.1"},"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"fontFamily":"heading"} -->
<p class="has-primary-color has-text-color has-heading-font-family has-xxl-font-size" style="margin-top:var(--wp--preset--spacing--30);font-weight:700;line-height:1.1"><?php echo esc_html( $number ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}}} -->
<p style="font-weight:600"><?php echo esc_html( $label ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color">“<?php echo esc_html( $quote ); ?>”</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"evive-case-link","style":{"typography":{"fontWeight":"600"}}} -->
<p class="evive-case-link" style="font-weight:600"><a href="#"><?php echo esc_html_x( 'Read the case', 'placeholder', 'evive' ); ?> →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->
	<?php
};
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php echo esc_html_x( 'What our customers achieved', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"muted"} -->
<p class="has-text-align-center has-muted-color has-text-color"><?php echo esc_html_x( 'Real organisations, real results. Read how they did it.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40","top":"var:preset|spacing|40"},"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50)"><?php
$evive_case( '-40%', _x( 'less time spent on scheduling', 'placeholder', 'evive' ), _x( 'One short sentence from the customer about what changed for them.', 'placeholder', 'evive' ), _x( 'Customer one', 'placeholder', 'evive' ) );
$evive_case( '3×', _x( 'more people reached', 'placeholder', 'evive' ), _x( 'One short sentence from the customer about what changed for them.', 'placeholder', 'evive' ), _x( 'Customer two', 'placeholder', 'evive' ) );
$evive_case( '2 wk', _x( 'from start to live', 'placeholder', 'evive' ), _x( 'One short sentence from the customer about what changed for them.', 'placeholder', 'evive' ), _x( 'Customer three', 'placeholder', 'evive' ) );
?></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
