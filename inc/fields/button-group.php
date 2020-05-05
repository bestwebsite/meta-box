<?php
/**
 * The Button group.
 *
 * @package Meta Box
 */

/**
 * Button group class.
 */
class Bestwebsite_Button_Group_Field extends Bestwebsite_Choice_Field {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_style( 'Bestwebsite-button-group', Bestwebsite_CSS_URL . 'button-group.css', '', Bestwebsite_VER );
		wp_enqueue_script( 'Bestwebsite-button-group', Bestwebsite_JS_URL . 'button-group.js', array(), Bestwebsite_VER, true );
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

		$output  = sprintf(
			'<ul class="Bestwebsite-button-input-list %s">',
			$field['inline'] ? ' Bestwebsite-inline' : ''
		);
		$output .= $walker->walk( $options, -1 );
		$output .= '</ul>';

		return $output;
	}

	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 *
	 * @return array
	 */
	public static function normalize( $field ) {
		$field = parent::normalize( $field );
		$field = wp_parse_args(
			$field,
			array(
				'inline' => null,
			)
		);

		$field = $field['multiple'] ? Bestwebsite_Multiple_Values_Field::normalize( $field ) : $field;
		$field = Bestwebsite_Input_Field::normalize( $field );

		$field['flatten'] = true;
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
}
