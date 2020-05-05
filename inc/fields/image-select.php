<?php
/**
 * The image select field which behaves similar to the radio field but uses images as options.
 *
 * @package Meta Box
 */

/**
 * The image select field class.
 */
class Bestwebsite_Image_Select_Field extends Bestwebsite_Field {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_style( 'Bestwebsite-image-select', Bestwebsite_CSS_URL . 'image-select.css', array(), Bestwebsite_VER );
		wp_enqueue_script( 'Bestwebsite-image-select', Bestwebsite_JS_URL . 'image-select.js', array( 'jquery' ), Bestwebsite_VER, true );
	}

	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function html( $meta, $field ) {
		$html = array();
		$tpl  = '<label class="Bestwebsite-image-select"><img src="%s"><input type="%s" class="Bestwebsite-image_select" name="%s" value="%s"%s></label>';

		$meta = (array) $meta;
		foreach ( $field['options'] as $value => $image ) {
			$html[] = sprintf(
				$tpl,
				$image,
				$field['multiple'] ? 'checkbox' : 'radio',
				$field['field_name'],
				$value,
				checked( in_array( $value, $meta ), true, false )
			);
		}

		return implode( ' ', $html );
	}

	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 * @return array
	 */
	public static function normalize( $field ) {
		$field                = parent::normalize( $field );
		$field['field_name'] .= $field['multiple'] ? '[]' : '';

		return $field;
	}

	/**
	 * Format a single value for the helper functions. Sub-fields should overwrite this method if necessary.
	 *
	 * @param array    $field   Field parameters.
	 * @param string   $value   The value.
	 * @param array    $args    Additional arguments. Rarely used. See specific fields for details.
	 * @param int|null $post_id Post ID. null for current post. Optional.
	 *
	 * @return string
	 */
	public static function format_single_value( $field, $value, $args, $post_id ) {
		return $value ? sprintf( '<img src="%s">', esc_url( $field['options'][ $value ] ) ) : '';
	}
}