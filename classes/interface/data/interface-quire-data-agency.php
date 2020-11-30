<?php


interface Quire_Data_Agency_Interface extends Quire_Data_Interface {

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
	public function isActive();

	/**
	 * @return mixed
	 */
	public function getSubscription();

	/**
	 * @return mixed
	 */
	public function getAdministrators();

	/**
	 * @return mixed
	 */
	public function getGroups();

	/**
	 * @return mixed
	 */
	public function getCaregivers();

	/**
	 * @return mixed
	 */
	public function getUsers();

	/**
	 * @return mixed
	 */
	public function getOrders();
}