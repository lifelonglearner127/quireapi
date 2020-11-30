<?php


class Quire_Data_Group extends Quire_Data_Abstract implements Quire_Data_Group_Interface {

	protected $slug;
	protected $name;
	protected $date_created;
	protected $excerpt;
	protected $featured_image;

	protected $group_type;
	protected $users;
	protected $courses;

	public function __construct( $ID, $raw = [] ) {
		unset( $raw->guid );
		parent::__construct( $ID, $raw );
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
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName( $name ): void {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getDateCreated() {
		return $this->date_created;
	}

	/**
	 * @param mixed $date_created
	 */
	public function setDateCreated( $date_created ): void {
		$this->date_created = $date_created;
	}

	/**
	 * @return mixed
	 */
	public function getExcerpt() {
		return $this->excerpt;
	}

	/**
	 * @param mixed $excerpt
	 */
	public function setExcerpt( $excerpt ): void {
		$this->excerpt = $excerpt;
	}

	/**
	 * @return mixed
	 */
	public function getFeaturedImage() {
		return $this->featured_image;
	}

	/**
	 * @param mixed $featured_image
	 */
	public function setFeaturedImage( $featured_image ): void {
		$this->featured_image = $featured_image;
	}

	/**
	 * @return mixed
	 */
	public function getGroupType() {
		return $this->group_type;
	}

	/**
	 * @param mixed $group_type
	 */
	public function setGroupType( $group_type ): void {
		$this->group_type = $group_type;
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