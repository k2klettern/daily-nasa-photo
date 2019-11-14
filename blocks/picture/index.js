( function( wp ) {

	var registerBlockType = wp.blocks.registerBlockType;

	var el = wp.element.createElement;

	var __ = wp.i18n.__;

	registerBlockType( 'daily-nasa-photo/picture', {

		title: __( 'Daily Nasa Picture', 'daily-nasa-photo' ),

		category: 'widgets',

		supports: {
			html: true
		},

		attributes: {
			alignment: {
				type: 'string',
				default: 'center'
			}
		},

		edit: function( props ) {
			function onChangeAlignment( newAlignment ) {
				props.setAttributes( { alignment: newAlignment } );
			}

			return [
				!! props.focus && el(
				blocks.BlockControls,
				{ key: 'controls' },
				el(
					blocks.AlignmentToolbar,
					{
						value: props.alignment,
						onChange: onChangeAlignment,
					}
				)
			),
			el( 'div', { className: props.className },
				el( 'div', {
					className: 'ndp-image-edit',
					style: { backgroundImage: 'url(' + pictureobject.url + ')' }
					}),
				el( 'h4', { className: 'ndp-title-edit' },  pictureobject.title ),
				el( 'p', { className: 'ndp-copyright-edit' },  pictureobject.copyright ),
				el( 'p', { className: 'ndp-explantion-edit' }, pictureobject.explanation )
			)
			]
		},

		save: function( props ) {
			return el( 'div', { className: props.className },
				el( 'div', { className: 'ndp-content'},
				el( 'img', { className: 'ndp-image', src: pictureobject.url, width: '100%' } ),
				el( 'div', { className: 'ndp-title', style: { textAlign: props.attributes.alignment } },
					el( 'h4', {}, pictureobject.title ),
					el( 'p', { className: 'ndp-copyright' },  pictureobject.copyright ),
					el( 'p', { className: 'ndp-explanation' }, pictureobject.explanation )
				)
				)
			);
		}
	} );
} )(
	window.wp
);
