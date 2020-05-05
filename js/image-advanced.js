( function ( $, Bestwebsite ) {
	'use strict';

	var views = Bestwebsite.views = Bestwebsite.views || {},
		MediaField = views.MediaField,
		MediaItem = views.MediaItem,
		MediaList = views.MediaList,
		ImageField;

	ImageField = views.ImageField = MediaField.extend( {
		createList: function () {
			this.list = new MediaList( {
				controller: this.controller,
				itemView: MediaItem.extend( {
					className: 'Bestwebsite-image-item attachment',
					template: wp.template( 'Bestwebsite-image-item' ),
					initialize: function( models, options ) {
						MediaItem.prototype.initialize.call( this, models, options );
						this.$el.addClass( this.controller.get( 'imageSize' ) );
					}
				} )
			} );
		}
	} );

	/**
	 * Initialize image fields
	 */
	function initImageField() {
		var $this = $( this ),
			view = $this.data( 'view' );

		if ( view ) {
			return;
		}

		view = new ImageField( { input: this } );

		$this.siblings( '.Bestwebsite-media-view' ).remove();
		$this.after( view.el );
		$this.data( 'view', view );
	}

	function init( e ) {
		$( e.target ).find( '.Bestwebsite-image_advanced' ).each( initImageField );
	}

	Bestwebsite.$document
		.on( 'mb_ready', init )
		.on( 'clone', '.Bestwebsite-image_advanced', initImageField );
} )( jQuery, Bestwebsite );
