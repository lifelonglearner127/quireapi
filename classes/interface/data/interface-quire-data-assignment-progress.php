<?php


interface Quire_Data_Assignment_Progress_Interface extends Quire_Data_Interface {

	public function getUser();

	public function getOrder();

	public function getPercent();

	public function getDueDate();
}