<?php

$name = trim($_POST['name']);
$pass = trim($_POST['pass']);
$type = intval($_POST['type']);

$attendee = new Attendee();
$attendee->setName($name);
$attendee->setPassword($pass);

$success = false;

if($type == 0) {
	$success = $attendee->login();
}
else if($type == 1) {
	$success = ($attendee->insert() > 0);
}

if($success) {
	startAttendeeSession($attendee);
	header('Location: ' . HTTP_URL . 'components/attendee/events.php');
}
else {
	header('Location: user.php?' . ($type == 0 ? 'error' : 'duplicate'));
}


