<?php
/**
 * The input list field which displays choices in a list of inputs.
 *
 * @package Meta Box
 */

/**
 * Input list field class.
 */
class Bestwebsite_Input_List_Field extends Bestwebsite_Choice_Field {
	/**
	 * Enqueue scripts and styles
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_style( 'Bestwebsite-input-list', Bestwebsite_CSS_URL . 'input-list.css', array(), Bestwebsite_VER );
		wp_enqueue_script( 'Bestwebsite-input-list', Bestwebsite_JS_URL . 'input-list.js', array(), Bestwebsite_VER, true );
	}

	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function html( $meta, $field ) {
		$options = self::transform_options( $field['options'] );
		$walker  = new Bestwebsite_Walker_Input_List( $field, $meta );
		$output  = self::get_select_all_html( $field );
		$output .= sprintf(
			'<ul class="Bestwebsite-input-list%s%s">',
			$field['collapse'] ? ' Bestwebsite-collapse' : '',
			$field['inline'] ? ' Bestwebsite-inline' : ''
		);
		$output .= $walker->walk( $options, $field['flatten'] ? -1 : 0 );
		$output .= '</ul>';

		return $output;
	}

	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 * @return array
	 */
	public static function normalize( $field ) {
		$field = $field['multiple'] ? Bestwebsite_Multiple_Values_Field::normalize( $field ) : $field;
		$field = Bestwebsite_Input_Field::normalize( $field );
		$field = parent::normalize( $field );
		$field = wp_parse_args(
			$field,
			array(
				'collapse'        => true,
				'inline'          => null,
				'select_all_none' => false,
			)
		);

		$field['flatten'] = $field['multiple'] ? $field['flatten'] : true;
		$field['inline']  = ! $field['multiple'] && ! isset( $field['inline'] ) ? true : $field['inline'];

		return $field;
	}

	/**
	 * Get the attributes for a field.
	 *
	 * @param array $field Field parameters.
	 * @param mixed $value Meta value.
	 *
	 * @return array
	 */
	public static function get_attributes( $field, $value = null ) {
		$attributes          = Bestwebsite_Input_Field::get_attributes( $field, $value );
		$attributes['id']    = false;
		$attributes['type']  = $field['multiple'] ? 'checkbox' : 'radio';
		$attributes['value'] = $value;

		return $attributes;
	}

	/**
	 * Get html for select all|none for multiple checkbox.
	 *
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function get_select_all_html( $field ) {
		if ( $field['multiple'] && $field['select_all_none'] ) {
			return sprintf( '<p class="Bestwebsite-toggle-all-wrapper"><button class="Bestwebsite-input-list-select-all-none button" data-name="%s">%s</button></p>', $field['id'], __( 'Toggle All', 'meta-box' ) );
		}
		return '';
	}
}
