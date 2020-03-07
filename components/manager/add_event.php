<?php 
$params = array('name'=>'str', 'start'=>'date', 'end'=>'date', 'allowed'=>'int', 'venue'=>'int');
$path = 'manage.php';

sanitize($params, $path);
validate($params, $path);

// Sanitization and validation complete

$event = new Event();
$event->setName($_POST['name']);
$event->setDateStart($_POST['start']);
$event->setDateEnd($_POST['end']);
$event->setAllowed($_POST['allowed']);
$event->setVenue($_POST['venue']);

$manager_event = new Manager_event();
$manager_event->setManager($_SESSION['user']['id']);

DB::startTransaction();
$newId = $event->insert();

if($newId > 0) {
	$manager_event->setEvent($newId);

	if($manager_event->insert()) {
		DB::commitTransaction();
		header('Location: ' . $path . '?success=insert');
	}
	else {
		DB::rollTransaction();
		header('Location: ' . $path . '?error=insert');	
	}
}
else {
	DB::rollTransaction();
	header('Location: ' . $path . '?error=insert');
}