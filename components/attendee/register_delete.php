<?php 
$params = array('id'=>'int', 'type'=>'str', 'paid'=>'int');
$path = 'events.php';

sanitize($params, $path);
validate($params, $path);

// Sanitization and validation complete

$registered = intval($_POST['submitBtn']);
$type = $_POST['type'];

if($type == 'event') {
	$obj = new Attendee_event();
	$obj->setEvent($_POST['id']);
	$obj->setAttendee($_SESSION['user']['id']);
	$obj->setPaid($_POST['paid']);
}
else if($type == 'session') {
	$obj = new Attendee_session();
	$obj->setSession($_POST['id']);
	$obj->setAttendee($_SESSION['user']['id']);
}

if($registered == 1 && $obj->insert()) {
	header('Location: events.php?success=insert');
}
else if($registered == 0 && $obj->delete()) {
	header('Location: ' . $path . '?success=delete');
}
else {
	header('Location: ' . $path . '?error');
}