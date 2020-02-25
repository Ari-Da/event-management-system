<?php 
include_once 'PDO.DB.php';

class Event {
	private $idevent;
	private $name;
	private $datestart;
	private $dateend;
	private $numberallowed;
	private $venue;

	function getIdEvent() {
		return $this->idevent;
	}

	function getName() {
		return $this->name;
	}

	function getDateStart() {
		return $this->datestart;
	}

	function getDateEnd() {
		return $this->dateend;
	}

	function getNumberallowed() {
		return $this->numberallowed;
	}

	function getVenueId() {
		return $this->venue;
	}

	function setIdEvent($id) {
		$this->idevent = $id;
	}

	function setName($name) {
		$this->name = $name;
	}

	function setDateStart($datestart) {
		$this->datestart = $datestart;
	}

	function setDateEnd($dateend) {
		$this->dateend = $dateend;
	}

	function setAllowed($allowed) {
		$this->numberallowed = $allowed;
	}

	function setVenue($venue) {
		$this->venue = $venue;
	}

	function getSessions() {
		try {
			return DB::get('session', array('idsession'=>null, 'name'=>null, 'numberallowed'=>null, 'event'=>$this->idevent, 'startdate'=>null, 'enddate'=>null));
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return array();
		}
	}

	function getVenue() {
		try {
			return DB::get('venue', array('idvenue'=>$this->venue, 'name'=>null, 'capacity'=>null))[0];
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return null;
		}
	}

	function getEvent() {
		try {
			$data = DB::get('event', array('idevent'=>$this->idevent, 'name'=>null, 'datestart'=>null, 'dateend'=>null, 'numberallowed'=>null, 'venue'=>null))[0];
			$this->name = $data->getName();
			$this->datestart = $data->getDateStart();
			$this->dateend = $data->getDateEnd();
			$this->numberallowed = $data->getNumberallowed();
			$this->venue = $data->getVenueId();

			return $data;
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return null;
		}
	}

	function getAllEvents() {
		try {
			return DB::get('event', array('idevent'=>null, 'name'=>null, 'datestart'=>null, 'dateend'=>null,'numberallowed'=>null, 'venue'=>null));
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return array();
		}
	}

	function toArray() {
		$this->datestart = $this->formatDate($this->datestart);
		$this->dateend = $this->formatDate($this->dateend);
		return implode('|', get_object_vars($this));
	}

	private function formatDate($date) {
		return date('M j, Y G:i', strtotime($date));
	}

	function update() {
		try {
			$query = 'UPDATE event SET name = :name, datestart = :datestart, dateend = :dateend, numberallowed = :allowed, venue = :venue WHERE idevent = :id';
			$params = array('name' => $this->name, 'datestart' => date('Y-m-d H:m:s', strtotime($this->datestart)), 'dateend' => date('Y-m-d H:m:s', strtotime($this->dateend)), 'allowed' => $this->numberallowed, 'venue' => $this->venue, 'id' => $this->idevent);
			$updated = DB::set($query, $params);

			return $updated > 0;
		} catch (PDOException $e) {
			return false;
		}
	}

	function delete() {
		try {
			$query = 'DELETE FROM event WHERE idevent = :id';
			$params = array('id'=>$this->idevent);
			$deleted = DB::set($query, $params);

			return $deleted > 0;
		} catch (PDOException $e) {
			return false;
		}
	}
}

?>