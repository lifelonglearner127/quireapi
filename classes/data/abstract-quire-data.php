<?php


abstract class Quire_Data_Abstract implements JsonSerializable {

	protected $raw;

	protected $ID;

	protected array $data = array();

	/**
	 * Quire_Data_Abstract constructor.
	 *
	 * @param $raw
	 * @param $ID
	 * @param array $data
	 */
	public function __construct( $ID, $raw = [], array $data = [] ) {
		$this->ID   = absint( $ID );
		$this->raw  = $raw;
		$this->data = $data;
	}


	/**
	 * @return mixed
	 */
	public function getID() {
		return $this->ID;
	}

	/**
	 * @param mixed $ID
	 */
	public function setID( $ID ): void {
		$this->ID = $ID;
	}

	/**
	 * @param string $field
	 *
	 * @return mixed
	 */
	public function getRaw( $field = '' ) {
		return empty( $field ) ? $this->raw : $this->raw->$field;
	}

	/**
	 * @param mixed $raw
	 * @param string $field
	 */
	public function setRaw( $raw, $field = '' ): void {
		if ( empty( $field ) ) {
			$this->raw = $raw;
		} else {
			$this->raw->$field = $raw;
		}
	}

	public function __get( $name ) {
		// TODO: Implement __get() method.
		return $this->data[ $name ];
	}

	public function __set( $name, $value ) {
		// TODO: Implement __set() method.
		$this->data[ $name ] = $value;
	}

	public function __isset( $name ) {
		// TODO: Implement __isset() method.
		return isset( $this->data[ $name ] );
	}

	public function __unset( $name ) {
		// TODO: Implement __unset() method.
		unset( $this->data[ $name ] );
	}

	public function get_meta( string $key, bool $single = false ) {
		if ( ! $this->ID ) {
			return false;
		}

		return get_post_meta( $this->ID, $key, $single );
	}

	public function add_meta( string $key, $value, $u = false ) {
		if ( ! $this->ID ) {
			return false;
		}

		return add_post_meta( $this->ID, $key, $value, $u );
	}

	public function update_meta( string $key, $value, $prev = '' ) {
		if ( ! $this->ID ) {
			return false;
		}

		return update_post_meta( $this->ID, $key, $value, $prev );
	}

	public function update_multi_meta( string $key, $values ) {
		if ( ! $this->ID ) {
			return false;
		}

		$values = array_unique($values);
		/** @var Quire_Data_Caregiver $caregiver */
		$old_values = $this->get_meta( $key );

		$add_values = array_diff( $values, $old_values );
		$del_values = array_diff( $old_values, $values );

		foreach ( $del_values as $value ) {
			delete_post_meta( $this->ID, $key, $value );
		}

		foreach ( $add_values as $value ) {
			$this->add_meta( $key, $value );
		}

		return true;
	}

	public function jsonSerialize() {
		$vars = get_object_vars( $this );
		$vars = array_merge( $vars['data'], $vars );
		unset( $vars['data'] );
		unset( $vars['raw'] );

		return $vars;
	}
}