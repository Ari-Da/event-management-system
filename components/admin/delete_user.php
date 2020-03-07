<?php
$params = array('id'=>'int');
$path = 'users.php';

sanitize($params, $path);
validate($params, $path);

// Sanitization and validation complete

$id = intval($_POST['id']);

$attendee = new Attendee();
$attendee->setIdAttendee($id);

if($attendee->get()) {
	if($attendee->delete()) {
		header('Location: ' . $path . '?success=delete');
	}
	else {
		header('Location: ' . $path . ' ?error=delete');
	}
}
else {
	header('Location: ' . $path . '?error=delete');
}
