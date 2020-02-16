<?php

class DB {
	private $db;

	function __construct() {
		try {
			$this->dbh = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}", $_SERVER['DB_USER'], '');
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			die("\nBad database connection");
		}
	}	

	function login($name, $pass) {
		$pass = $this->hashPass($pass);

		include 'classes/Attendee.class.php';

		try {
			$stmt = $this->dbh->prepare("SELECT idattendee, name, role FROM attendee WHERE name = :name AND password = :pass");
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
			$stmt->execute();

			$stmt->setFetchMode(PDO::FETCH_CLASS, "Attendee");

			if($stmt->rowCount() > 0) {
				return $stmt->fetch();
			}

			return null;
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return null;
		}
	}

	function hashPass($pass) {
		return hash('sha256', $pass);
	}
}