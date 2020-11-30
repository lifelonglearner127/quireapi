<?php


class Quire_Data_User extends Quire_Data_Abstract implements Quire_Data_User_Interface {

	protected $first_name;
	protected $last_name;
	protected $display_name;
	protected $user_email;
	protected $username;
	protected $phone_number;
	protected $avatar_url;
	protected $roles;

	protected $agency;
	protected $groups;

	public function __construct( $ID, $raw = [] ) {
		unset( $raw->user_pass );
		parent::__construct( $ID, $raw );
	}

	public function get_meta( string $key, bool $single = false ) {
		if ( ! $this->ID ) {
			return false;
		}

		return get_user_meta( $this->ID, $key, $single );
	}

	public function add_meta( string $key, $value, $u = false ) {
		if ( ! $this->ID ) {
			return false;
		}

		return add_user_meta( $this->ID, $key, $value, $u );
	}

	public function update_meta( string $key, $value, $prev = '' ) {
		if ( ! $this->ID ) {
			return false;
		}

		return update_user_meta( $this->ID, $key, $value, $prev );
	}

	public function update_multi_meta( string $key, $values ) {
		if ( ! $this->ID ) {
			return false;
		}
		/** @var Quire_Data_Caregiver $caregiver */
		$old_values = $this->get_meta( $key );

		$add_values = array_diff( $values, $old_values );
		$del_values = array_diff( $old_values, $values );

		foreach ( $del_values as $value ) {
			delete_user_meta( $this->ID, $key, $value );
		}

		foreach ( $add_values as $value ) {
			$this->add_meta( $key, $value );
		}

		return true;
	}

	/**
	 * @return mixed
	 */
	public function getFirstName() {
		return $this->first_name;
	}

	/**
	 * @param mixed $first_name
	 */
	public function setFirstName( $first_name ): void {
		$this->first_name = $first_name;
	}

	/**
	 * @return mixed
	 */
	public function getLastName() {
		return $this->last_name;
	}

	/**
	 * @param mixed $last_name
	 */
	public function setLastName( $last_name ): void {
		$this->last_name = $last_name;
	}

	/**
	 * @return mixed
	 */
	public function getDisplayName() {
		return $this->display_name;
	}

	/**
	 * @param mixed $display_name
	 */
	public function setDisplayName( $display_name ): void {
		$this->display_name = $display_name;
	}

	/**
	 * @return mixed
	 */
	public function getUserEmail() {
		return $this->user_email;
	}

	/**
	 * @param mixed $user_email
	 */
	public function setUserEmail( $user_email ): void {
		$this->user_email = $user_email;
	}

	/**
	 * @return mixed
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @param mixed $username
	 */
	public function setUsername( $username ): void {
		$this->username = $username;
	}

	/**
	 * @return mixed
	 */
	public function getPhoneNumber() {
		return $this->phone_number;
	}

	/**
	 * @param mixed $phone_number
	 */
	public function setPhoneNumber( $phone_number ): void {
		$this->phone_number = $phone_number;
	}

	/**
	 * @return mixed
	 */
	public function getAvatarUrl() {
		return $this->avatar_url;
	}

	/**
	 * @param mixed $avatar_url
	 */
	public function setAvatarUrl( $avatar_url ): void {
		$this->avatar_url = $avatar_url;
	}

	/**
	 * @return mixed
	 */
	public function getAgency() {
		return $this->agency;
	}

	/**
	 * @param mixed $agency
	 */
	public function setAgency( $agency ): void {
		$this->agency = $agency;
	}

	/**
	 * @return mixed
	 */
	public function getGroups() {
		return $this->groups;
	}

	/**
	 * @param mixed $groups
	 */
	public function setGroups( $groups ): void {
		$this->groups = $groups;
	}

	public function hasRole( $role ) {
		// TODO: Implement hasRole() method.
		$roles = $this->getRoles();

		return is_array( $roles ) && in_array( $role, $roles );
	}

	/**
	 * @return mixed
	 */
	public function getRoles() {
		return $this->roles;
	}

	/**
	 * @param mixed $roles
	 */
	public function setRoles( $roles ): void {
		$this->roles = $roles;
	}
}