<?php 

include_once 'PDO.DB.php';

class Manager_event {
	private $event;
	private $manager;

	function getEvent() {
		return $this->event;
	}

	function getManager() {
		return $this->manager;
	}

	function setEvent($event) {
		$this->event = $event;
	}

	function setManager($manager) {
		$this->manager = $manager;
	}

	function toArray() {
		return get_object_vars($this);
	}

	function getEvents() {
		try {
			return DB::get('manager_event', array('event'=>null, 'manager'=>$this->manager));
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return array();
		}
	}
}