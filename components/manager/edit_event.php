<?php 

$event = new Event();
$event->setIdEvent(intval($_POST['id']));
$event->setName($_POST['name']);
$event->setDateStart($_POST['start']);
$event->setDateEnd($_POST['end']);
$event->setAllowed($_POST['allowed']);
$event->setVenue(intval($_POST['venue']));

// var_dump($event);

if($event->update()) {
	header('Location: manage.php?success=update');
}
else {
	header('Location: manage.php?error=update');
}