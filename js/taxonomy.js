( function ( $, Bestwebsite ) {
	'use strict';

	function toggleAddInput( e ) {
		e.preventDefault();
		this.nextElementSibling.classList.toggle( 'Bestwebsite-hidden' );
	}

	Bestwebsite.$document.on( 'click', '.Bestwebsite-taxonomy-add-button', toggleAddInput );
} )( jQuery, Bestwebsite );
