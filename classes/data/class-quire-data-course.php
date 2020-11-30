<?php


class Quire_Data_Course extends Quire_Data_Abstract implements Quire_Data_Course_Interface {

	protected $title;
	protected $slug;
	protected $content;
	protected $excerpt;
	protected $featured_image;
	protected $sections;
	protected $duration;
	protected $item_count;
	protected $enroll_required;
	protected $passing_condition;
	protected $students;

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
	 * @return mixed
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param mixed $content
	 */
	public function setContent( $content ): void {
		$this->content = $content;
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
	public function getSections() {
		return $this->sections;
	}

	/**
	 * @param mixed $sections
	 */
	public function setSections( $sections ): void {
		$this->sections = $sections;
	}

	/**
	 * @return mixed
	 */
	public function getDuration() {
		return $this->duration;
	}

	/**
	 * @param mixed $duration
	 */
	public function setDuration( $duration ): void {
		$this->duration = $duration;
	}

	/**
	 * @return mixed
	 */
	public function getItemCount() {
		return $this->item_count;
	}

	/**
	 * @param mixed $item_count
	 */
	public function setItemCount( $item_count ): void {
		$this->item_count = $item_count;
	}

	/**
	 * @return mixed
	 */
	public function getEnrollRequired() {
		return $this->enroll_required;
	}

	/**
	 * @param mixed $enroll_required
	 */
	public function setEnrollRequired( $enroll_required ): void {
		$this->enroll_required = $enroll_required;
	}

	/**
	 * @return mixed
	 */
	public function getPassingCondition() {
		return $this->passing_condition;
	}

	/**
	 * @param mixed $passing_condition
	 */
	public function setPassingCondition( $passing_condition ): void {
		$this->passing_condition = $passing_condition;
	}

	/**
	 * @return mixed
	 */
	public function getStudents() {
		return $this->students;
	}

	/**
	 * @param mixed $students
	 */
	public function setStudents( $students ): void {
		$this->students = $students;
	}

}