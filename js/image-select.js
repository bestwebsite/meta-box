( function ( $, Bestwebsite ) {
	'use strict';

	function setActiveClass() {
		var $this = $( this ),
			type = $this.attr( 'type' ),
			selected = $this.is( ':checked' ),
			$parent = $this.parent(),
			$others = $parent.siblings();
		if ( selected ) {
			$parent.addClass( 'Bestwebsite-active' );
			if ( type === 'radio' ) {
				$others.removeClass( 'Bestwebsite-active' );
			}
		} else {
			$parent.removeClass( 'Bestwebsite-active' );
		}
	}

	function init( e ) {
		$( e.target ).find( '.Bestwebsite-image-select input' ).trigger( 'change' );
	}

	Bestwebsite.$document
		.on( 'mb_ready', init )
		.on( 'change', '.Bestwebsite-image-select input', setActiveClass );
} )( jQuery, Bestwebsite );
