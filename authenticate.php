<?php

$name = trim($_POST['name']);
$pass = trim($_POST['pass']);
$type = intval($_POST['type']);

$attendee = new Attendee();
$attendee->setName($name);
$attendee->setPassword($pass);

if($type == 0 && $attendee->login()) {
	startAttendeeSession($attendee);
	header('Location: ' . HTTP_URL . 'components/events.php');
}
else if($type == 1 && $attendee->insert()) {
	$attendee->setRole(3);
	startAttendeeSession($attendee);
	header('Location: ' . HTTP_URL . 'components/events.php');
}
else {
	header('Location: user.php?' . ($type == 0 ? 'error' : 'duplicate'));
}

