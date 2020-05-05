// Global object for shared functions and data.
window.Bestwebsite = window.Bestwebsite || {};

( function( $, document, Bestwebsite ) {
	'use strict';

	// Selectors for all plugin inputs.
	Bestwebsite.inputSelectors = 'input[class*="Bestwebsite"], textarea[class*="Bestwebsite"], select[class*="Bestwebsite"], button[class*="Bestwebsite"]';

	// Generate unique ID.
	Bestwebsite.uniqid = function uniqid() {
		return Math.random().toString( 36 ).substr( 2 );
	}

	// Trigger a custom ready event for all scripts to hook to.
	// Used for static DOM and dynamic DOM (loaded in MB Blocks extension for Gutenberg).
	Bestwebsite.$document = $( document );
	$( function() {
		Bestwebsite.$document.trigger( 'mb_ready' );
	} );
} )( jQuery, document, Bestwebsite );