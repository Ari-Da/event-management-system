<?php
include_once 'PDO.DB.php';

class Venue {
	private $idvenue;
	private $name;
	private $capacity;

	function getIdVenue() {
		return $this->idvenue;
	}

	function getName() {
		return $this->name;
	}

	function getCapacity() {
		return $this->capacity;
	}

	static function getAllVenues() {
		try {
			return DB::get('venue', array('idvenue'=>null, 'name'=>null, 'capacity'=>null));
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return array();
		}
	}

	static function getMaxCapacity($id) {
		try {
			return DB::get('venue', array('idvenue'=>$id, 'capacity'=>null))[0];
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return array();
		}
	}
}