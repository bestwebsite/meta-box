<?php
/**
 * The radio field.
 *
 * @package Meta Box
 */

/**
 * Radio field class.
 */
class Bestwebsite_Radio_Field extends Bestwebsite_Input_List_Field {
	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 * @return array
	 */
	public static function normalize( $field ) {
		$field['multiple'] = false;
		$field             = parent::normalize( $field );

		return $field;
	}
}
