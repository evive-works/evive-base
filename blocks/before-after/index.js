/* evive #412: the before/after block in the editor. Plain script without a build step: the strings and the
   placeholder image URLs come from PHP (window.eviveBeforeAfter, text domain evive), see functions.php.
   The block saves only its two core/image blocks; render.php adds the labels and view.js the divider. */
( function ( wp ) {
	const el = wp.element.createElement;
	const { InnerBlocks, InspectorControls, useBlockProps, useInnerBlocksProps } = wp.blockEditor;
	const { PanelBody, RangeControl, TextControl } = wp.components;
	const s = Object.assign(
		{
			before: 'Before',
			after: 'After',
			panel: 'Before / after',
			labelBefore: 'Label of the before image',
			labelAfter: 'Label of the after image',
			position: 'Start position of the divider (%)',
			help: 'Visitors drag the divider or use the arrow keys. Without JavaScript both images are shown side by side.',
			placeholderBefore: '',
			placeholderAfter: '',
		},
		window.eviveBeforeAfter || {}
	);
	const image = ( url ) => [ 'core/image', url ? { url, alt: '' } : {} ];

	wp.blocks.registerBlockType( 'evive/before-after', {
		example: {
			innerBlocks: [
				{ name: 'core/image', attributes: { url: s.placeholderBefore, alt: '' } },
				{ name: 'core/image', attributes: { url: s.placeholderAfter, alt: '' } },
			],
		},
		edit: function Edit( { attributes, setAttributes } ) {
			const blockProps = useBlockProps( { className: 'evive-ba-editor' } );
			const innerProps = useInnerBlocksProps(
				{ className: 'evive-ba-editor__images' },
				{
					allowedBlocks: [ 'core/image' ],
					template: [ image( s.placeholderBefore ), image( s.placeholderAfter ) ],
					templateLock: 'all',
				}
			);
			return el(
				wp.element.Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: s.panel },
						el( TextControl, {
							label: s.labelBefore,
							placeholder: s.before,
							value: attributes.labelBefore,
							onChange: ( v ) => setAttributes( { labelBefore: v } ),
							__next40pxDefaultSize: true,
							__nextHasNoMarginBottom: true,
						} ),
						el( 'div', { style: { height: '16px' } } ),
						el( TextControl, {
							label: s.labelAfter,
							placeholder: s.after,
							value: attributes.labelAfter,
							onChange: ( v ) => setAttributes( { labelAfter: v } ),
							__next40pxDefaultSize: true,
							__nextHasNoMarginBottom: true,
						} ),
						el( 'div', { style: { height: '16px' } } ),
						el( RangeControl, {
							label: s.position,
							help: s.help,
							min: 0,
							max: 100,
							value: attributes.position,
							onChange: ( v ) => setAttributes( { position: undefined === v ? 50 : v } ),
							__next40pxDefaultSize: true,
							__nextHasNoMarginBottom: true,
						} )
					)
				),
				el(
					'div',
					blockProps,
					el(
						'div',
						{ className: 'evive-ba-editor__labels', 'aria-hidden': 'true' },
						el( 'span', { className: 'evive-ba__label' }, attributes.labelBefore || s.before ),
						el( 'span', { className: 'evive-ba__label' }, attributes.labelAfter || s.after )
					),
					el( 'div', innerProps )
				)
			);
		},
		save: () => el( InnerBlocks.Content ),
	} );
} )( window.wp );
