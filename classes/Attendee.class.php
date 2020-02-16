<?php

class Attendee {
	private $idattendee;
	private $name;
	private $role;

	public function getIdAttend() {
		return $this->idattendee;
	}

	public function getName() {
		return $this->name;
	}

	public function getRole() {
		return $this->role;
	}

	public function authenticate($name, $password) {
		if($name == $this->name && $password == $this->password) {
			return true;
		}

		return false;
	}
}