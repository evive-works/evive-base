<?php
// evive #516: editor script dependencies (plain script, no build step).
return [
	'dependencies' => [ 'wp-blocks', 'wp-block-editor', 'wp-components', 'wp-element' ],
	'version'      => defined( 'EVIVE_BASE_VERSION' ) ? EVIVE_BASE_VERSION : false,
];
