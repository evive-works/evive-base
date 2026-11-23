/* evive #546: Video blocks with the "Muted loop" style. The theme renders them with preload="none" and without
   autoplay, so the browser shows only the poster until this script decides: after the page has loaded it starts
   the video, except on phones (below 782px, to save data) and with reduced motion. There the visitor starts it
   with the play button (or a tap on the video). The same button pauses it again (WCAG 2.2.2). */
( () => {
	const reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' );
	const small = window.matchMedia( '(max-width: 781px)' );
	const init = ( video ) => {
		const figure = video.closest( 'figure' );
		const button = figure && figure.querySelector( '.evive-video-toggle' );
		if ( ! button ) {
			return;
		}
		video.muted = true;
		video.removeAttribute( 'controls' );
		figure.classList.add( 'evive-video-on', 'is-idle' );
		button.hidden = false;
		const sync = () => {
			const playing = ! video.paused;
			button.classList.toggle( 'is-playing', playing );
			button.setAttribute( 'aria-label', playing ? button.dataset.labelPause : button.dataset.labelPlay );
			if ( playing ) {
				figure.classList.remove( 'is-idle' );
			}
		};
		const play = () => video.play().catch( sync );
		const toggle = () => ( video.paused ? play() : video.pause() );
		video.addEventListener( 'play', sync );
		video.addEventListener( 'pause', sync );
		button.addEventListener( 'click', toggle );
		video.addEventListener( 'click', toggle );
		// Reduced motion switched on while it plays: stop it.
		reduce.addEventListener?.( 'change', () => reduce.matches && video.pause() );
		if ( ! reduce.matches && ! small.matches ) {
			if ( 'complete' === document.readyState ) {
				play();
			} else {
				window.addEventListener( 'load', play, { once: true } );
			}
		}
		sync();
	};
	document.querySelectorAll( 'video[data-evive-loop]' ).forEach( init );
} )();
