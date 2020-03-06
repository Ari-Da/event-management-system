<?php

$id = intval($_POST['id']);

$attendee = new Attendee();
$attendee->setIdAttendee($id);

if($attendee->get()) {
	if($attendee->delete()) {
		header('Location: users.php?success=delete');
	}
	else {
		header('Location: users.php?error=delete');
	}
}
else {
	header('Location: users.php?error=delete');
}
