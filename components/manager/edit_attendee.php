<?php
$params = array('event'=>'int', 'attendee'=>'int', 'paid'=>'int');
$path = 'manage.php';

sanitize($params, $path);
validate($params, $path);

// Sanitization and validation complete

$event = $_POST['event'];
$attendee = $_POST['attendee'];
$paid = $_POST['paid'];

$attendee_event = new Attendee_event();
$attendee_event->setEvent($event);
$attendee_event->setAttendee($attendee);
$attendee_event->setPaid($paid);

if($attendee_event->update()) {
	header('Location: ' . $path . '?success=update');
}
else {
	header('Location: ' . $path . '?error=update');
}