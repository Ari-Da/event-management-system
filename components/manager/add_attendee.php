<?php
$params = array('id'=>'int', 'type'=>'str', 'attendee'=>'int');
$path = 'manage.php';

sanitize($params, $path);
validate($params, $path);

// Sanitization and validation complete

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
	header('Location: ' . $path . '?success=insert');
}
else {
	header('Location: ' . $path . '?error=insert');
}
