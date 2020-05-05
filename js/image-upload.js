( function ( $, Bestwebsite ) {
	'use strict';

	var views = Bestwebsite.views = Bestwebsite.views || {},
		ImageField = views.ImageField,
		ImageUploadField,
		UploadButton = views.UploadButton;

	ImageUploadField = views.ImageUploadField = ImageField.extend( {
		createAddButton: function () {
			this.addButton = new UploadButton( {controller: this.controller} );
		}
	} );

	function initImageUpload() {
		var $this = $( this ),
			view = $this.data( 'view' );

		if ( view ) {
			return;
		}

		view = new ImageUploadField( { input: this } );

		$this.siblings( '.Bestwebsite-media-view' ).remove();
		$this.after( view.el );

		// Init uploader after view is inserted to make wp.Uploader works.
		view.addButton.initUploader();

		$this.data( 'view', view );
	}

	function init( e ) {
		$( e.target ).find( '.Bestwebsite-image_upload, .Bestwebsite-plupload_image' ).each( initImageUpload );
	}

	Bestwebsite.$document
		.on( 'mb_ready', init )
		.on( 'clone', '.Bestwebsite-image_upload, .Bestwebsite-plupload_image', initImageUpload )
} )( jQuery, Bestwebsite );
