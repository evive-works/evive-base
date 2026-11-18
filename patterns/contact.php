<?php
/**
 * Title: Contact: text and form
 * Slug: evive/contact
 * Categories: evive-cta
 * Keywords: contact, demo, request, form, email, phone, address, get in touch
 * Viewport Width: 1280
 * Description: Contact or demo request section: heading, intro and contact details (email, phone, address) on one side, a form (name, email, company, message) in a card on the other. The form is the "Form" block of the evive Forms plugin, which handles spam (hidden trap field, minimum fill time, rate limit), stores entries and emails them; set the recipient in the Form block settings or in Settings → evive Forms. Stacks on phones, text first.
 *
 * @package evive
 */

// evive #407: one contact detail, a small label above a value (a link where it has one).
$evive_details = [
	[ _x( 'Email', 'contact detail label', 'evive' ), '<a href="mailto:name@example.com">name@example.com</a>' ],
	[ _x( 'Phone', 'contact detail label', 'evive' ), '<a href="tel:+31000000000">+31 (0)00 000 00 00</a>' ],
	[ _x( 'Address', 'contact detail label', 'evive' ), esc_html_x( 'Street 1', 'placeholder', 'evive' ) . '<br>' . esc_html_x( '1234 AB City', 'placeholder', 'evive' ) ],
];
?>
<!-- wp:group {"align":"full","className":"evive-contact","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull evive-contact" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60","top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"40%"} -->
<div class="wp-block-column" style="flex-basis:40%"><!-- wp:paragraph {"textColor":"muted","fontSize":"xs","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"700"}}} -->
<p class="has-muted-color has-text-color has-xs-font-size" style="font-weight:700;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html_x( 'Contact', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html_x( 'Let’s talk', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"l"} -->
<p class="has-l-font-size"><?php echo esc_html_x( 'Ask a question or plan a demo. Tell us briefly what you are looking for and we will get back to you.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"evive-contact-details","style":{"spacing":{"blockGap":"var:preset|spacing|40","margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group evive-contact-details" style="margin-top:var(--wp--preset--spacing--50)"><?php foreach ( $evive_details as $evive_detail ) : ?><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"textColor":"muted","fontSize":"xs","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"700"}}} -->
<p class="has-muted-color has-text-color has-xs-font-size" style="font-weight:700;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html( $evive_detail[0] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo $evive_detail[1]; // phpcs:ignore WordPress.Security.EscapeOutput -- fixed markup above ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"s","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<p class="has-muted-color has-text-color has-s-font-size" style="margin-top:var(--wp--preset--spacing--50)"><?php echo esc_html_x( 'We answer within one working day.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"60%"} -->
<div class="wp-block-column" style="flex-basis:60%"><!-- wp:group {"className":"is-style-card evive-contact-form","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card evive-contact-form" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:evive/form {"formTitle":"<?php echo esc_attr_x( 'Contact', 'form name', 'evive' ); ?>","submitLabel":"<?php echo esc_attr_x( 'Send message', 'form button', 'evive' ); ?>","successMessage":"<?php echo esc_attr_x( 'Thank you! We received your message and will get back to you within one working day.', 'form message', 'evive' ); ?>"} -->
<!-- wp:evive/field {"name":"name","label":"<?php echo esc_attr_x( 'Name', 'form field', 'evive' ); ?>","required":true,"width":"half"} /-->

<!-- wp:evive/field {"type":"email","name":"email","label":"<?php echo esc_attr_x( 'Email', 'form field', 'evive' ); ?>","required":true,"width":"half"} /-->

<!-- wp:evive/field {"name":"company","label":"<?php echo esc_attr_x( 'Company', 'form field', 'evive' ); ?>"} /-->

<!-- wp:evive/field {"type":"textarea","name":"message","label":"<?php echo esc_attr_x( 'Message', 'form field', 'evive' ); ?>","required":true,"placeholder":"<?php echo esc_attr_x( 'What can we help you with?', 'form field placeholder', 'evive' ); ?>"} /-->
<!-- /wp:evive/form --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
