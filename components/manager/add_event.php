<?php 

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
		header('Location: manage.php?success=insert');
	}
	else {
		DB::rollTransaction();
		header('Location: manage.php?error=insert');	
	}
}
else {
	DB::rollTransaction();
	header('Location: manage.php?error=insert');
}