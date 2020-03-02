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
		$this->datestart = formatDateForDb($datestart);
	}

	function setDateEnd($dateend) {
		$this->dateend = formatDateForDb($dateend);
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

	function getAttendees() {
		try {
			return DB::get('attendee_event', array('event'=>$this->idevent, 'attendee'=>null, 'paid'=>null));
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
			$params = array('name' => $this->name, 'datestart' => $this->datestart, 'dateend' => $this->dateend, 'allowed' => $this->numberallowed, 'venue' => $this->venue, 'id' => $this->idevent);
			$updated = DB::set($query, $params, true);

			return $updated > 0;
		} catch (PDOException $e) {
			return false;
		}
	}

	function delete() {
		$success = false;

		try {
			if(DB::startTransaction()) {
				$query = 'DELETE FROM event WHERE idevent = :id';
				$params = array('id'=>$this->idevent);
				$deleted = DB::set($query, $params, true);

				if($deleted > 0) {
					// throw new PDOException();
					if(Manager_event::delete($this->idevent)) {
						$success = true;
						DB::commitTransaction();
					}
					else {
						$success = false;
						DB::rollTransaction();
					}
				}
				else {
					$success = false;
					DB::rollTransaction();
				}
			}

			return $success;
		} catch (PDOException $e) {
			DB::rollTransaction();
			return false;
		}
	}

	function insert() {
		try {
			$query = 'INSERT INTO event(name, datestart, dateend, numberallowed, venue) VALUES(:name, :datestart, :dateend, :numberallowed, :venue)';
			$params = array('name'=>$this->name, 'datestart'=>$this->datestart, 'dateend'=>$this->dateend, 'numberallowed'=>$this->numberallowed, 'venue'=>$this->venue);
			$inserted = DB::set($query, $params);
			
			return $inserted;
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return 0;
		}
	}
}

?>