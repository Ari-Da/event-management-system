<?php
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
}