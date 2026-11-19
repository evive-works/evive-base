/* evive #413: previous/next buttons for Columns with the "Carousel" block style. The row itself is a
   CSS scroll-snap row that works without this script; the buttons (rendered hidden by the theme) are
   only shown when there is something to scroll. */
( () => {
	const reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' );
	const init = ( track ) => {
		const nav = track.nextElementSibling;
		if ( ! nav || ! nav.classList.contains( 'evive-carousel-nav' ) ) {
			return;
		}
		const prev = nav.querySelector( '.evive-carousel-prev' );
		const next = nav.querySelector( '.evive-carousel-next' );
		const rtl = 'rtl' === getComputedStyle( track ).direction;
		// One step = the distance between two cards (card width + gap).
		const step = () => {
			const items = track.children;
			return items.length > 1 ? Math.abs( items[ 1 ].offsetLeft - items[ 0 ].offsetLeft ) : track.clientWidth;
		};
		const update = () => {
			const max = track.scrollWidth - track.clientWidth;
			const pos = Math.abs( track.scrollLeft );
			nav.hidden = max <= 1;
			// aria-disabled instead of disabled, so a button keeps keyboard focus at the end of the row.
			prev.setAttribute( 'aria-disabled', pos <= 1 ? 'true' : 'false' );
			next.setAttribute( 'aria-disabled', pos >= max - 1 ? 'true' : 'false' );
		};
		const go = ( button, dir ) => {
			if ( 'true' === button.getAttribute( 'aria-disabled' ) ) {
				return;
			}
			track.scrollBy( { left: dir * step() * ( rtl ? -1 : 1 ), behavior: reduce.matches ? 'auto' : 'smooth' } );
		};
		prev.addEventListener( 'click', () => go( prev, -1 ) );
		next.addEventListener( 'click', () => go( next, 1 ) );
		track.addEventListener( 'scroll', update, { passive: true } );
		if ( 'ResizeObserver' in window ) {
			new ResizeObserver( update ).observe( track );
		}
		update();
	};
	document.querySelectorAll( '.wp-block-columns.is-style-carousel' ).forEach( init );
} )();
