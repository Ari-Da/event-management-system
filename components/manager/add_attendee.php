<?php

$id = $_POST['id'];
$type = $_POST['type'];
$attendee = $_POST['attendee'];

if($type == 'event') {
	$paid = $_POST['paid'];

	$obj = new Attendee_event();
	$obj->setEvent($id);
	$obj->setAttendee($attendee);
	$obj->setPaid($paid);
}
else if($type == 'session') {
	$obj = new Attendee_session();
	$obj->setSession($id);
	$obj->setAttendee($attendee);
}

if($obj->insert()) {
	header('Location: manage.php?success=insert');
}
else {
	header('Location: manage.php?error=insert');
}
