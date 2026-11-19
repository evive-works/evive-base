/**
 * evive #513: sticky header. Anchor targets must land below a sticky header, so base.css sets
 * scroll-padding-top from --evive-sticky-header-offset. The header's height depends on the logo, the menu
 * and the screen width (on phones it can wrap to two rows), so this script keeps that variable equal to the
 * header's real height. Without JavaScript the CSS default (6rem) applies.
 */
( function () {
	'use strict';
	var sticky = document.querySelector( 'header.wp-block-template-part > .is-position-sticky' );
	if ( ! sticky ) {
		return;
	}
	var header = sticky.parentElement, root = document.documentElement;
	function update() {
		root.style.setProperty( '--evive-sticky-header-offset', Math.ceil( header.getBoundingClientRect().height ) + 'px' );
	}
	update();
	if ( 'ResizeObserver' in window ) {
		new ResizeObserver( update ).observe( header );
	} else {
		window.addEventListener( 'resize', update );
	}
}() );
