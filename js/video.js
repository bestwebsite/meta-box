( function ( $, Bestwebsite ) {
	'use strict';

	var views = Bestwebsite.views = Bestwebsite.views || {},
		MediaField = views.MediaField,
		MediaItem = views.MediaItem,
		MediaList = views.MediaList,
		VideoField;

	VideoField = views.VideoField = MediaField.extend( {
		createList: function ()
		{
			this.list = new MediaList( {
				controller: this.controller,
				itemView: MediaItem.extend( {
					className: 'Bestwebsite-video-item',
					template : wp.template( 'Bestwebsite-video-item' ),
					render: function()
					{
						var settings =  ! _.isUndefined( window._wpmejsSettings ) ? _.clone( _wpmejsSettings ) : {};
						MediaItem.prototype.render.apply( this, arguments );
						this.player = new MediaElementPlayer( this.$( 'video' ).get(0), settings );
					}
				} )
			} );
		}
	} );

	function initVideoField() {
		var $this = $( this ),
			view = new VideoField( { input: this } );
		$this.siblings( '.Bestwebsite-media-view' ).remove();
		$this.after( view.el );
	}

	function init( e ) {
		$( e.target ).find( '.Bestwebsite-video' ).each( initVideoField );
	}

	Bestwebsite.$document
		.on( 'mb_ready', init )
		.on( 'clone', '.Bestwebsite-video', initVideoField );
} )( jQuery, Bestwebsite );
