<?php 
include_once 'PDO.DB.php';

class Event {
	private $idevent;
	private $name;
	private $datestart;
	private $dateend;
	private $numberallowed;
	private $venue;

	function getIdEvent() {
		return $this->idevent;
	}

	function getName() {
		return $this->name;
	}

	function getDateStart() {
		return $this->datestart;
	}

	function getDateEnd() {
		return $this->dateend;
	}

	function getNumberallowed() {
		return $this->numberallowed;
	}

	function getSessions() {
		include_once 'classes/Session.class.php';
		$sessions = array();

		try {
			$stmt = DB::init()->prepare("SELECT idsession, name, numberallowed, event, startdate, enddate FROM session WHERE event = :id");
			$stmt->bindParam(':id', $this->idevent, PDO::PARAM_INT);
			$stmt->execute();

			$stmt->setFetchMode(PDO::FETCH_CLASS, "Session");

			while($session = $stmt->fetch()) {
				$sessions[] = $session;
			}

			return $sessions;
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return array();
		}
	}

	function getVenue() {
		include_once 'classes/Venue.class.php';

		try {
			$stmt = DB::init()->prepare("SELECT idvenue, name, capacity FROM venue WHERE idvenue = :id");
			$stmt->bindParam(':id', $this->venue, PDO::PARAM_INT);
			$stmt->execute();

			$stmt->setFetchMode(PDO::FETCH_CLASS, "Venue");

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

	function getAllEvents() {
		include_once 'classes/Event.class.php';
		$events = array();

		try {
			$events = DB::get('event', array('idevent'=>null, 'name'=>null, 'datestart'=>null, 'dateend'=>null,'numberallowed'=>null, 'venue'=>null));
			// $stmt = DB::init()->prepare("SELECT idevent, name, datestart, dateend, numberallowed, venue FROM event");
			// $stmt->execute();

			// $stmt->setFetchMode(PDO::FETCH_CLASS, "Event");

			// while($event = $stmt->fetch()) {
			// 	$events[] = $event;
			// }

			return $events;
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return array();
		}
	}
}

?>