<script id="tmpl-Bestwebsite-video-item" type="text/html">
	<input type="hidden" name="{{{ data.controller.fieldName }}}" value="{{{ data.id }}}" class="Bestwebsite-media-input">
	<div class="Bestwebsite-media-preview">
		<div class="Bestwebsite-media-content">
			<div class="centered">
				<# if( _.indexOf( i18nBestwebsiteVideo.extensions, data.url.substr( data.url.lastIndexOf('.') + 1 ) ) > -1 ) { #>
				<div class="Bestwebsite-video-wrapper">
					<video controls="controls" class="Bestwebsite-video-element" preload="metadata"
						<# if ( data.width ) { #>width="{{ data.width }}"<# } #>
						<# if ( data.height ) { #>height="{{ data.height }}"<# } #>
						<# if ( data.image && data.image.src !== data.icon ) { #>poster="{{ data.image.src }}"<# } #>>
						<source type="{{ data.mime }}" src="{{ data.url }}"/>
					</video>
				</div>
				<# } else { #>
					<# if ( data.image && data.image.src && data.image.src !== data.icon ) { #>
						<img src="{{ data.image.src }}" />
					<# } else { #>
						<img src="{{ data.icon }}" />
					<# } #>
				<# } #>
			</div>
		</div>
	</div>
	<div class="Bestwebsite-media-info">
		<a href="{{{ data.url }}}" class="Bestwebsite-media-title" target="_blank">
			<# if( data.title ) { #>
				{{{ data.title }}}
			<# } else { #>
				{{{ i18nBestwebsiteMedia.noTitle }}}
			<# } #>
		</a>
		<p class="Bestwebsite-media-name">{{{ data.filename }}}</p>
		<p class="Bestwebsite-media-actions">
			<a class="Bestwebsite-edit-media" title="{{{ i18nBestwebsiteMedia.edit }}}" href="{{{ data.editLink }}}" target="_blank">
				<span class="dashicons dashicons-edit"></span>{{{ i18nBestwebsiteMedia.edit }}}
			</a>
			<a href="#" class="Bestwebsite-remove-media" title="{{{ i18nBestwebsiteMedia.remove }}}">
				<span class="dashicons dashicons-no-alt"></span>{{{ i18nBestwebsiteMedia.remove }}}
			</a>
		</p>
	</div>
</script>
