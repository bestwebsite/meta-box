( function ( $, _, Bestwebsite ) {
	'use strict';

	/**
	 * Show preview of oembeded media.
	 */
	function showPreview( e ) {
		e.preventDefault();

		var $this = $( this ),
			$spinner = $this.siblings( '.spinner' ),
			data = {
				action: 'Bestwebsite_get_embed',
				url: this.value,
				not_available: $this.data( 'not-available' ),
			};

		$spinner.css( 'visibility', 'visible' );
		$.post( ajaxurl, data, function ( response ) {
			$spinner.css( 'visibility', 'hidden' );
			$this.siblings( '.Bestwebsite-embed-media' ).html( response.data );
		}, 'json' );
	}

	/**
	 * Remove oembed preview when cloning.
	 */
	function removePreview() {
		$( this ).siblings( '.Bestwebsite-embed-media' ).html( '' );
	}

	Bestwebsite.$document
		.on( 'change', '.Bestwebsite-oembed', _.debounce( showPreview, 250 ) )
	    .on( 'clone', '.Bestwebsite-oembed', removePreview );
} )( jQuery, _, Bestwebsite );
