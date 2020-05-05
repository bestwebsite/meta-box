( function ( $, Bestwebsite ) {
	'use strict';

	var frame;

	function openSelectPopup( e ) {
		e.preventDefault();
		var $el = $( this );

		// Create a frame only if needed
		if ( ! frame ) {
			frame = wp.media( {
				className: 'media-frame Bestwebsite-file-frame',
				multiple: false,
				title: BestwebsiteFileInput.frameTitle
			} );
		}

		// Open media uploader
		frame.open();

		// Remove all attached 'select' event
		frame.off( 'select' );

		// Handle selection
		frame.on( 'select', function () {
			var url = frame.state().get( 'selection' ).first().toJSON().url;
			$el.siblings( 'input' ).val( url ).trigger( 'change' ).siblings( 'a' ).removeClass( 'hidden' );
		} );
	}

	function clearSelection( e ) {
		e.preventDefault();
		$( this ).addClass( 'hidden' ).siblings( 'input' ).val( '' ).trigger( 'change' );
	}

	function hideRemoveButtonWhenCloning() {
		$( this ).siblings( '.Bestwebsite-file-input-remove' ).addClass( 'hidden' );
	}

	Bestwebsite.$document
		.on( 'click', '.Bestwebsite-file-input-select', openSelectPopup )
		.on( 'click', '.Bestwebsite-file-input-remove', clearSelection )
		.on( 'clone', '.Bestwebsite-file_input', hideRemoveButtonWhenCloning );
} )( jQuery, Bestwebsite );
