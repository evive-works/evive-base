/* evive #412: before/after slider. Turns the two images of each .evive-ba block into one picture with a
   divider. Mouse and touch: drag anywhere on the picture (touch only after a sideways move, so the page still
   scrolls vertically) or tap a spot. Keyboard and screen readers: the range input (arrow keys, Page Up/Down,
   Home/End). Without this script the block shows both images side by side. */
( function () {
	function setup( box ) {
		if ( box.classList.contains( 'is-interactive' ) ) {
			return;
		}
		const range = document.createElement( 'input' );
		range.type = 'range';
		range.min = '0';
		range.max = '100';
		range.step = '1';
		range.className = 'evive-ba__range';
		range.setAttribute( 'aria-label', box.getAttribute( 'data-evive-ba-label' ) || '' );

		const handle = document.createElement( 'span' );
		handle.className = 'evive-ba__handle';
		handle.setAttribute( 'aria-hidden', 'true' );
		handle.innerHTML = '<span class="evive-ba__grip"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" focusable="false"><path d="M9 6l-6 6 6 6M15 6l6 6-6 6"/></svg></span>';

		function set( value ) {
			const v = Math.round( Math.min( 100, Math.max( 0, value ) ) );
			box.style.setProperty( '--evive-ba-pos', v + '%' );
			range.value = String( v );
			range.setAttribute( 'aria-valuetext', v + '%' );
		}
		function fromX( x ) {
			const r = box.getBoundingClientRect();
			return r.width ? ( ( x - r.left ) / r.width ) * 100 : 50;
		}

		range.addEventListener( 'input', function () {
			set( Number( range.value ) );
		} );

		let pointer = null;
		let startX = 0;
		let moved = false;
		box.addEventListener( 'pointerdown', function ( e ) {
			if ( ! e.isPrimary || e.button > 0 ) {
				return;
			}
			pointer = e.pointerId;
			startX = e.clientX;
			moved = false;
			if ( 'mouse' === e.pointerType ) {
				e.preventDefault();
				moved = true;
				set( fromX( e.clientX ) );
				range.focus( { preventScroll: true } );
			}
			try {
				box.setPointerCapture( e.pointerId );
			} catch ( err ) {}
		} );
		box.addEventListener( 'pointermove', function ( e ) {
			if ( e.pointerId !== pointer || ( ! moved && Math.abs( e.clientX - startX ) < 4 ) ) {
				return;
			}
			moved = true;
			set( fromX( e.clientX ) );
		} );
		function end( e ) {
			if ( e.pointerId !== pointer ) {
				return;
			}
			if ( 'pointerup' === e.type && ! moved ) {
				set( fromX( e.clientX ) ); // A tap on touch screens.
			}
			pointer = null;
		}
		box.addEventListener( 'pointerup', end );
		box.addEventListener( 'pointercancel', end );
		box.addEventListener( 'dragstart', function ( e ) {
			e.preventDefault();
		} );

		box.append( handle, range );
		const start = parseFloat( box.getAttribute( 'data-evive-ba-pos' ) );
		set( isNaN( start ) ? 50 : start );
		box.classList.add( 'is-interactive' );
	}

	function run() {
		document.querySelectorAll( '.evive-ba' ).forEach( setup );
	}
	if ( 'loading' === document.readyState ) {
		document.addEventListener( 'DOMContentLoaded', run );
	} else {
		run();
	}
} )();
