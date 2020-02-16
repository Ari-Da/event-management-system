<?php

class Venue {
	private $idvenue;
	private $name;
	private $capacity;

	function getIdVenue() {
		return $this->idvenue;
	}

	function getName() {
		return $this->name;
	}

	function getCapacity() {
		return $this->capacity;
	}
}