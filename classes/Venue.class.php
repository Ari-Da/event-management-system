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

	function setIdVenue($idvenue) {
		$this->idvenue = $idvenue;
	}

	function setName($name) {
		$this->name = $name;
	}

	function setCapacity($capacity) {
		$this->capacity = $capacity;
	}

	function toArray() {
		return implode("|", get_object_vars($this));
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

	function getVenue() {
		try {
			return DB::get('venue', array('idvenue'=>$this->idvenue, 'name'=>null, 'capacity'=>null))[0];
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return array();
		}
	}

	function update() {
		try {
			$query = 'UPDATE venue SET name = :name, capacity = :capacity WHERE idvenue = :id';
			$params = array('name' => $this->name, 'capacity'=>$this->capacity, 'id' => $this->idvenue);
			$updated = DB::set($query, $params, true);

			return $updated > 0;
		} catch (PDOException $e) {
			return false;
		}
	}

	function insert() {
		try {
			$query = 'INSERT INTO venue(name, capacity) VALUES(:name, :capacity)';
			$params = array('name'=>$this->name, 'capacity'=>$this->capacity);
			$inserted = DB::set($query, $params);
			$this->idvenue = $inserted;
			
			return $inserted;
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return 0;
		}
	}

	function delete() {
		try {
			$query = 'DELETE FROM venue WHERE idvenue = :id';
			$params = array('id'=>$this->idvenue);
			$deleted = DB::set($query, $params, true);

			return $deleted > 0;
		} catch (PDOException $e) {
			return false;
		}
	}
}