<?php

include_once 'PDO.DB.php';

class Attendee_event {
	private $event;
	private $attendee;
	private $paid;

	function getEvent() {
		return $this->event;
	}

	function getAttendee() {
		return $this->attendee;
	}

	function getPaid() {
		return $this->paid;
	}

	function setEvent($event) {
		$this->event = $event;
	}

	function setAttendee($attendee) {
		$this->attendee = $attendee;
	}

	function setPaid($paid) {
		$this->paid = $paid;
	}

	function toArray() {
		return implode("|", get_object_vars($this));
	}

	function getAttendeeDetails() {
		try {
			return DB::get('attendee', array('idattendee'=>$this->attendee, 'name'=>null, 'role'=>null))[0];
		} catch (PDOException $e) {
			return null;
		}
	}

	function getAttendees() {
		try {
			return DB::get('attendee_event', array('event'=>$this->event, 'attendee'=>null, 'paid'=>null));
		} catch (PDOException $e) {
			return array();
		}
	}

	function insert() {
		try {
			$query = "INSERT INTO attendee_event(event, attendee, paid) VALUES(:event, :attendee, :paid)";
			$params = array("event"=>$this->event, "attendee"=>$this->attendee, "paid"=>$this->paid);
			$inserted = DB::set($query, $params, true);

			return $inserted > 0;
		} catch (PDOException $e) {
			return false;
		}
	}

	function delete() {
		try {
			$query = "DELETE FROM attendee_event WHERE event = :event AND attendee = :attendee";
			$params = array("event"=>$this->event, "attendee"=>$this->attendee);
			$deleted = DB::set($query, $params, true);

			return $deleted > 0;
		} catch (PDOException $e) {
			return false;
		}
	}

	function deleteAttendee() {
		try {
			$query = "DELETE FROM attendee_event WHERE attendee = :attendee";
			$params = array("attendee"=>$this->attendee);
			$deleted = DB::set($query, $params, true);

			return $deleted > -1;
		} catch (PDOException $e) {
			return false;
		}
	}

	function update() {
		try {
			$query = 'UPDATE attendee_event SET paid = :paid WHERE event = :event AND attendee = :attendee';
			$params = array('paid' => $this->paid, 'event' => $this->event, 'attendee' => $this->attendee);
			$updated = DB::set($query, $params, true);

			return $updated > 0;
		} catch (PDOException $e) {
			return false;
		}
	}
}