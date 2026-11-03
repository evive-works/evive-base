<?php
/**
 * Title: Case study
 * Slug: evive/case-study
 * Categories: evive-proof
 * Keywords: case, case study, customer story, result, challenge, solution
 * Post Types: post
 * Block Types: core/post-content
 * Viewport Width: 1280
 * Description: The body of one customer case, offered when you start a new post: key figures, the challenge, the solution and the result, a fact box with the customer's logo, a quote and a call to action. Put the post in the category "Cases" and it gets the case layout (title, excerpt as intro, featured image) automatically.
 *
 * @package evive
 */

$evive_img = get_template_directory_uri() . "/assets/images/";

// One key figure: number and what it means.
$evive_figure = function ( $number, $label ) {
	?>
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"textColor":"primary","fontSize":"xxl","style":{"typography":{"fontWeight":"700","lineHeight":"1.1"}},"fontFamily":"heading"} -->
<p class="has-primary-color has-text-color has-heading-font-family has-xxl-font-size" style="font-weight:700;line-height:1.1"><?php echo esc_html( $number ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html( $label ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->
	<?php
};

// One section of the story: heading and text.
$evive_part = function ( $title, $text, $first = false ) {
	if ( $first ) :
		?>
<!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html( $title ); ?></h2>
<!-- /wp:heading -->
		<?php
	else :
		?>
<!-- wp:heading {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<h2 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--50)"><?php echo esc_html( $title ); ?></h2>
<!-- /wp:heading -->
		<?php
	endif;
	?>

<!-- wp:paragraph -->
<p><?php echo esc_html( $text ); ?></p>
<!-- /wp:paragraph -->

	<?php
};

// One fact in the fact box.
$evive_fact = function ( $label, $value ) {
	?>
<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"textColor":"muted","fontSize":"xs","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"700"}}} -->
<p class="has-muted-color has-text-color has-xs-font-size" style="font-weight:700;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html( $label ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $value ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
	<?php
};
?>
<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50","top":"var:preset|spacing|40"},"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}},"border":{"top":{"color":"var:preset|color|border","width":"1px","style":"solid"},"bottom":{"color":"var:preset|color|border","width":"1px","style":"solid"}}}} -->
<div class="wp-block-columns alignwide" style="border-top-color:var(--wp--preset--color--border);border-top-style:solid;border-top-width:1px;border-bottom-color:var(--wp--preset--color--border);border-bottom-style:solid;border-bottom-width:1px;padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)"><?php
$evive_figure( '-40%', _x( 'less time spent on scheduling', 'placeholder', 'evive' ) );
$evive_figure( '1,200', _x( 'employees using it every week', 'placeholder', 'evive' ) );
$evive_figure( '2 wk', _x( 'from start to live', 'placeholder', 'evive' ) );
?></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60","top":"var:preset|spacing|50"},"margin":{"top":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--60)"><!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><?php
$evive_part( _x( 'The challenge', 'placeholder', 'evive' ), _x( 'Describe the situation before: what was not working, what it cost the customer and why they started looking for something else. Concrete beats general.', 'placeholder', 'evive' ), true );
$evive_part( _x( 'The solution', 'placeholder', 'evive' ), _x( 'Describe what you did together: what was set up, how long it took and who was involved. Mention the parts of your product that made the difference.', 'placeholder', 'evive' ) );
$evive_part( _x( 'The result', 'placeholder', 'evive' ), _x( 'Describe what changed, in numbers where you can. The key figures above should come back here with a sentence of context.', 'placeholder', 'evive' ) );
?></div>
<!-- /wp:column -->

<!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:group {"backgroundColor":"surface","className":"is-style-card evive-case-facts","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card evive-case-facts has-surface-background-color has-background"><!-- wp:image {"width":"140px","sizeSlug":"full"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( $evive_img . 'placeholder-logo.svg' ); ?>" alt="<?php echo esc_attr_x( 'Customer logo', 'placeholder', 'evive' ); ?>" style="width:140px;height:auto"/></figure>
<!-- /wp:image -->
<?php
$evive_fact( _x( 'Customer', 'case fact', 'evive' ), _x( 'Company name', 'placeholder', 'evive' ) );
$evive_fact( _x( 'Industry', 'case fact', 'evive' ), _x( 'Healthcare', 'placeholder', 'evive' ) );
$evive_fact( _x( 'Size', 'case fact', 'evive' ), _x( '1,500 employees', 'placeholder', 'evive' ) );
$evive_fact( _x( 'Customer since', 'case fact', 'evive' ), '2024' );
?></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"align":"wide","backgroundColor":"surface","style":{"border":{"radius":"var:custom|radius|l"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","contentSize":"46rem","justifyContent":"left"}} -->
<div class="wp-block-group alignwide has-surface-background-color has-background" style="border-radius:var(--wp--custom--radius--l);margin-top:var(--wp--preset--spacing--60);padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"fontSize":"l"} -->
<p class="has-l-font-size">“<?php echo esc_html_x( 'A short, specific quote about the result a customer got. Real words from a real person.', 'placeholder', 'evive' ); ?>”</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"48px","sizeSlug":"full","style":{"border":{"radius":"999px"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url( $evive_img . 'placeholder-avatar.svg' ); ?>" alt="" style="border-radius:999px;width:48px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"fontSize":"s","style":{"typography":{"fontWeight":"600"}}} -->
<p class="has-s-font-size" style="font-weight:600"><?php echo esc_html_x( 'Name Surname', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"s"} -->
<p class="has-muted-color has-text-color has-s-font-size"><?php echo esc_html_x( 'Role, Company', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"evive/cta-primary"} /-->
