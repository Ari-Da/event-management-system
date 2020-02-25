<?php 

$event = new Event();
$event->setIdEvent(intval($_POST['id']));

if($event->delete()) {
	header('Location: manage.php?success=delete');
}
else {
	header('Location: manage.php?error=delete');
}