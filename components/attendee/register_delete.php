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

$url_params = '';

if($obj->insert()) {
	switch($registered) {
		case 1: $url_params = '?error=register';
		case 0: $url_params = '?success=register';
	}
}
else if($obj->delete()) {
	switch($registered) {
		case 1: $url_params = '?error=unregister';
		case 0: $url_params = '?success=unregister';
	}
}

header('Location: ' . $path . $url_params);
