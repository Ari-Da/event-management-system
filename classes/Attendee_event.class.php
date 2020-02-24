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
		return get_object_vars($this);
	}

	function insert() {
		try {
			$query = "INSERT INTO attendee_event(event, attendee, paid) VALUES(:event, :attendee, :paid)";
			$params = array("event"=>$this->event, "attendee"=>$this->attendee, "paid"=>$this->paid);
			$inserted = DB::set($query, $params);

			return $inserted > 0;
		} catch (PDOException $e) {
			return false;
		}
	}

	function delete() {
		try {
			$query = "DELETE FROM attendee_event WHERE event = :event AND attendee = :attendee";
			$params = array("event"=>$this->event, "attendee"=>$this->attendee);
			$deleted = DB::set($query, $params);

			return $deleted > 0;
		} catch (PDOException $e) {
			return false;
		}
	}
}