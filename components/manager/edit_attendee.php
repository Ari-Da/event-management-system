<?php

$event = $_POST['event'];
$attendee = $_POST['attendee'];
$paid = $_POST['paid'];

$attendee_event = new Attendee_event();
$attendee_event->setEvent($event);
$attendee_event->setAttendee($attendee);
$attendee_event->setPaid($paid);

if($attendee_event->update()) {
	header('Location: manage.php?success=update');
}
else {
	header('Location: manage.php?error=update');
}