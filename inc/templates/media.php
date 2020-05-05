<script id="tmpl-Bestwebsite-media-item" type="text/html">
	<input type="hidden" name="{{{ data.controller.fieldName }}}" value="{{{ data.id }}}" class="Bestwebsite-media-input">
	<div class="Bestwebsite-media-preview attachment-preview">
		<div class="Bestwebsite-media-content thumbnail">
			<div class="centered">
				<# if ( 'image' === data.type && data.sizes ) { #>
					<# if ( data.sizes.thumbnail ) { #>
						<img src="{{{ data.sizes.thumbnail.url }}}">
					<# } else { #>
						<img src="{{{ data.sizes.full.url }}}">
					<# } #>
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

<script id="tmpl-Bestwebsite-media-status" type="text/html">
	<# if ( data.maxFiles > 0 ) { #>
		{{{ data.length }}}/{{{ data.maxFiles }}}
		<# if ( 1 < data.maxFiles ) { #>{{{ i18nBestwebsiteMedia.multiple }}}<# } else {#>{{{ i18nBestwebsiteMedia.single }}}<# } #>
	<# } #>
</script>

<script id="tmpl-Bestwebsite-media-button" type="text/html">
	<a class="button">{{{ data.text }}}</a>
</script>
