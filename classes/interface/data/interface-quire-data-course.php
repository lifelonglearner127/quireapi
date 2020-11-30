<?php


interface Quire_Data_Course_Interface extends Quire_Data_Interface {

	/**
	 * @return mixed
	 */
	public function getTitle();

	/**
	 * @return mixed
	 */
	public function getSlug();

	/**
	 * @return mixed
	 */
	public function getContent();

	/**
	 * @return mixed
	 */
	public function getExcerpt();

	/**
	 * @return mixed
	 */
	public function getFeaturedImage();

	/**
	 * @return mixed
	 */
	public function getSections();

	/**
	 * @return mixed
	 */
	public function getDuration();

	/**
	 * @return mixed
	 */
	public function getItemCount();

	/**
	 * @return mixed
	 */
	public function getEnrollRequired();

	/**
	 * @return mixed
	 */
	public function getPassingCondition();

	/**
	 * @return mixed
	 */
	public function getStudents();
}