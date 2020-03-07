<?php 
$params = array('id'=>'int', 'allowed'=>'int', 'type'=>'str', 'name'=>'str', 'start'=>'date', 'end'=>'date', 'venue'=>'int');
$path = 'manage.php';

sanitize($params, $path);
validate($params, $path);

// Sanitization and validation complete

$type = $_POST['type'];
$obj = null;

if($type == 'event') {
	$obj = new Event();
	$obj->setIdEvent(intval($_POST['id']));
	$obj->setVenue(intval($_POST['venue']));
}
else if($type == 'session') {
	$obj = new Session();
	$obj->setIdSession(intval($_POST['id']));
	$obj->setEvent(intval($_POST['event']));
}


if($obj !=null) {
	$obj->setName($_POST['name']);
	$obj->setDateStart($_POST['start']);
	$obj->setDateEnd($_POST['end']);
	$obj->setAllowed($_POST['allowed']);

	if($obj->update()) {
		header('Location: ' . $path . '?success=update');
	}
	else {
		header('Location: ' . $path . '?error=update');
	}
}