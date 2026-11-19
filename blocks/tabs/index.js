/**
 * evive #411: editor side of the blocks evive/tabs and evive/tab. Plain JS on the wp.* globals (no build step).
 * Both blocks save only their inner blocks; the tab list, labels and panels are rendered in PHP (render.php),
 * so the saved markup never changes when the front-end markup does. In the editor all tabs are shown one below
 * the other, each with its label as an editable heading.
 */
( function ( wp ) {
	var el = wp.element.createElement;
	var __ = wp.i18n.__;
	var be = wp.blockEditor;

	wp.blocks.registerBlockType( 'evive/tabs', {
		edit: function () {
			var blockProps = be.useBlockProps( { className: 'evive-tabs-editor' } );
			var inner = be.useInnerBlocksProps( blockProps, {
				allowedBlocks: [ 'evive/tab' ],
				template: [
					[ 'evive/tab', { label: __( 'First tab', 'evive' ) }, [ [ 'core/paragraph', { placeholder: __( 'Content of the first tab. Add any blocks.', 'evive' ) } ] ] ],
					[ 'evive/tab', { label: __( 'Second tab', 'evive' ) }, [ [ 'core/paragraph', { placeholder: __( 'Content of the second tab. Add any blocks.', 'evive' ) } ] ] ],
					[ 'evive/tab', { label: __( 'Third tab', 'evive' ) }, [ [ 'core/paragraph', { placeholder: __( 'Content of the third tab. Add any blocks.', 'evive' ) } ] ] ],
				],
				renderAppender: be.InnerBlocks.ButtonBlockAppender,
			} );
			return el( 'div', inner );
		},
		save: function () {
			return el( be.InnerBlocks.Content );
		},
	} );

	wp.blocks.registerBlockType( 'evive/tab', {
		edit: function ( props ) {
			var blockProps = be.useBlockProps( { className: 'evive-tab-editor' } );
			var inner = be.useInnerBlocksProps( { className: 'evive-tab-editor__content' }, {
				template: [ [ 'core/paragraph' ] ],
			} );
			return el( 'div', blockProps,
				el( be.RichText, {
					tagName: 'p',
					className: 'evive-tab-editor__label',
					value: props.attributes.label,
					allowedFormats: [],
					withoutInteractiveFormatting: true,
					placeholder: __( 'Tab label', 'evive' ),
					'aria-label': __( 'Tab label', 'evive' ),
					onChange: function ( label ) { props.setAttributes( { label: label } ); },
				} ),
				el( 'div', inner )
			);
		},
		save: function () {
			return el( be.InnerBlocks.Content );
		},
	} );
} )( window.wp );
