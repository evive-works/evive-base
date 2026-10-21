<?php
/**
 * Updates from GitHub Releases (whyatwork-site card #361). Same library as our other distributed
 * plugins (invaise-checkout, evive Connector): YahnisElsts Plugin Update Checker v5, MIT licence.
 * WordPress shows "Update available" when a newer release vX.Y.Z with the asset evive-base.zip exists.
 *
 * wp-config.php settings (all optional):
 *   define( 'EVIVE_BASE_AUTO_UPDATE', false );  // switch the update check off for this theme
 *   define( 'EVIVE_GITHUB_OWNER', 'owner' );     // GitHub account that holds the evive repos
 *   define( 'EVIVE_GITHUB_TOKEN', '…' );         // read-only token, only needed while the repo is private
 * Filter `evive_auto_update( bool $enabled, string $slug )` can also switch it off.
 *
 * @package evive
 */

defined( 'ABSPATH' ) || exit;

( static function () {
	$enabled = ! defined( 'EVIVE_BASE_AUTO_UPDATE' ) || EVIVE_BASE_AUTO_UPDATE;
	if ( ! apply_filters( 'evive_auto_update', $enabled, 'evive-base' ) ) {
		return;
	}
	require_once __DIR__ . '/../lib/plugin-update-checker/plugin-update-checker.php';

	$owner   = defined( 'EVIVE_GITHUB_OWNER' ) ? EVIVE_GITHUB_OWNER : 'stackpros';
	$checker = \YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
		'https://github.com/' . rawurlencode( $owner ) . '/evive-base/',
		get_template_directory() . '/functions.php',
		'evive-base'
	);
	$checker->setBranch( 'main' );
	$checker->getVcsApi()->enableReleaseAssets( '/evive-base\.zip$/' );
	if ( defined( 'EVIVE_GITHUB_TOKEN' ) && EVIVE_GITHUB_TOKEN ) {
		$checker->setAuthentication( EVIVE_GITHUB_TOKEN );
	}
} )();
