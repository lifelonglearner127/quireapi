<?php


interface Quire_Data_User_Interface extends Quire_Data_Interface {

	public function getFirstName();

	public function getLastName();

	public function getDisplayName();

	public function getUserEmail();

	public function getUsername();

	public function getPhoneNumber();

	public function getAvatarUrl();

	public function getRoles();

	public function getAgency();

	public function getGroups();

	public function hasRole( $role );
}