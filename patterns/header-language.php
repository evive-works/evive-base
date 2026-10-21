<?php
/**
 * Title: Header language switcher
 * Slug: evive/header-language
 * Inserter: no
 * Description: The evive-language switcher when that plugin is active; nothing otherwise.
 *
 * @package evive
 */

if ( ! WP_Block_Type_Registry::get_instance()->is_registered( 'evive-language/switcher' ) ) {
	return;
}
?>
<!-- wp:evive-language/switcher {"display":"code","fontSize":"s"} /-->
