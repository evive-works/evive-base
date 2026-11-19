/**
 * evive #414: "Count up" paragraph style. The real number is in the HTML; this script only animates it
 * from 0 to that number, once, when the paragraph scrolls into view. Nothing happens without
 * IntersectionObserver, with prefers-reduced-motion, or when the text holds no single number
 * (e.g. "24/7"). Prefix and suffix ("€", "+", "%") stay as they are; the number keeps its own
 * thousands separator and decimals ("1,200", "1.200", "4,8").
 */
( function () {
	'use strict';
	if ( ! ( 'IntersectionObserver' in window ) || window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
		return;
	}
	var DURATION = 1600;

	// Find the text node with the one number in it; null when there is none or more than one.
	function findNumber( el ) {
		var walker = document.createTreeWalker( el, NodeFilter.SHOW_TEXT ), node, found = null, m;
		while ( ( node = walker.nextNode() ) ) {
			var runs = node.nodeValue.match( /\d(?:[\d.,   ]*\d)?/g );
			if ( ! runs ) {
				continue;
			}
			if ( found || runs.length > 1 ) {
				return null;
			}
			m = /\d(?:[\d.,   ]*\d)?/.exec( node.nodeValue );
			found = { node: node, before: node.nodeValue.slice( 0, m.index ), raw: m[ 0 ], after: node.nodeValue.slice( m.index + m[ 0 ].length ) };
		}
		return found ? parse( found ) : null;
	}

	// Work out the value, the thousands separator and the decimal mark of the number as written.
	function parse( f ) {
		var raw = f.raw, dec = '', group = '', seps = raw.replace( /\d/g, '' );
		var last = seps.slice( -1 );
		if ( /[.,]/.test( last ) ) {
			var lastPos = raw.lastIndexOf( last ), tail = raw.length - lastPos - 1;
			var hasOther = seps.replace( new RegExp( '\\' + last, 'g' ), '' ).length > 0;
			// "1,200" / "1.200.000" is grouping; "4,8", "1.200,5" or "1,200.5" has a decimal part.
			if ( hasOther || seps.split( last ).length - 1 === 1 && tail !== 3 ) {
				dec = last;
			}
		}
		var intPart = dec ? raw.slice( 0, raw.lastIndexOf( dec ) ) : raw;
		var g = intPart.replace( /\d/g, '' );
		group = g ? g.charAt( 0 ) : '';
		var decimals = dec ? raw.length - raw.lastIndexOf( dec ) - 1 : 0;
		var value = parseFloat( intPart.replace( /\D/g, '' ) + ( dec ? '.' + raw.slice( raw.lastIndexOf( dec ) + 1 ) : '' ) );
		if ( ! isFinite( value ) || value === 0 ) {
			return null;
		}
		f.value = value;
		f.decimals = decimals;
		f.dec = dec;
		f.group = group;
		f.pad = intPart.replace( /\D/g, '' ).length > 1 && intPart.charAt( 0 ) === '0'; // "007": no counting
		return f.pad ? null : f;
	}

	function format( f, n ) {
		var s = n.toFixed( f.decimals ), parts = s.split( '.' ), int = parts[ 0 ];
		if ( f.group ) {
			int = int.replace( /\B(?=(\d{3})+(?!\d))/g, f.group );
		}
		return int + ( parts[ 1 ] ? f.dec + parts[ 1 ] : '' );
	}

	function run( f ) {
		var start = null;
		function step( t ) {
			if ( start === null ) {
				start = t;
			}
			var p = Math.min( ( t - start ) / DURATION, 1 );
			var eased = 1 - Math.pow( 1 - p, 3 );
			f.node.nodeValue = f.before + format( f, p < 1 ? f.value * eased : f.value ) + f.after;
			if ( p < 1 ) {
				window.requestAnimationFrame( step );
			} else {
				f.node.nodeValue = f.before + f.raw + f.after; // exactly the original text
			}
		}
		window.requestAnimationFrame( step );
	}

	var observer = new IntersectionObserver( function ( entries ) {
		entries.forEach( function ( entry ) {
			if ( ! entry.isIntersecting ) {
				return;
			}
			observer.unobserve( entry.target );
			var f = findNumber( entry.target );
			if ( f ) {
				run( f );
			}
		} );
	}, { threshold: 0.6 } );

	document.querySelectorAll( '.is-style-count-up' ).forEach( function ( el ) {
		observer.observe( el );
	} );
} )();
