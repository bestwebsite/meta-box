<?php
/**
 * The divider field which displays a simple horizontal line.
 *
 * @package Meta Box
 */

/**
 * Divider field class.
 */
class Bestwebsite_Divider_Field extends Bestwebsite_Field {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_style( 'Bestwebsite-divider', Bestwebsite_CSS_URL . 'divider.css', array(), Bestwebsite_VER );
	}

	/**
	 * Show begin HTML markup for fields.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 *
	 * @return string
	 */
	public static function begin_html( $meta, $field ) {
		$attributes = empty( $field['id'] ) ? '' : " id='{$field['id']}'";
		return "<hr$attributes>";
	}

	/**
	 * Show end HTML markup for fields.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 *
	 * @return string
	 */
	public static function end_html( $meta, $field ) {
		return '';
	}
}
