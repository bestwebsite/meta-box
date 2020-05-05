( function ( $, Bestwebsite ) {
	'use strict';

	function toggleTree() {
		var $this = $( this ),
			$children = $this.closest( 'li' ).children( 'ul' );

		if ( $this.is( ':checked' ) ) {
			$children.removeClass( 'hidden' );
		} else {
			$children.addClass( 'hidden' ).find( 'input' ).prop( 'checked', false );
		}
	}

	function toggleAll( e ) {
		e.preventDefault();

		var $this = $( this ),
			checked = $this.data( 'checked' );

		if ( undefined === checked ) {
			checked = true;
		}

		$this.parent().siblings( '.Bestwebsite-input-list' ).find( 'input' ).prop( 'checked', checked ).trigger( 'change' );

		checked = ! checked;
		$this.data( 'checked', checked );
	}

	function init( e ) {
		$( e.target ).find( '.Bestwebsite-input-list.Bestwebsite-collapse input[type="checkbox"]' ).each( toggleTree );
	}

	Bestwebsite.$document
		.on( 'mb_ready', init )
		.on( 'change', '.Bestwebsite-input-list.Bestwebsite-collapse input[type="checkbox"]', toggleTree )
		.on( 'clone', '.Bestwebsite-input-list.Bestwebsite-collapse input[type="checkbox"]', toggleTree )
		.on( 'click', '.Bestwebsite-input-list-select-all-none', toggleAll );
} )( jQuery, Bestwebsite );
