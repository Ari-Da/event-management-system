<?php 

$type = '';
$obj = null;

if(isset($_GET['type']))
	$type = $_GET['type'];
var_dump($_POST);
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
		header('Location: manage.php?success=update');
	}
	else {
		header('Location: manage.php?error=update');
	}
}