<?php


interface Quire_Data_Group_Interface extends Quire_Data_Interface {

	/**
	 * @return mixed
	 */
	public function getSlug();

	/**
	 * @return mixed
	 */
	public function getName();

	/**
	 * @return mixed
	 */
	public function getDateCreated();

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
	public function getGroupType();

	/**
	 * @return mixed
	 */
	public function getUsers();

	/**
	 * @return mixed
	 */
	public function getCourses();
}