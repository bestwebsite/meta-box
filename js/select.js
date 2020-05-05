( function ( $, Bestwebsite ) {
	'use strict';

	function toggleAll( e ) {
		e.preventDefault();

		var $this = $( this ),
			$select = $this.parent().siblings( 'select' );

		if ( 'none' === $this.data( 'type' ) ) {
			$select.val( [] ).trigger( 'change' );
			return;
		}
		var selected = [];
		$select.find( 'option' ).each( function ( index, option ) {
			selected.push( option.value );
		} );
		$select.val( selected ).trigger( 'change' );
	};

	Bestwebsite.$document.on( 'click', '.Bestwebsite-select-all-none a', toggleAll );
} )( jQuery, Bestwebsite );
