( function( wp ) {

	var registerBlockType = wp.blocks.registerBlockType;

	var el = wp.element.createElement;

	var __ = wp.i18n.__;

	registerBlockType( 'daily-nasa-photo/picture', {

		title: __( 'Daily Nasa Picture', 'daily-nasa-photo' ),

		icon: 'camera',

		category: 'widgets',

		supports: {
			html: false
		},

		attributes: {
		},

		edit: function( props ) {

			return el(
				'div', {
					className: props.className
				},
				[
						el( 'div', {
							className: 'ndp-image-edit',
							style: { backgroundImage: 'url(' + pictureobject.url + ')' }
							}),
						el( 'h4', { className: 'ndp-title-edit' },  pictureobject.title ),
						el( 'p', { className: 'ndp-copyright-edit' },  pictureobject.copyright ),
						el( 'p', { className: 'ndp-explantion-edit' }, pictureobject.explanation )
				]
			)
		},
		save: function( props ) {
		}
	} );
} )(
	window.wp
);
