( function ( $, Bestwebsite ) {
	'use strict';

	/**
	 * Update text value.
	 */
	function update() {
		var $this = $( this ),
			$output = $this.siblings( '.Bestwebsite-output' );

		$this.on( 'input propertychange change', function () {
			$output.html( $this.val() );
		} );
	}

	function init( e ) {
		$( e.target ).find( '.Bestwebsite-range' ).each( update );
	}

	Bestwebsite.$document
		.on( 'mb_ready', init )
		.on( 'clone', '.Bestwebsite-range', update );
} )( jQuery, Bestwebsite );
