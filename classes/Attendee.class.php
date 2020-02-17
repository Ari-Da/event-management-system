<?php
include_once 'PDO.DB.php';

class Attendee {
	private $idattendee;
	private $name;
	private $password;
	private $role;

	function getIdAttend() {
		return $this->idattendee;
	}

	function getName() {
		return $this->name;
	}

	function getRole() {
		return $this->role;
	}

	function setName($name) {
		$this->name = $name;
	}

	function setPassword($password) {
		$this->password = $this->hashPassword($password);
	}

	function login() {
		try {
			$data = DB::get('attendee', array('idattendee'=>null, 'name'=>$this->name, 'password'=>$this->password,'role'=>null));

			return count($data) > 0;
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return false;
		}
	}

	private function hashPassword($pass) {
		return hash('sha256', $pass);
	}
}
