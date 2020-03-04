<?php
include_once 'PDO.DB.php';

class Attendee {
	private $idattendee;
	private $name;
	private $password;
	private $role;

	function getIdAttendee() {
		return $this->idattendee;
	}

	function getName() {
		return $this->name;
	}

	function getRole() {
		return $this->role;
	}

	function setIdAttendee($idattendee) {
		$this->idattendee = $idattendee;
	}

	function setName($name) {
		$this->name = $name;
	}

	function setPassword($password) {
		$this->password = $this->hashPassword($password);
	}

	function setRole($role) {
		$this->role = $role;
	}

	function login() {
		$success = false;

		try {
			$data = DB::get('attendee', array('idattendee'=>null, 'name'=>$this->name, 'password'=>$this->password,'role'=>null));

			if(count($data) > 0) {
				$success = true;
				$this->idattendee = $data[0]->getIdAttendee();
				$this->name = $data[0]->getName();
				$this->role = $data[0]->getRole();
			}

			return $success;
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return false;
		}
	}

	private function hashPassword($pass) {
		return hash('sha256', $pass);
	}

	function toArray() {
		return implode("|", get_object_vars($this));
	}

	function getEvents() {
		try {
			return DB::get('attendee_event', array('event'=>null, 'attendee'=>$this->idattendee, 'paid'=>null));
		} catch (PDOException $e) {
			echo $e->getMessage();
			return array();
		}
	}

	function getSessions() {
		try {
			return DB::get('attendee_session', array('session'=>null, 'attendee'=>$this->idattendee));
		} catch (PDOException $e) {
			echo $e->getMessage();
			return array();
		}
	}

	static function getAllAttendees() {
		try {
			return DB::get('attendee', array('idattendee'=>null, 'name'=>null, 'role'=>3));
		} catch (PDOException $e) {
			echo $e->getMessage();
			return array();
		}
	}

	function insert($attendee=true) {
		if($attendee) {
			$this->role = 3;
		}

		try {
			$query = "INSERT INTO attendee(name, password, role) VALUES(:name, :pass, :role)";
			$params = array("name"=>$this->name, "pass"=>$this->password, "role"=>$this->role);
			$newId = DB::set($query, $params);
			$this->idattendee = $newId;

			return $newId;
		} catch (PDOException $e) {
			return 0;
		}
	}
}
