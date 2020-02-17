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

	function toArray() {
		$this->startdate = $this->formatDate($this->startdate);
		$this->enddate = $this->formatDate($this->enddate);
		return implode("|", get_object_vars($this));
	}

	private function formatDate($date) {
		return date("M j, Y G:i", strtotime($date));
	}
}