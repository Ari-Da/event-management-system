<?php
include_once 'PDO.DB.php';

class Role {
	private $idrole;
	private $name;

	function getIdRole() {
		return $this->idrole;
	}

	function getName() {
		return $this->name;
	}

	function setIdRole($idrole) {
		$this->idrole = $idrole;
	}

	function setName($name) {
		$this->name = $name;
	}

	function toArray() {
		return implode("|", get_object_vars($this));
	}

	function getRole() {
		try {
			$role = DB::get('role', array('idrole'=>$this->idrole, 'name'=>null))[0];
			$this->name = $role->getName();

			return true;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}

	static function getAllRoles() {
		try {
			return DB::get('role', array('idrole'=>null, 'name'=>null));
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return array();
		}
	}
}