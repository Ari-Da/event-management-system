<?php
$params = array('attendee'=>'int', 'event'=>'int', 'type'=>'str');
$path = 'manage.php';

sanitize($params, $path, true);
validate($params, $path, true);

// Sanitization and validation complete

$attendee = $_GET['attendee'];
$id = intval($_GET['event']);
$type = $_GET['type'];

if($type == 'event') {
	$obj = new Attendee_event();
	$obj->setEvent($id);
	$obj->setAttendee($attendee);
}
else if($type == 'session') {
	$obj = new Attendee_session();
	$obj->setSession($id);
	$obj->setAttendee($attendee);
}

if($obj != null && $obj->delete()) {
	header('Location: ' . $path . '?success=delete');
}
else {
	header('Location: ' . $path . '?error=delete');
}