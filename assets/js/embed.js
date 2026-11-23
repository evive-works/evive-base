/* evive #546: privacy embed for YouTube and Vimeo. The theme renders a local thumbnail and a play link instead
   of the player; only a click on it loads the player (youtube-nocookie.com, Vimeo with dnt=1), which then starts
   playing. Before that click the browser has made no request to YouTube or Vimeo. */
( () => {
	document.querySelectorAll( '.evive-embed[data-evive-embed]' ).forEach( ( box ) => {
		const play = box.querySelector( '.evive-embed-play' );
		if ( ! play ) {
			return;
		}
		play.addEventListener( 'click', ( e ) => {
			e.preventDefault();
			const frame = document.createElement( 'iframe' );
			frame.src = box.dataset.eviveEmbed;
			frame.title = box.dataset.eviveEmbedTitle || '';
			frame.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; fullscreen; gyroscope; picture-in-picture; web-share';
			frame.allowFullscreen = true;
			frame.referrerPolicy = 'strict-origin-when-cross-origin';
			frame.className = 'evive-embed-frame';
			box.replaceChildren( frame );
			box.classList.add( 'is-loaded' );
			frame.focus();
		} );
	} );
} )();
