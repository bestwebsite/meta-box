( function ( $, Bestwebsite, i18n ) {
	'use strict';

	/**
	 * Transform an input into an autocomplete.
	 */
	function transform( e ) {
		var $this = $( this ),
			$search = $this.siblings( '.Bestwebsite-autocomplete-search' ),
			$result = $this.siblings( '.Bestwebsite-autocomplete-results' ),
			name = $this.attr( 'name' );

		// If the function is called on cloning, then change the field name and clear all results
		if ( e.hasOwnProperty( 'type' ) && 'clone' == e.type ) {
			$result.html( '' );
		}

		$search.removeClass( 'ui-autocomplete-input' ).autocomplete( {
			minLength: 0,
			source: $this.data( 'options' ),
			select: function ( event, ui ) {
				$result.append(
					'<div class="Bestwebsite-autocomplete-result">' +
					'<div class="label">' + ( typeof ui.item.excerpt !== 'undefined' ? ui.item.excerpt : ui.item.label ) + '</div>' +
					'<div class="actions">' + i18n.delete + '</div>' +
					'<input type="hidden" class="Bestwebsite-autocomplete-value" name="' + name + '" value="' + ui.item.value + '">' +
					'</div>'
				);

				// Reinitialize value.
				$search.val( '' ).trigger( 'change' );

				return false;
			}
		} );
	}

	function deleteSelection( e ) {
		e.preventDefault();
		var $item = $( this ).parent(),
			$search = $item.parent().siblings( '.Bestwebsite-autocomplete-search' );

		$item.remove();
		$search.trigger( 'change' );
	}

	function init( e ) {
		$( e.target ).find( '.Bestwebsite-autocomplete-wrapper input[type="hidden"]' ).each( transform );
	}

	Bestwebsite.$document
		.on( 'mb_ready', init )
		.on( 'clone', '.Bestwebsite-autocomplete', transform )
		.on( 'click', '.Bestwebsite-autocomplete-result .actions', deleteSelection );
} )( jQuery, Bestwebsite, Bestwebsite_Autocomplete );
