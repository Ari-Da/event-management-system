<?php
include_once 'PDO.DB.php';

class Session {
	private $idsession;
	private $name;
	private $numberallowed;
	private $event;
	private $startdate;
	private $enddate;

	function getIdSession() {
		return $this->idsession;
	}

	function getName() {
		return $this->name;
	}

	function getNumberallowed() {
		return $this->numberallowed;
	}

	function getEvent() {
		return $this->event;
	}

	function getStartdate() {
		return $this->startdate;
	}

	function getEnddate() {
		return $this->enddate;
	}

	function setIdSession($idsession) {
		$this->idsession = $idsession;
	}

	function setName($name) {
		$this->name = $name;
	}

	function setAllowed($allowed) {
		$this->numberallowed = $allowed;
	}

	function setDateStart($startdate) {
		$this->startdate = formatDateForDb($startdate);
	}

	function setDateEnd($enddate) {
		$this->enddate = formatDateForDb($enddate);
	}

	function setEvent($event) {
		$this->event = $event;
	}

	function toArray() {
		$this->startdate = formatDateForView($this->startdate);
		$this->enddate = formatDateForView($this->enddate);
		return implode("|", get_object_vars($this));
	}

	function delete() {
		try {
			$query = 'DELETE FROM session WHERE idsession = :id';
			$params = array('id'=>$this->idsession);
			$deleted = DB::set($query, $params, true);

			return $deleted > 0;
		} catch (PDOException $e) {
			return false;
		}
	}

	function update() {
		try {
			$query = 'UPDATE session SET name = :name, startdate = :startdate, enddate = :enddate, numberallowed = :allowed, event = :event WHERE idsession = :id';
			$params = array('name' => $this->name, 'startdate'=>$this->startdate, 'enddate'=>$this->enddate, 'allowed' => $this->numberallowed, 'event' => $this->event, 'id' => $this->idsession);
			$updated = DB::set($query, $params, true);

			return $updated > 0;
		} catch (PDOException $e) {
			return false;
		}
	}

	function insert() {
		try {
			$query = 'INSERT INTO session(name, numberallowed, event, startdate, enddate) VALUES(:name, :numberallowed, :event, :startdate, :enddate)';
			$params = array('name'=>$this->name, 'startdate'=>$this->startdate, 'enddate'=>$this->enddate, 'numberallowed'=>$this->numberallowed, 'event'=>$this->event);
			$inserted = DB::set($query, $params);
			
			return $inserted;
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return 0;
		}
	}

}