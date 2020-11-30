<?php


class Quire_Data_Assignment_Progress extends Quire_Data_Abstract implements Quire_Data_Assignment_Progress_Interface {

	protected $order;
	protected $percent;
	protected $due_date;
	protected $user;

	public function __construct( $ID, $raw = [] ) {
		parent::__construct( $ID, $raw );
	}

	public function getUser() {
		// TODO: Implement getUser() method.
		return $this->user;
	}

	/**
	 * @param mixed $user
	 */
	public function setUser( $user ): void {
		$this->user = $user;
	}

	public function getOrder() {
		// TODO: Implement getOrder() method.
		return $this->order;
	}

	/**
	 * @param mixed $order
	 */
	public function setOrder( $order ): void {
		$this->order = $order;
	}

	public function getPercent() {
		// TODO: Implement getPercent() method.
		return $this->percent;
	}

	/**
	 * @param mixed $percent
	 */
	public function setPercent( $percent ): void {
		$this->percent = $percent;
	}

	public function getDueDate() {
		// TODO: Implement getDueDate() method.
		return $this->due_date;
	}

	/**
	 * @param mixed $due_date
	 */
	public function setDueDate( $due_date ): void {
		$this->due_date = $due_date;
	}
}