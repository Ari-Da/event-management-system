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
		return implode("|", get_object_vars($this));
	}

	private function formatDate($date) {
		return date("M j, Y G:i", strtotime($date));
	}
}

?>