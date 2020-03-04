<?php

include_once 'PDO.DB.php';

class Attendee_session {
	private $session;
	private $attendee;

	function getSession() {
		return $this->session;
	}

	function getAttendee() {
		return $this->attendee;
	}

	function setSession($session) {
		$this->session = $session;
	}

	function setAttendee($attendee) {
		$this->attendee = $attendee;
	}

	function toArray() {
		return get_object_vars($this);
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
			return DB::get('attendee_session', array('session'=>$this->session, 'attendee'=>null));
		} catch (PDOException $e) {
			return array();
		}
	}

	function insert() {
		try {
			$query = "INSERT INTO attendee_session(session, attendee) VALUES(:session, :attendee)";
			$params = array("session"=>$this->session, "attendee"=>$this->attendee);
			$inserted = DB::set($query, $params, true);

			return $inserted > 0;
		} catch (PDOException $e) {
			return false;
		}
	}

	function delete() {
		try {
			$query = "DELETE FROM attendee_session WHERE session = :session AND attendee = :attendee";
			$params = array("session"=>$this->session, "attendee"=>$this->attendee);
			$deleted = DB::set($query, $params, true);

			return $deleted > 0;
		} catch (PDOException $e) {
			return false;
		}
	}
}