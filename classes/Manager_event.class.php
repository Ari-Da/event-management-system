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

	static function delete($id) {
		try {
			$query = 'DELETE FROM manager_event WHERE event = :id';
			$params = array('id' => $id);
			$deleted = DB::set($query, $params, true);

			return $deleted > 0;
		} catch (PDOException $e) {
			return false;
		}
	}

	function insert() {
		try {
			$query = 'INSERT INTO manager_event(event, manager) VALUES(:event, :manager)';
			$params = array('event' => $this->event, 'manager' => $this->manager);
			$inserted = DB::set($query, $params, true);

			return $inserted > 0;
		} catch (PDOException $e) {
			return false;
		}
	}
}