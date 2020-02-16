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
			// $stmt = DB::init()->prepare("SELECT idattendee, name, role FROM attendee WHERE name = :name AND password = :pass");
			// $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
			// $stmt->bindParam(':pass', $this->password, PDO::PARAM_STR);
			// $stmt->execute();

			// $stmt->setFetchMode(PDO::FETCH_CLASS, "Attendee");

			// if($stmt->rowCount() > 0) {
			// 	return true;
			// }

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
