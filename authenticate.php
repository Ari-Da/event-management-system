<?php

$name = trim($_POST['name']);
$pass = trim($_POST['pass']);
$type = intval($_POST['type']);

$attendee = new Attendee();
$attendee->setName($name);
$attendee->setPassword($pass);

if($type == 0 && $attendee->login()) {
	startAttendeeSession($attendee);

	if($attendee->getRole() == 3) {
		header('Location: components/attendee/events.php');
	}
	else if($attendee->getRole() == 2) {

	}
	else if($attendee->getRole() == 1) {
		
	}
}
else if($type == 1 && $attendee->insert()) {
	$attendee->setRole(3);
	startAttendeeSession($attendee);
	header('Location: events.php');
}
else {
	header('Location: user.php?' . ($type == 0 ? 'error' : 'duplicate'));
}

function startAttendeeSession($a) {
	session_regenerate_id();
	$_SESSION['user']['id'] = $a->getIdAttendee();
	$_SESSION['user']['name'] = $a->getName();
	$_SESSION['user']['role'] = $a->getRole();
}