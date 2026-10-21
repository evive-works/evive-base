<?php
/**
 * Title: FAQ
 * Slug: evive/faq
 * Categories: evive-content
 * Keywords: faq, questions, answers, accordion
 * Viewport Width: 1280
 * Description: Frequently asked questions as expandable Details blocks. Adds FAQPage structured data (JSON-LD) built from the questions and answers.
 *
 * @package evive
 */

$evive_img = get_template_directory_uri() . "/assets/images/";
?>
<!-- wp:group {"align":"full","className":"evive-faq","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained","contentSize":"46rem"}} -->
<div class="wp-block-group alignfull evive-faq" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html_x( 'Frequently asked questions', 'placeholder', 'evive' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:details {"summary":"<?php echo esc_html_x( 'What is the first question people ask?', 'placeholder', 'evive' ); ?>","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"border":{"bottom":{"color":"var:preset|color|border","width":"1px","style":"solid"}}}} -->
<details class="wp-block-details" style="border-bottom-color:var(--wp--preset--color--border);border-bottom-style:solid;border-bottom-width:1px;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><summary><?php echo esc_html_x( 'What is the first question people ask?', 'placeholder', 'evive' ); ?></summary><!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'The answer, in a few clear sentences. Link to more detail if needed.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"summary":"<?php echo esc_html_x( 'How long does it take to get started?', 'placeholder', 'evive' ); ?>","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"border":{"bottom":{"color":"var:preset|color|border","width":"1px","style":"solid"}}}} -->
<details class="wp-block-details" style="border-bottom-color:var(--wp--preset--color--border);border-bottom-style:solid;border-bottom-width:1px;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><summary><?php echo esc_html_x( 'How long does it take to get started?', 'placeholder', 'evive' ); ?></summary><!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'The answer, in a few clear sentences. Link to more detail if needed.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"summary":"<?php echo esc_html_x( 'What does it cost?', 'placeholder', 'evive' ); ?>","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"border":{"bottom":{"color":"var:preset|color|border","width":"1px","style":"solid"}}}} -->
<details class="wp-block-details" style="border-bottom-color:var(--wp--preset--color--border);border-bottom-style:solid;border-bottom-width:1px;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><summary><?php echo esc_html_x( 'What does it cost?', 'placeholder', 'evive' ); ?></summary><!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'The answer, in a few clear sentences. Link to more detail if needed.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"summary":"<?php echo esc_html_x( 'Can I cancel at any time?', 'placeholder', 'evive' ); ?>","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"border":{"bottom":{"color":"var:preset|color|border","width":"1px","style":"solid"}}}} -->
<details class="wp-block-details" style="border-bottom-color:var(--wp--preset--color--border);border-bottom-style:solid;border-bottom-width:1px;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><summary><?php echo esc_html_x( 'Can I cancel at any time?', 'placeholder', 'evive' ); ?></summary><!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html_x( 'The answer, in a few clear sentences. Link to more detail if needed.', 'placeholder', 'evive' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
