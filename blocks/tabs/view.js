/**
 * evive #411: makes every evive/tabs block on the page a tab list (WAI-ARIA tabs pattern, automatic activation):
 * click or tap a tab, or use the arrow keys, Home and End on the tab list. Loaded only on pages with the block
 * (viewScript). Without this script the tab list stays hidden and all panels are shown.
 */
( function () {
	var count = 0;

	function setup( root ) {
		var list = root.querySelector( ':scope > .evive-tabs__list' );
		var tabs = list ? Array.prototype.slice.call( list.querySelectorAll( ':scope > [role="tab"]' ) ) : [];
		var panels = Array.prototype.slice.call( root.querySelectorAll( ':scope > .evive-tabs__panel' ) );
		if ( ! tabs.length || tabs.length !== panels.length ) {
			return;
		}
		var id = root.id ? root.id + '-tabs' : 'evive-tabs-' + ( ++count );

		function select( index, focus ) {
			tabs.forEach( function ( tab, i ) {
				var on = i === index;
				tab.setAttribute( 'aria-selected', on ? 'true' : 'false' );
				tab.tabIndex = on ? 0 : -1;
				panels[ i ].hidden = ! on;
			} );
			if ( focus ) {
				tabs[ index ].focus();
			}
		}

		tabs.forEach( function ( tab, i ) {
			tab.id = id + '-tab-' + ( i + 1 );
			tab.setAttribute( 'aria-controls', id + '-panel-' + ( i + 1 ) );
			panels[ i ].id = id + '-panel-' + ( i + 1 );
			panels[ i ].setAttribute( 'role', 'tabpanel' );
			panels[ i ].setAttribute( 'aria-labelledby', tab.id );
			panels[ i ].tabIndex = 0;
			tab.addEventListener( 'click', function () {
				select( i, false );
			} );
		} );

		list.addEventListener( 'keydown', function ( e ) {
			var i = tabs.indexOf( document.activeElement );
			if ( i < 0 ) {
				return;
			}
			var last = tabs.length - 1;
			var next = { ArrowRight: i === last ? 0 : i + 1, ArrowLeft: i === 0 ? last : i - 1, Home: 0, End: last }[ e.key ];
			if ( undefined === next ) {
				return;
			}
			e.preventDefault();
			select( next, true );
		} );

		// A link to a panel (#its-id) or to an anchor inside it opens that tab.
		var hash = window.location.hash.slice( 1 );
		var start = 0;
		if ( hash ) {
			panels.forEach( function ( panel, i ) {
				var target = document.getElementById( hash );
				if ( target && panel.contains( target ) ) {
					start = i;
				}
			} );
		}
		select( start, false );
		list.hidden = false;
		root.classList.add( 'is-ready' );
	}

	function init() {
		Array.prototype.forEach.call( document.querySelectorAll( '[data-evive-tabs]' ), setup );
	}

	if ( 'loading' === document.readyState ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
} )();
