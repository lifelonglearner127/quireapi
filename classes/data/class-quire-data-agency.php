<?php


class Quire_Data_Agency extends Quire_Data_Abstract implements Quire_Data_Agency_Interface {

	protected $title;
	protected $slug;

	protected bool $active;
	protected $subscription;
	protected $administrators;
	protected $groups;
	protected $caregivers;
	protected $users;
	protected $orders;

	public function __construct( $ID, $raw = [] ) {
		parent::__construct( $ID, $raw );
	}

	/**
	 * @return mixed
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param mixed $title
	 */
	public function setTitle( $title ): void {
		$this->title = $title;
	}

	/**
	 * @return mixed
	 */
	public function getSlug() {
		return $this->slug;
	}

	/**
	 * @param mixed $slug
	 */
	public function setSlug( $slug ): void {
		$this->slug = $slug;
	}

	/**
	 * @return bool
	 */
	public function isActive(): bool {
		return $this->active;
	}

	/**
	 * @param bool $active
	 */
	public function setActive( bool $active ): void {
		$this->active = $active;
	}

	/**
	 * @return mixed
	 */
	public function getSubscription() {
		return $this->subscription;
	}

	/**
	 * @param mixed $subscription
	 */
	public function setSubscription( $subscription ): void {
		$this->subscription = $subscription;
	}

	/**
	 * @return mixed
	 */
	public function getAdministrators() {
		return $this->administrators;
	}

	/**
	 * @param mixed $administrators
	 */
	public function setAdministrators( $administrators ): void {
		$this->administrators = $administrators;
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

	/**
	 * @return mixed
	 */
	public function getCaregivers() {
		return $this->caregivers;
	}

	/**
	 * @param mixed $caregivers
	 */
	public function setCaregivers( $caregivers ): void {
		$this->caregivers = $caregivers;
	}

	/**
	 * @return mixed
	 */
	public function getUsers() {
		return $this->users;
	}

	/**
	 * @param mixed $users
	 */
	public function setUsers( $users ): void {
		$this->users = $users;
	}

	/**
	 * @return mixed
	 */
	public function getOrders() {
		return $this->orders;
	}

	/**
	 * @param mixed $orders
	 */
	public function setOrders( $orders ): void {
		$this->orders = $orders;
	}

}