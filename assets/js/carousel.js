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

/* evive #546: Group with the "Slides" or "Slides, autoplay" block style: one slide at a time. The row is a CSS
   scroll-snap row (swipe works without this script); this adds previous/next (wrapping around), dots, the arrow
   keys, Home and End on the focused slides, and for "Slides, autoplay" a step every 6 seconds. Autoplay never runs
   with reduced motion, waits while the pointer is over the slides or the keyboard focus is in them (not on the controls), and stops for
   good after the pause button or any previous/next/dot click. */
( () => {
	const reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' );
	const DELAY = 6000;
	const init = ( track ) => {
		const nav = track.nextElementSibling;
		if ( ! nav || ! nav.classList.contains( 'evive-slides-nav' ) ) {
			return;
		}
		const slides = Array.from( track.children );
		const dots = Array.from( nav.querySelectorAll( '.evive-slides-dot' ) );
		const pause = nav.querySelector( '.evive-slides-pause' );
		const rtl = 'rtl' === getComputedStyle( track ).direction;
		const label = track.dataset.eviveSlideLabel || '%1$s / %2$s';
		slides.forEach( ( slide, i ) => {
			slide.setAttribute( 'role', 'group' );
			slide.setAttribute( 'aria-roledescription', track.dataset.eviveSlideRole || 'slide' );
			slide.setAttribute( 'aria-label', label.replace( '%1$s', i + 1 ).replace( '%2$s', slides.length ) );
		} );
		track.classList.add( 'evive-slides-on' );
		nav.hidden = slides.length < 2;
		const current = () => Math.max( 0, Math.min( slides.length - 1, Math.round( Math.abs( track.scrollLeft ) / ( track.clientWidth || 1 ) ) ) );
		const update = () => {
			const at = current();
			dots.forEach( ( dot, i ) => ( i === at ? dot.setAttribute( 'aria-current', 'true' ) : dot.removeAttribute( 'aria-current' ) ) );
		};
		const go = ( i ) => {
			const to = ( i + slides.length ) % slides.length;
			track.scrollTo( { left: to * track.clientWidth * ( rtl ? -1 : 1 ), behavior: reduce.matches ? 'auto' : 'smooth' } );
		};
		// Autoplay: "stopped" is for good (pause button, manual navigation, reduced motion); "held" only while
		// the pointer or the focus is on the slides or their controls.
		let timer = null;
		let stopped = ! pause || reduce.matches;
		let held = false;
		const tick = () => {
			timer = null;
			if ( ! stopped && ! held && ! document.hidden ) {
				go( current() + 1 );
			}
			schedule();
		};
		const schedule = () => {
			clearTimeout( timer );
			timer = stopped ? null : setTimeout( tick, DELAY );
		};
		const setStopped = ( value ) => {
			stopped = value;
			if ( pause ) {
				pause.classList.toggle( 'is-paused', stopped );
				pause.setAttribute( 'aria-label', stopped ? pause.dataset.labelPlay : pause.dataset.labelPause );
			}
			schedule();
		};
		const manual = ( i ) => {
			if ( pause && ! stopped ) {
				setStopped( true );
			}
			go( i );
		};
		nav.querySelector( '.evive-slides-prev' ).addEventListener( 'click', () => manual( current() - 1 ) );
		nav.querySelector( '.evive-slides-next' ).addEventListener( 'click', () => manual( current() + 1 ) );
		dots.forEach( ( dot, i ) => dot.addEventListener( 'click', () => manual( i ) ) );
		track.addEventListener( 'keydown', ( e ) => {
			if ( e.target !== track ) {
				return; // keys inside a slide (a link, a form) keep their own meaning
			}
			const keys = { ArrowLeft: rtl ? 1 : -1, ArrowRight: rtl ? -1 : 1 };
			if ( e.key in keys ) {
				manual( current() + keys[ e.key ] );
			} else if ( 'Home' === e.key ) {
				manual( 0 );
			} else if ( 'End' === e.key ) {
				manual( slides.length - 1 );
			} else {
				return;
			}
			e.preventDefault();
		} );
		track.addEventListener( 'scroll', update, { passive: true } );
		if ( 'onscrollend' in window ) {
			track.addEventListener( 'scrollend', update );
		}
		if ( 'ResizeObserver' in window ) {
			// After a resize the row would sit between two slides: snap back to the current one.
			let last = track.clientWidth;
			new ResizeObserver( () => {
				if ( track.clientWidth !== last ) {
					const at = Math.round( Math.abs( track.scrollLeft ) / ( last || 1 ) );
					last = track.clientWidth;
					track.scrollTo( { left: at * last * ( rtl ? -1 : 1 ), behavior: 'auto' } );
				}
				update();
			} ).observe( track );
		}
		if ( pause ) {
			// Only the slides themselves hold autoplay, not the controls: a click on "play" must start it.
			const hold = ( value ) => () => {
				held = value || track.matches( ':hover' ) || track.contains( document.activeElement );
				if ( ! held ) {
					schedule(); // a full interval after the pointer or the focus leaves
				}
			};
			track.addEventListener( 'mouseenter', hold( true ) );
			track.addEventListener( 'mouseleave', hold( false ) );
			track.addEventListener( 'focusin', hold( true ) );
			track.addEventListener( 'focusout', () => setTimeout( hold( false ) ) );
			pause.addEventListener( 'click', () => setStopped( ! stopped ) );
			pause.hidden = reduce.matches;
			reduce.addEventListener?.( 'change', () => {
				pause.hidden = reduce.matches;
				if ( reduce.matches ) {
					setStopped( true );
				}
			} );
			setStopped( stopped );
		}
		update();
	};
	document.querySelectorAll( '.wp-block-group.is-style-slides, .wp-block-group.is-style-slides-autoplay' ).forEach( init );
} )();
