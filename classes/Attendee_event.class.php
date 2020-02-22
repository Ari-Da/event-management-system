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

	function toArray() {
		return get_object_vars($this);
	}
}