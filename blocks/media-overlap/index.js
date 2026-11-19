/* evive #516: media with an overlapping card, in the editor. Plain script without a build step: the strings
   come from PHP (window.eviveMediaOverlap, text domain evive), see functions.php. Both blocks save only their
   inner blocks; render.php adds the wrapper with the same classes and CSS variables as edit() below, so the
   editor shows the front-end layout and saved content never goes invalid when the markup changes. */
( function ( wp ) {
	const el = wp.element.createElement;
	const be = wp.blockEditor;
	const { PanelBody, RangeControl, SelectControl, ToggleControl, ColorPalette, BaseControl } = wp.components;
	const s = Object.assign(
		{
			panel: 'Card',
			corner: 'Card position',
			bottomLeft: 'Bottom left',
			bottomRight: 'Bottom right',
			topLeft: 'Top left',
			topRight: 'Top right',
			offsetX: 'Sticks out sideways',
			offsetY: 'Sticks out vertically',
			offsetHelp: 'How far the card sticks out beyond the image (spacing steps). The block reserves that space, so nothing next to or below it is covered.',
			width: 'Card width (% of the image)',
			background: 'Card background',
			backgroundHelp: 'Theme colours only. No colour: transparent card.',
			radius: 'Card corners',
			padding: 'Padding inside the card',
			shadow: 'Shadow',
			none: 'None',
			small: 'Small',
			medium: 'Medium',
			large: 'Large',
			phone: 'Keep the overlap on phones',
			phoneHelp: 'Off: on screens below 782px the card stacks under the image.',
			cardText: 'Card content: an image, SVG, text or any blocks.',
			placeholder: '',
		},
		window.eviveMediaOverlap || {}
	);
	const steps = [ { label: s.none, value: '0' } ].concat(
		[ 1, 2, 3, 4, 5, 6, 7 ].map( ( n ) => ( { label: String( n ), value: n + '0' } ) )
	);
	const sizes = [
		{ label: s.none, value: 'none' },
		{ label: s.small, value: 's' },
		{ label: s.medium, value: 'm' },
		{ label: s.large, value: 'l' },
	];
	const spacing = ( slug, fallback ) =>
		'0' === slug ? '0px' : 'var(--wp--preset--spacing--' + ( /^[1-7]0$/.test( slug || '' ) ? slug : fallback ) + ')';
	const pairs = { primary: 'primary-contrast', accent: 'accent-contrast', contrast: 'base' };

	// The same variables as render.php.
	function vars( a ) {
		const bg = /^[a-z0-9-]+$/.test( a.cardBackground || '' ) ? a.cardBackground : 'base';
		return {
			'--evive-mo-ox': spacing( a.offsetX, '50' ),
			'--evive-mo-oy': spacing( a.offsetY, '60' ),
			'--evive-mo-w': String( Math.round( Math.max( 20, Math.min( 100, Number( a.cardWidth ) || 60 ) ) ) ),
			'--evive-mo-bg': 'none' === bg ? 'transparent' : 'var(--wp--preset--color--' + bg + ')',
			'--evive-mo-fg': 'none' === bg ? 'inherit' : 'var(--wp--preset--color--' + ( pairs[ bg ] || 'contrast' ) + ')',
			'--evive-mo-radius': [ 's', 'm', 'l' ].includes( a.cardRadius ) ? 'var(--wp--custom--radius--' + a.cardRadius + ')' : '0px',
			'--evive-mo-pad': spacing( a.cardPadding, '30' ),
			'--evive-mo-shadow': [ 's', 'm', 'l' ].includes( a.cardShadow ) ? 'var(--wp--preset--shadow--' + a.cardShadow + ')' : 'none',
		};
	}

	function usePalette() {
		let palette;
		if ( be.useSettings ) {
			palette = be.useSettings( 'color.palette' )[ 0 ];
		} else if ( be.useSetting ) {
			palette = be.useSetting( 'color.palette' );
		}
		if ( palette && ! Array.isArray( palette ) ) {
			palette = palette.theme || [];
		}
		return palette || [];
	}

	wp.blocks.registerBlockType( 'evive/media-overlap', {
		edit: function Edit( { attributes: a, setAttributes } ) {
			const palette = usePalette();
			const current = palette.find( ( c ) => c.slug === a.cardBackground );
			const blockProps = be.useBlockProps( {
				className: 'evive-mo is-card-' + a.corner + ( a.overlapOnPhone ? ' is-overlap-on-phone' : '' ),
				style: vars( a ),
			} );
			const innerProps = be.useInnerBlocksProps( blockProps, {
				template: [
					[ 'core/image', s.placeholder ? { url: s.placeholder, alt: '' } : {} ],
					[ 'evive/media-overlap-card', {}, [ [ 'core/paragraph', { placeholder: s.cardText } ] ] ],
				],
				templateLock: 'all',
			} );
			const select = ( key, label, options, help ) =>
				el( SelectControl, {
					label,
					help,
					value: a[ key ],
					options,
					onChange: ( v ) => setAttributes( { [ key ]: v } ),
					__next40pxDefaultSize: true,
					__nextHasNoMarginBottom: true,
				} );
			const gap = () => el( 'div', { style: { height: '16px' } } );
			return el(
				wp.element.Fragment,
				null,
				el(
					be.InspectorControls,
					null,
					el(
						PanelBody,
						{ title: s.panel },
						select( 'corner', s.corner, [
							{ label: s.bottomLeft, value: 'bottom-left' },
							{ label: s.bottomRight, value: 'bottom-right' },
							{ label: s.topLeft, value: 'top-left' },
							{ label: s.topRight, value: 'top-right' },
						] ),
						gap(),
						select( 'offsetX', s.offsetX, steps ),
						gap(),
						select( 'offsetY', s.offsetY, steps, s.offsetHelp ),
						gap(),
						el( RangeControl, {
							label: s.width,
							min: 20,
							max: 100,
							step: 5,
							value: a.cardWidth,
							onChange: ( v ) => setAttributes( { cardWidth: undefined === v ? 60 : v } ),
							__next40pxDefaultSize: true,
							__nextHasNoMarginBottom: true,
						} ),
						gap(),
						el(
							BaseControl,
							{ id: 'evive-mo-bg', label: s.background, help: s.backgroundHelp, __nextHasNoMarginBottom: true },
							el( ColorPalette, {
								colors: palette,
								value: 'none' === a.cardBackground ? undefined : current && current.color,
								disableCustomColors: true,
								clearable: true,
								onChange: ( color, index ) => {
									let pick = undefined !== index && palette[ index ] && palette[ index ].color === color ? palette[ index ] : null;
									pick = pick || palette.find( ( c ) => c.color === color );
									setAttributes( { cardBackground: color && pick ? pick.slug : 'none' } );
								},
							} )
						),
						gap(),
						select( 'cardRadius', s.radius, sizes ),
						gap(),
						select( 'cardPadding', s.padding, steps ),
						gap(),
						select( 'cardShadow', s.shadow, sizes ),
						gap(),
						el( ToggleControl, {
							label: s.phone,
							help: s.phoneHelp,
							checked: !! a.overlapOnPhone,
							onChange: ( v ) => setAttributes( { overlapOnPhone: v } ),
							__nextHasNoMarginBottom: true,
						} )
					)
				),
				el( 'div', innerProps )
			);
		},
		save: () => el( be.InnerBlocks.Content ),
	} );

	wp.blocks.registerBlockType( 'evive/media-overlap-card', {
		edit: function EditCard() {
			const inner = be.useInnerBlocksProps( be.useBlockProps( { className: 'evive-mo__card' } ), {
				template: [ [ 'core/paragraph', { placeholder: s.cardText } ] ],
				templateLock: false,
			} );
			return el( 'div', inner );
		},
		save: () => el( be.InnerBlocks.Content ),
	} );
} )( window.wp );
