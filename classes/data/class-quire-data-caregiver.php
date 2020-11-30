<?php


class Quire_Data_Caregiver extends Quire_Data_User {

	protected $assignments;
	protected $courses;

	public function __construct( $ID, $raw = [] ) {
		parent::__construct( $ID, $raw );
	}

	/**
	 * @return mixed
	 */
	public function getAssignments() {
		return $this->assignments;
	}

	/**
	 * @param mixed $assignments
	 */
	public function setAssignments( $assignments ): void {
		$this->assignments = $assignments;
	}

	/**
	 * @return mixed
	 */
	public function getCourses() {
		return $this->courses;
	}

	/**
	 * @param mixed $courses
	 */
	public function setCourses( $courses ): void {
		$this->courses = $courses;
	}


}